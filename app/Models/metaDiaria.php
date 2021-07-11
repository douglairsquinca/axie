<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class metaDiaria extends Model
{
    use HasFactory;
    
    protected $table = 'meta_diarias';
    protected $fillable =['player_id','total_slp','slp_diario','total_slp_ant'];

    public function carteira_ronin($data){     
       
        $link = 'https://lunacia.skymavis.com/game-api/clients/';
       
        
        $link2 = '/items/1';
        foreach($data as $item)
        {
            $id = $item['id'];
            $nome_time = $item['nome_time'];
            $item = substr($item['ronin'], 6);
            $ronin = str_pad($item, 42, "0x", STR_PAD_LEFT);
            $player = file_get_contents($link.$ronin.$link2);      
            $playerList[] = json_decode($player, true);   
            foreach($playerList as $item)
            {
                $time = [
                    'id'        => $id,
                    'nome_time' => $nome_time, 
                    'client_id' => $item['client_id'],
                    'item_id'   => $item['item_id'] , 
                    'total_slp'     => $item['total'],                     
                    'total_slp_clamado'=> $item['claimable_total'],    
                    'ultima_data_claim'=> $item['last_claimed_item_at']
                    
                ];
        
            }
            $collection[] = $time;
            
        }    
       
        return $collection;
    }
    public function meta_diaria($data){
//dd($data);
        $data_atual = date('m/d/Y');  
        $ultima_data = Carbon::createFromTimestamp($data['player_list']['data'])->format('m/d/Y');
          
        if($data_atual > $ultima_data){
            $qtd_dias = metaDiaria::where('player_id', $data['id'])->count();
            $nome_time = $data['nome_time'];
            $slp_diario = $data['total_slp']-$data['player_list']['total_slp'];
            $total_slp = $data['total_slp'];  
            $total_slp_ant = $data['total_slp']- $slp_diario;
            $player_id = $data['id'];
            $collection = ['nome_time'=>$nome_time,'slp_diario'=>$slp_diario,'total_slp'=>$total_slp,'total_slp_ant'=>$total_slp_ant,'player_id'=>$player_id, 'qtd_dias'=>$qtd_dias,'data'=>$data['player_list']['data']];
       
            return $collection;
        }else{
            $qtd_dias = metaDiaria::where('player_id', $data['id'])->count();
            $nome_time = $data['nome_time'];
            $slp_diario = $data['player_list']['slp_diario'];
            $total_slp = $data['total_slp'];  
            $total_slp_ant = $data['player_list']['total_slp_ant'];
            $player_id = $data['id'];
            $collection = ['nome_time'=>$nome_time,'slp_diario'=>$slp_diario,'total_slp'=>$total_slp,'total_slp_ant'=>$total_slp_ant,'player_id'=>$player_id, 'qtd_dias'=>$qtd_dias,'data'=>$data['player_list']['data']];
       
            return $collection;
        }
        
    }


}
