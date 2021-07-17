<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Throwable;
use Throwable as GlobalThrowable;

class axie extends Model
{
    use HasFactory;

    protected $table = 'axies';
    protected $fillable =['user_id','ronin','nome_time','slp_escola','slp_aluno','meta_mensal'];

    public function carteira_ronin($data){

        $link = 'https://lunacia.skymavis.com/game-api/leaderboard?client_id=';
        $link2 = '&offset=0&limit=0';


            $item = substr($data['ronin'], 6);
            $ronin = str_pad($item, 42, "0x", STR_PAD_LEFT);
            $player = file_get_contents($link.$ronin.$link2);
            $playerList[] = json_decode($player, true);

         return $playerList;
    }

    //Função busca o total de slp na api
    public function total_slp($data)
    {
        if(sizeof($data) >= 1){
            $link = 'https://lunacia.skymavis.com/game-api/clients/';
            $link2 = '/items/1';

            foreach($data as $item)
            {
                $time_id = $item['id'];
                $user_id = $item['user_id'];
                $item = substr($item['ronin'], 6);
                $ronin = str_pad($item, 42, "0x", STR_PAD_LEFT);
                $player = file_get_contents($link.$ronin.$link2);
                $playerList[] = json_decode($player, true);

                foreach($playerList as $item)
                {
                    $pData = $this->prox_date($item['last_claimed_item_at']);



                    $time = [
                        'time_id'       => $time_id,
                        'user_id'       => $user_id,
                        'total_slp'     => $item['total'],
                        'data_saque'    =>  Carbon::createFromTimestamp($pData)->format('d/m/Y - H:h:s')
                    ];


                }
                $collection[] = $time;

            }
        }
        if(sizeof($data) == 0){

            $collection = [];
        }

        return $collection;
    }

    //converte data do proximo claim
    public function prox_date($data)
    {
        if(sizeof($data) >= 1){
        $intervalo = 1209600;
        $ndata = $data + $intervalo;


        }
        if(sizeof($data) == 0){

            $ndata = 0 ;
        }
        return $ndata;
    }

    public function slp_jogador($data)
    {
       if(sizeof($data) >= 1){
            foreach($data as $item)
            {
                    $parte_jogador = axie::where('id', $item['time_id'])->value('slp_aluno');
                    $slp_jogador = $item['qtdSlp'] * $parte_jogador;

                    $array_slp[] = [
                    'slp_jogador'=> $slp_jogador
                    ];

            }
            $total = array_sum( array_column($array_slp, 'slp_jogador'));
       }
       if(sizeof($data) == 0){

        $total = 0 ;
        }

       return $total;
    }

    public function api_coingecko($data)
    {
        if(sizeof($data) >= 1){
            $link = 'https://api.coingecko.com/api/v3/simple/token_price/ethereum?contract_addresses=0xcc8fa225d80b9c7d42f96e9570156c65d6caaa25&vs_currencies=';
            $coin = file_get_contents($link.$data);
            $valor = json_decode($coin, true);

            if($data == 'brl')
            {
                $v_coin = $valor['0xcc8fa225d80b9c7d42f96e9570156c65d6caaa25']['brl'];
                return $v_coin;
            }
            if($data == 'usd')
            {
                $v_coin = $valor['0xcc8fa225d80b9c7d42f96e9570156c65d6caaa25']['usd'];
                return $v_coin;
            }
            if($data == 'eur')
            {
                $v_coin = $valor['0xcc8fa225d80b9c7d42f96e9570156c65d6caaa25']['eur'];
                return $v_coin;
            }
        }


    }
}
