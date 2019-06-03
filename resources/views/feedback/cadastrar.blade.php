@extends('layouts.principal')
@section('title','Início')
@php($aluno = $sugestao->objetivo->aluno)
@php($objetivo = $sugestao->objetivo)
@section('navbar')
<a href="{{route('aluno.listar')}}">Alunos</a>
 > <a href="{{route('aluno.gerenciar',$aluno->id)}}">Gerenciar: <strong>{{$aluno->nome}}</strong></a>
 > <a href="{{route('objetivo.listar',$aluno->id)}}">Objetivos</a>
 > <a href="{{route('objetivo.gerenciar',[$aluno->id,$objetivo->id])}}"><strong>{{$objetivo->titulo}}</strong></a>
 > <a href="{{route('objetivo.sugestoes.listar',[$aluno->id,$objetivo->id])}}">Sugestões</a>
 > <a href="{{route('objetivo.sugestoes.feedbacks.listar',[$aluno->id,$objetivo->id,$sugestao->id])}}"">Feedbacks</a>
 > Novo
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Feedbacks de <strong>{{$sugestao->titulo}}</strong></div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route("objetivo.sugestoes.feedbacks.criar") }}">
                {{ csrf_field() }}

                <input id="id_aluno" type="hidden" class="form-control" name="id_aluno" value="{{ $aluno->id }}">
                <input id="id_objetivo" type="hidden" class="form-control" name="id_objetivo" value="{{ $objetivo->id }}">
                <input id="id_sugestao" type="hidden" class="form-control" name="id_sugestao" value="{{ $sugestao->id }}">

                <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                    <label for="feedback" class="col-md-4 control-label">Status</label>

                    <div class="col-md-6">
                      
                      <textarea name="feedback" class="form-control" placeholder="Informe seu feedback."></textarea>

                      @if ($errors->has('feedback'))
                          <span class="help-block">
                              <strong>{{ $errors->first('feedback') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <a class="btn btn-danger" href="{{URL::previous()}}">Voltar</a>
                        <input value="Enviar" type="submit" class="btn btn-success">
                     </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection