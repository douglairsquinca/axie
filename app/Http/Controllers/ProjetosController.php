<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;

use App\Models\Model\Projetos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProjetosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:projeto-list|projeto-create|projeto-edit|projeto-delete', ['only' => ['index','store']]);
         $this->middleware('permission:projeto-create', ['only' => ['create','store']]);
         $this->middleware('permission:projeto-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:projeto-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $projetos = Projetos::latest()->paginate();

        $tipos = array(
            array("tipo" =>"Não Reembolsável", "value" => "0"),
            array("tipo" =>"Reembolsável", "value" =>"1"),
        );
        return view('projetos.index', compact('projetos','tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projetos.create');
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


        Projetos::create($data);
        return redirect()
            ->route('projetos.index')
            ->with('message', 'Projeto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       $projetos = Projetos::find($id);
       if(!$projetos) {
           return redirect()->route('projetos.index');
       }
       return view('projetos.show', compact('projetos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projetos = Projetos::find($id);

        $tipos = array(
            array("tipo" =>"Não Reembolsável", "value" => "0"),
            array("tipo" =>"Reembolsável", "value" =>"1"),
        );

        if(!$projetos) {
            return redirect()->back();
        }
        return view('projetos.edit', compact('projetos','tipos'));
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
         //$post = Post::where('id',$id)->first();
         $projetos = Projetos::find($id);
         if(!$projetos) {
             return redirect()->back();
         }

         $data = $request->all();


         $projetos->update($data);
         return redirect()
             ->route('projetos.index')
             ->with('message', 'Projeto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projetos = Projetos::find($id);

        $projetos->delete();
            return redirect()
            ->route('projetos.index')
            ->with('message', 'Projeto deletado com sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $projetos = Projetos::where('nome', 'LIKE', "%{$request->search}%")
                        ->paginate();
        return view('projetos.index', compact('projetos','filters'));
    }
}

