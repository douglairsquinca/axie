<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Despesas extends Model
{
    use HasFactory;

    protected $table = 'despesas';
    protected $fillable =[
        'user_id',
        'projeto_id',
        'descricao',
        'valor',
        'tipoDespesa',
        'formaPagamento',
        'despesa',
        'data',
        'obs',
        'status',
        'image',


    ];

    public function total_mes($id,$data)
    {
        $mes = \Carbon\Carbon::parse($data)->format('m');
        $ano = \Carbon\Carbon::parse($data)->format('Y');

        $total_desp = DB::table('despesas')
                        ->where('user_id', $id)
                        ->whereMonth('data',$mes)
                        ->whereYear('data',$ano)
                        ->sum('valor');



        if( $total_desp == null ){
            $total_desp = 0.00;

        }
        return $total_desp;
    }

    public function saldo($id)
    {
        $saldo = DB::table('saldos')->where('user_id', $id)->value('valor');

        if($saldo == null ){
            $saldo = 0.00;
        }
        return $saldo;
    }

    public function total_adto($id,$data)
    {
        $mes = \Carbon\Carbon::parse($data)->format('m');
        $ano = \Carbon\Carbon::parse($data)->format('Y');

        $total_adto = DB::table('adiantamentos')
                        ->where('user_id', $id)
                        ->whereMonth('data',$mes)
                        ->whereYear('data',$ano)
                        ->sum('valor');


        if( $total_adto == null){
            $total_adto = 0.00;
       }
       return $total_adto;
    }
    public function saldo_ant($id, $data)
    {
        $mes_ant = \Carbon\Carbon::parse($data)->format('m');

        $ano = \Carbon\Carbon::parse($data)->format('Y');


        $m = $mes_ant - 1;
            // wrap to previous year
            if ($m < 1) {
            $m = 12 - abs($m) % 12;
        }



        $total_desp = DB::table('despesas')
                    ->where('user_id', $id)
                    ->whereMonth('data',$m)
                    ->whereYear('data',$ano)
                    ->sum('valor');

        $total_adto = DB::table('adiantamentos')
                        ->where('user_id', $id)
                        ->whereMonth('data',$m)
                        ->whereYear('data',$ano)
                        ->sum('valor');

        $saldo_ant = $total_adto - $total_desp;


        if($saldo_ant >= 0){
            $saldo_ant = 0.00;
        }else{
            $saldo_ant = abs($saldo_ant);
        }
        return $saldo_ant;
    }

    public function reemb($id,$data)
    {

        $mes = \Carbon\Carbon::parse($data)->format('m');



        $ano = \Carbon\Carbon::parse($data)->format('Y');

        $total_desp = DB::table('despesas')
                    ->where('user_id', $id)
                    ->whereMonth('data',$mes)
                    ->whereYear('data',$ano)
                    ->sum('valor');

        $total_adto = DB::table('adiantamentos')
                        ->where('user_id', $id)
                        ->whereMonth('data',$mes)
                        ->whereYear('data',$ano)
                        ->sum('valor');

        $reemb = $total_adto - $total_desp;


        if($reemb >= 0){
            $reemb = 0.00;
        }else{
            $reemb = abs($reemb);
        }
        return $reemb;
    }
}
