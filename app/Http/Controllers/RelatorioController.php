<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Model\Projetos;
use App\Models\TipoDespesas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Despesas $despesa)
    {
        $this->despesa = $despesa;
        $this->middleware('permission:relatorio-list|relatorio-create|relatorio-edit|relatorio-delete', ['only' => ['index','show']]);
        $this->middleware('permission:relatorio-create', ['only' => ['create','store']]);
        $this->middleware('permission:relatorio-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:relatorio-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $usuarios = User::get();
        $despesas = Despesas::latest()->paginate();
        $tipo_despesas = TipoDespesas::get();
        $projetos = Projetos::get();

        $pagamento = array(
            array("tipo" =>"Dinheiro", "value" => "0"),
            array("tipo" =>"Débito", "value" =>"1"),
            array("tipo" =>"Crédito", "value" =>"2"),
            array("tipo" =>"Cartão Corporativo", "value" =>"3"),


        );

        return view('relatorios.index', compact('usuarios','despesas','tipo_despesas','projetos','pagamento'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            return redirect()->route('relatorios.index');
        }
        return view('relatorios.show', compact('despesa','projetos','tipo_despesas','pagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searchMonth(Request $request, $id)
    {

        $filters = $request->except('_token');

        $user_id = $id;
        $data = $request->mes;
        $mes = \Carbon\Carbon::parse($data)->format('m');
        $ano = \Carbon\Carbon::parse($data)->format('Y');

        $despesas =DB::table('despesas')
                ->where('user_id', $id)
                ->whereMonth('data',$mes)
                ->whereYear('data',$ano)
                ->paginate(100);


        $tipo_despesas = TipoDespesas::get();
        $projetos = Projetos::get();
        $total_desp= $this->despesa->total_mes($id,$data);
        $saldo = $this->despesa->saldo($id);
        $total_adto = $this->despesa->total_adto($id,$data);
        $reemb = $this->despesa->reemb($id,$data);
        $saldo_ant = $this->despesa->saldo_ant($id,$data);
        //$saldo = $saldo_Total - ($total_adto - $total_desp);

        $pagamento = array(
            array("tipo" =>"Dinheiro", "value" => "0"),
            array("tipo" =>"Débito", "value" =>"1"),
            array("tipo" =>"Crédito", "value" =>"2"),
            array("tipo" =>"Cartão Corporativo", "value" =>"3"),


        );

        return view('relatorios.rel_despesas', compact('despesas','tipo_despesas','projetos','pagamento','user_id','filters','total_desp','saldo','total_adto','reemb','saldo_ant'));
    }
    public function aprovar($id)
    {
        DB::table('despesas')->upsert([
            ['id' => $id, 'status' => '1', 'created_at' => now (), 'updated_at' => now ()]
        ],['id'],['status','created_at' , 'updated_at']);

    }
    public function reprovar($id)
    {
        DB::table('despesas')->upsert([
            ['id' => $id, 'status' => '2', 'created_at' => now (), 'updated_at' => now ()]
        ],['id'],['status','created_at' , 'updated_at']);
    }
}
