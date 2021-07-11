<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\axie;
use App\Models\config;
use App\Models\saldo_slp;
use App\Models\slpArenaMode;

class AxieController extends Controller
{
    private $time;
    private $saldo;
    private $coin;

    public function __construct(axie $time, saldo_slp $saldo_slp, config $coin)
    {
        $this->time = $time;
        $this->saldo = $saldo_slp;
        $this->coin = $coin;
    }


    public function index()
    {
        $user_id = auth()->user()->id;
        $players = axie::where('user_id', $user_id)->paginate(10);
        $slp_total = saldo_slp::where('user_id', $user_id)->sum('qtdSlp');
        $slp_jogador = saldo_slp::where('user_id', $user_id)->get();
        $coin = config::where('user_id', $user_id)->value('coin');

        $v_coin = $this->time->api_coingecko($coin);
        $coin_slp = $slp_total * $v_coin;

        $total_slp = $this->time->total_slp($players);

        $total_slp_jogador = $this->time->slp_jogador($slp_jogador);
        $total_slp_escola = $slp_total - $total_slp_jogador;

        $coin_slp_jogador = $total_slp_jogador * $v_coin;
        $coin_slp_escola = $total_slp_escola * $v_coin;

        foreach($total_slp as $item)
        {
            // Insere o valor caso não exista ou atualiza caso ja exista //
            DB::table('saldo_slps')->upsert([
                ['user_id' => $item['user_id'],'time_id' => $item['time_id'],'qtdSlp' => $item['total_slp'], 'created_at' => now (), 'updated_at' => now ()]
            ],['user_id','time_id'],['qtdSlp','created_at' , 'updated_at']);

            // $verificar = saldo_slp::where('user_id', $item['user_id'])->where('time_id', $item['time_id'])->value('qtdSlp');

            // if($item['total_slp'] > $verificar)
            // {
            //      // Insere o valor caso não exista ou atualiza caso ja exista / /
            //     DB::table('saldo_slps')->upsert([
            //         ['user_id' => $item['user_id'],'time_id' => $item['time_id'],'qtdSlp' => $item['total_slp'], 'created_at' => now (), 'updated_at' => now ()]
            //     ],['user_id','time_id'],['qtdSlp','created_at' , 'updated_at']);
            // }

        }
        return view('account.index', compact('user_id','players','total_slp','slp_total','total_slp_jogador','total_slp_escola','coin','coin_slp','coin_slp_jogador','coin_slp_escola'));
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
        dd($request);

        $slp_total = 1;
        $user_id = auth()->user()->id;
        $data = $request->all();

        $slp_escola = $request->slp_escola;
        $slp_aluno = $slp_total - $slp_escola;

        $data['user_id'] = $user_id;
        $data['slp_aluno'] = $slp_aluno;
        $data['status'] = 0;

        $time = $this->time->create($data);

        $array = [
            'user_id'     =>$time['user_id'],
            'time_id'     =>$time['id'],
            'qtdSlp'      =>0.00
        ];
        $this->saldo->create($array);


        return redirect()
        ->route('account.index')
        ->with('message', 'Time inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time = $this->time->find($id);
        $playerList = $this->time->carteira_ronin($time);
        $saldo_slp = saldo_slp::where('time_id', $id)->value('qtdSlp');
        $slp_ganho = 0;

        foreach($playerList as $item)
        {
            $rank = $item['items'][0]['elo'];
        }
        if($rank < 800){

            $slp_ganho = 0;

        }elseif($rank >= 800 && $rank <= 999)
        {
            $slp_ganho = 1;

        }elseif($rank >= 1000 && $rank <= 1099){

            $slp_ganho = 3;

        }elseif($rank >= 1100 && $rank <= 1299){

            $slp_ganho = 7;

        }elseif($rank >= 1300 && $rank <= 1499){

            $slp_ganho = 8;

        }elseif($rank >= 1500 && $rank <= 1799){

            $slp_ganho = 9;

        }elseif($rank >= 1800 && $rank <= 1999){

            $slp_ganho = 10;

        }elseif($rank >= 2000 && $rank <= 1199){

            $slp_ganho = 11;

        }elseif($rank >= 2200){

            $slp_ganho = 12;
        }
        $meta = (($saldo_slp * 100)/ $time['meta_mensal']);

        return view('account.view', compact('time', 'playerList','saldo_slp','slp_ganho','meta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
        $time = $this->time->find($id);

        return view('account.edit', compact('time'));
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
        $slp_total = 1.0;
        $data = $request->all();
        $slp_escola = $request->slp_escola;
        $slp_aluno = $slp_total - $slp_escola;


        $data['slp_aluno'] = $slp_aluno;
        $data['status'] = 0;

        $time = $this->time->find($id);
        $time->update($data);

        return redirect()
        ->route('account.index')
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
        $time = axie::find($id);
        $time->delete();
        $slp = saldo_slp::where('time_id', $id);
        $slp->delete();

        return redirect()
            ->route('account.index')
            ->with('message', 'Time removido com sucesso!');
    }
}
