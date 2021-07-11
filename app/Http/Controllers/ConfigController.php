<?php

namespace App\Http\Controllers;

use App\Models\config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    private $coin;


    public function __construct(config $coin)
    {
        $this->coin = $coin;
    }

    public function index()
    {
        //
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

        $this->coin->upsert([
            ['user_id' => $data['user_id'],'coin' => $data['coin'], 'created_at' => now (), 'updated_at' => now ()]
        ],['user_id'],['coin','created_at' , 'updated_at']);

        return redirect()
        ->route('account.index')
        ->with('message', 'Preferências salvas com sucesso!');
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
