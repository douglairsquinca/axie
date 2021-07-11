<?php

namespace App\Http\Controllers;

use App\Models\axie;
use App\Models\financeiro;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    private $financeiro;


    public function __construct(financeiro $financeiro)
    {
        $this->financeiro = $financeiro;

    }
    public function index()
    {
        $user_id = auth()->user()->id;
        $saques = financeiro::where('user_id', $user_id)->paginate(10);
        $times = axie::where('user_id', $user_id)->get();


        return view('financeiro.index', compact('times','saques'));
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
        $user_id = auth()->user()->id;
        $data = $request->all();
        $data['user_id'] = $user_id;

        $this->financeiro->create($data);
        return redirect()
        ->route('financeiro.index')
        ->with('message', 'Saque inserido com sucesso!');
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
}
