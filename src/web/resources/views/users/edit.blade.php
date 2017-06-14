@extends('layouts.app')

@section('content')
  <div class="col-sm-offset-4 col-sm-4">
    <br>
    <div class="panel panel-primary">
      <div class="panel-heading">Modification d'un utilisateur</div>
      <div class="panel-body">
        <div class="col-sm-12">
          {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
          <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
          </div>
          <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('admin', 1, null) !!}Administrateur
              </label>
            </div>
          </div>
            {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
      <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    </a>
  </div>
@stop
