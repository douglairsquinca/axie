

@csrf

<input type="text" name="nome" id="nome" placeholder="Projeto" value="{{$projetos->nome ?? old('nome')}}">
<select class="form-control" name="tipo" data-toggle="select" title="Simple select" data-placeholder="Select a state">
    <option value="1">Não Reembolsável</option>
    <option value="0">Reembolsável</option>  
</select>
<button type="submit">Enviar</button>
