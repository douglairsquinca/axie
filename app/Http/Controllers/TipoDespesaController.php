<?php

namespace App\Http\Controllers;

use App\Models\TipoDespesas;
use Illuminate\Http\Request;

class TipoDespesaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tipo_despesa-list|tipo_despesa-create|tipo_despesa-edit|tipo_despesa-delete', ['only' => ['index','store']]);
         $this->middleware('permission:tipo_despesa-create', ['only' => ['create','store']]);
         $this->middleware('permission:tipo_despesa-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tipo_despesa-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $tipoDespesas = TipoDespesas::latest()->paginate();

        return view('tipo_despesas.index', compact('tipoDespesas') );
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
        $data = $request->all();


        TipoDespesas::create($data);
        return redirect()
            ->route('tipo_despesas.index')
            ->with('message', 'Tipo despesa criada com sucesso!');
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
        $tipoDespesas = TipoDespesas::find($id);



        if(!$tipoDespesas) {
            return redirect()->back();
        }
        return view('tipo_despesas.edit', compact('tipoDespesas'));
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
        $tipoDespesas = TipoDespesas::find($id);
         if(!$tipoDespesas) {
             return redirect()->back();
         }

         $data = $request->all();


         $tipoDespesas->update($data);
         return redirect()
             ->route('tipo_despesas.index')
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
        //
    }
}
