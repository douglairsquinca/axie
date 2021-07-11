<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\metaDiaria;
use App\Models\axie;
use Carbon\Carbon;

class MetaDiariaController extends Controller
{
    private $meta;
    
    public function __construct(metaDiaria $meta)
    {
        $this->meta = $meta;
    }
    public function index()
    {
        $user_id = auth()->user()->id;
        $players = axie::where('user_id', $user_id)->get();
        $playerList = [];
        $meta_diaria = [];

        if(!$players){   
            $playerList = $this->meta->carteira_ronin($players);        
            foreach($playerList as $item)        {
        
                $player_id = $item['id'];
                $metaList = metaDiaria::where('player_id', $player_id)->orderBy('created_at', 'desc')->first();
               
                
                $listPlayer =[
                    'id' => $item['id'],
                    'nome_time' => $item['nome_time'],
                    'client_id' => $item['client_id'],
                    'item_id' =>   $item['item_id'], 
                    'total_slp' => $item['total_slp'],
                    'total_slp_clamado' => $item['total_slp_clamado'],
                    'ultima_data_claim' => $item['ultima_data_claim'],
                    "player_list" =>[
                    'total_slp'     =>$metaList['total_slp'],
                    'player_id'     =>$player_id,
                    'slp_diario'    =>$metaList['slp_diario'],
                    'total_slp_ant' =>$metaList['total_slp_ant'],
                    'data'          =>strtotime($metaList['created_at'])
                    ]     
                ];           
            
                if(!$metaList == null){
                
                    $collection = $this->meta->meta_diaria($listPlayer);
                    $data_atual = date('m/d/Y');  
                    $ultima_data = Carbon::createFromTimestamp($listPlayer['player_list']['data'])->format('m/d/Y');
                
                    if($data_atual > $ultima_data)
                    {          
                        
                        if($collection['total_slp'] > $metaList['total_slp']){
                            $this->meta->create($collection);
                        }              
                    }
                
                }else{
                
                    $array = [
                        'total_slp'     =>$item['total_slp'],
                        'player_id'     =>$player_id,
                        'slp_diario'    =>0,
                        'total_slp_ant' =>0,                      
                        
                    ];     
                
                    $this->meta->create($array);
                } 

                $meta_diaria[] = $collection; 
                $totaSLP[]= metaDiaria::select('total_slp')->where('user_id', $user_id)->
                        where('player_id', $player_id)->
                        orderBy('created_at', 'desc')->first();
            }
        }    

        return view('metas.index',compact('playerList','meta_diaria'));
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
               
       



        $slp_total = 100;
     
        $data = $request->all();
 
        $slp_escola = $request->slp_escola;
        $slp_aluno = $slp_total - $slp_escola;

        $data['user_id'] = $user_id;
        $data['slp_aluno'] = $slp_aluno;

        $this->time->create($data);
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
