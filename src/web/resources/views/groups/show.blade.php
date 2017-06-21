@extends('layouts.app')

@section('content')
<div class="col-sm-offset-4 col-sm-4">
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading">Fiche d'un groupe</div>
    <div class="panel-body">
      <p>Nom : {{ $group->name }}</p>
      <p>Nbre max de bots : {{ $group->max_bot }}</p>
    </div>
  </div>
  <a href="javascript:history.back()" class="btn btn-primary">
    <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
  </a>
</div>

@endsection
