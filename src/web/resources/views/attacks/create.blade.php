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
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom de l\'attaque']) }}
            {{ $errors->first('name', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('target') ? 'has-error' : '' }}">
            {{ Form::text('target', null, ['class' => 'form-control', 'placeholder' => 'Cible']) }}
            {{ Form::number('port', 80, ['class' => 'form-control']) }}
            {{ $errors->first('target', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('method') ? 'has-error' : '' }}">
              @foreach ($methods as $method)
              <label>
                {{ Form::radio('method_selected', $method->id), ['class' => 'radio'] }}{!! $method->name !!}
              </label>
              </br>
              @endforeach
          </div>
          <div class="form-group {{ $errors->has('bots_number') ? 'has-error' : '' }}">
            {{ Form::number('bots_number',null ,['class' => 'form-control', 'placeholder' => 'Nombre de bots']) }}
            {{ $errors->first('bots_number', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
            {{ Form::date('start', \Carbon\Carbon::now(),['class' => 'form-control']) }}
            {{ $errors->first('start', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
            {{ Form::number('duration',null ,['class' => 'form-control', 'placeholder' => 'Durée de l\'attaque']) }}
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
