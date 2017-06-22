@extends('layouts.app')

@section('content')
  <div class="col-sm-offset-4 col-sm-4">
    <br>
    <div class="panel panel-primary">
    <div class="panel-heading">Création d'une attaque</div>
      <div class="panel-body">
        <div class="col-sm-12">
          {{ Form::open(['route' => 'attacks.store', 'class' => 'form-horizontal panel']) }}
          <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::Label('name', 'Nom:') !!}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Abordage']) }}
            {{ $errors->first('name', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('target') ? 'has-error' : '' }}">
            {!! Form::Label('target', 'Cible:') !!}
            {{ Form::text('target', null, ['class' => 'form-control', 'placeholder' => 'fee.heig-vd.ch']) }}
            {{ $errors->first('target', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('target') ? 'has-error' : '' }}">
            {!! Form::Label('port', 'Port:') !!}
            {{ Form::number('port', 80, ['class' => 'form-control']) }}
            {{ $errors->first('part', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('method') ? 'has-error' : '' }}">
            {!! Form::Label('method_selected', 'Method:') !!}
            {!! Form::select('method_selected', $methods->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group {{ $errors->has('bots_number') ? 'has-error' : '' }}">
            {!! Form::Label('bots_number', 'Nombre de bots:') !!}
            {{ Form::number('bots_number', 1, ['class' => 'form-control']) }}
            {{ $errors->first('bots_number', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
            {!! Form::Label('duration', 'Durée(nombre de minute):') !!}
            {{ Form::number('duration', 10, ['class' => 'form-control', 'placeholder' => 'Durée de l\'attaque']) }}
            {{ $errors->first('duration', '<small class="help-block">:message</small>') }}
          </div>
          {{ Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
      <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    </a>
</div>
@stop
