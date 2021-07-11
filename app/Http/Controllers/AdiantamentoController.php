<?php

namespace App\Http\Controllers;

use App\Models\adiantamentos;
use App\Models\saldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Helper;
class AdiantamentoController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:adto-list|adto-create|adto-edit|adto-delete', ['only' => ['index','store']]);
         $this->middleware('permission:adto-create', ['only' => ['create','store']]);
         $this->middleware('permission:adto-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:adto-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $adto = adiantamentos::latest()->paginate();
        $users = User::get();
         return view('adiantamentos.index', compact('users','adto'));
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
        //$user = auth()->user()->id;
        $data = $request->all();
        $data['valor'] = Helper::formatpricetodatabase($data['valor']);
        $user = $data['user_id'];
        $valor = $data['valor'];

        adiantamentos::create($data);

        $saldo_atual = saldo::where('user_id', $user)->value('valor');
        $saldo = $saldo_atual + $valor;

        // Insere o valor caso não exista ou atualiza caso ja exista / /
        DB::table('saldos')->upsert([
            ['user_id' => $user, 'valor' => $saldo, 'created_at' => now (), 'updated_at' => now ()]
        ],['user_id'],['valor','created_at' , 'updated_at']);


        return redirect()
                ->route('adiantamentos.index')
                ->with('message', 'Adiantamento lançado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adto = adiantamentos::find($id);
        $users = User::get();

        if(!$adto){
            return redirect()->back();
        }
        return view('adiantamentos.edit', compact('adto', 'users'));
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
        $adto = adiantamentos::find($id);

        $data = $request->all();
        $data['valor'] = Helper::formatpricetodatabase($data['valor']);

        $adto->update($data);

        $user = $adto['user_id'];

        $saldo = adiantamentos::where('user_id', $user)->sum('valor');

        // Insere o valor caso não exista ou atualiza caso ja exista / /
        DB::table('saldos')->upsert([
            ['user_id' => $user, 'valor' => $saldo, 'created_at' => now (), 'updated_at' => now ()]
        ],['user_id'],['valor','created_at' , 'updated_at']);


        if(!$adto) {
            return redirect()->back();
        }



        return redirect()
            ->route('adiantamentos.index')
            ->with('message', 'Atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adto = adiantamentos::find($id);
        $user = $adto->user_id;
        $adto->delete();


        $saldo = adiantamentos::where('user_id', $user)->sum('valor');

        // Insere o valor caso não exista ou atualiza caso ja exista / /
        DB::table('saldos')->upsert([
            ['user_id' => $user, 'valor' => $saldo, 'created_at' => now (), 'updated_at' => now ()]
        ],['user_id'],['valor','created_at' , 'updated_at']);




            return redirect()
            ->route('adiantamentos.index')
            ->with('message', 'Adiantamento removido com sucesso!');
    }
}
