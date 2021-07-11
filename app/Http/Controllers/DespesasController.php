<?php

namespace App\Http\Controllers;

use App\Models\adiantamentos;
use App\Models\Despesas;
use App\Models\Model\Projetos;
use App\Models\saldo;
use App\Models\TipoDespesas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Helper;

class DespesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Despesas $despesa)
    {
        $this->middleware('permission:despesa-list|despesa-create|despesa-edit|despesa-delete', ['only' => ['index','store']]);
        $this->middleware('permission:despesa-create', ['only' => ['create','store']]);
        $this->middleware('permission:despesa-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:despesa-delete', ['only' => ['destroy']]);
        $this->despesa = $despesa;
    }
    public function index()
    {
        $user = auth()->user()->id;
        $data = date('Y-m');
        $mes = \Carbon\Carbon::parse($data)->format('m');
        $ano = \Carbon\Carbon::parse($data)->format('Y');
        $despesas = Despesas::where('user_id',$user)
                            ->whereMonth('data',$mes)
                            ->whereYear('data',$ano)
                            -> latest()->paginate();

        $tipo_despesas = TipoDespesas::get();
        $projetos = Projetos::get();


        $total_desp= $this->despesa->total_mes($user,$data);
        $saldo = $this->despesa->saldo($user);
        $total_adto = $this->despesa->total_adto($user,$data);
        $reemb = $this->despesa->reemb($user,$data);
        $saldo_ant = $this->despesa->saldo_ant($user,$data);



        $pagamento = array(
            array("tipo" =>"Dinheiro", "value" => "0"),
            array("tipo" =>"Débito", "value" =>"1"),
            array("tipo" =>"Crédito", "value" =>"2"),
            array("tipo" =>"Cartão Corporativo", "value" =>"3"),


        );

        return view('despesas.index', compact('despesas','tipo_despesas','projetos','pagamento','saldo','total_desp','total_adto','reemb','saldo_ant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('despesas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['valor'] = Helper::formatpricetodatabase($data['valor']);

        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $data ['user_id'] = $user_id;
        $status = 0;
        $data['status'] = $status;


            if ($request->image && $request->image->isValid()){

                $nameFile = Str::of($request->data)->slug('-').'-'.$user_name.'-'.time().'.'.$request->image->getClientOriginalExtension();

                $image = $request->image->storeAs('despesas_img',$nameFile);
                $data ['image'] = $image;

            }



        Despesas::create($data);
        $total_adto = adiantamentos::where('user_id', $user_id)->sum('valor');
        $total_desp = Despesas::where('user_id', $user_id)->sum('valor');

        DB::table('saldos')->upsert([
            ['user_id' => $user_id, 'valor' =>  $total_adto - $total_desp , 'created_at' => now (), 'updated_at' => now ()]
        ],['user_id'],['valor','created_at' , 'updated_at']);

        return redirect()
            ->route('despesas.index')
            ->with('message', 'Despesa criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$post = Post::where('id',$id)->first();
        $despesa = Despesas::find($id);
        $projetos = Projetos::get();
        $tipo_despesas = TipoDespesas::get();
        $pagamento = array(
            array("tipo" =>"Dinheiro", "value" => "0"),
            array("tipo" =>"Débito", "value" =>"1"),
            array("tipo" =>"Crédito", "value" =>"2"),
            array("tipo" =>"Cartão Corporativo", "value" =>"3"),


        );
        if(!$despesa) {
            return redirect()->route('despesas.index');
        }
        return view('despesas.show', compact('despesa','projetos','tipo_despesas','pagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $despesa = Despesas::find($id);
        $projetos = Projetos::get();
        $tipo_despesas = TipoDespesas::get();
        $pagamento = array(
            array("tipo" =>"Dinheiro", "value" => "0"),
            array("tipo" =>"Débito", "value" =>"1"),
            array("tipo" =>"Crédito", "value" =>"2"),
            array("tipo" =>"Cartão Corporativo", "value" =>"3"),


        );
        if(!$despesa) {
            return redirect()->route('despesas.index');
        }
        return view('despesas.edit', compact('despesa','projetos','tipo_despesas','pagamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $despesas = Despesas::find($id);
        if(!$despesas) {
            return redirect()->back();
        }

        $data = $request->all();
        $data['valor'] = Helper::formatpricetodatabase($data['valor']);

        if ($request->image && $request->image->isValid()){
            if (Storage::exists($despesas->image))
                Storage::delete($despesas->image);


            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();

            $image = $request->image->move('despesas_img',$nameFile);
            $data ['image'] = $image;
        }

        $despesas->update($data);
        return redirect()
            ->route('despesas.index')
            ->with('message', 'Despesa atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $despesas = Despesas::find($id);
        $user_id = $despesas['user_id'];
        $valor_desp = $despesas['valor'];

        $saldo = saldo::where('user_id',$user_id)->value('valor');
        $valor = $valor_desp + $saldo;

        if (Storage::exists($despesas->image))
        {
            Storage::delete($despesas->image);
        }

        DB::table('saldos')->upsert([
            ['user_id' => $user_id, 'valor' => $valor, 'created_at' => now (), 'updated_at' => now ()]
        ],['id'],['valor','created_at' , 'updated_at']);


        $despesas->delete();
            return redirect()
            ->route('despesas.index')
            ->with('message', 'Despesa removida com sucesso');
    }
}
