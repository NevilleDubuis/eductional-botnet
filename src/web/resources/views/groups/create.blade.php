@extends('layouts.app')

@section('content')
  <div class="col-sm-offset-4 col-sm-4">
    <br>
    <div class="panel panel-primary">
    <div class="panel-heading">Création d'un groupe</div>
      <div class="panel-body">
        <div class="col-sm-12">
          {{ Form::open(['route' => 'groups.store', 'class' => 'form-horizontal panel']) }}
          <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) }}
            {{ $errors->first('name', '<small class="help-block">:message</small>') }}
          </div>
          <div class="form-group">
            <table>
              <thead>
                <tr>
                  <th>Membre(s)</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($users as $user)
                <tr>
                  <td class="checkbox">
                      <label>
                        {{ Form::checkbox('users[]', $user->id, null)}}{!! $user->name !!}
                    </label>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
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
