@extends('layouts.app')

@section('content')
  <div class="col-sm-offset-4 col-sm-4">
    <br>
    <div class="panel panel-primary">
      <div class="panel-heading">Fiche de bot</div>
      <div class="panel-body">
        <p>Nom : {{ $bot->name }}</p>
        <p>Adress Mac : {{ $bot->mac_address }}</p>
        <p>System : {{ $bot->operating_system }}</p>
        <p>CPU : {{ $bot->cpu }}</p>
        <p>Statut : {{ $bot->state }}</p>
        <p>Dernière connexion : {{ $bot->updated_at }}</p>
      </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
      <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    </a>
  </div>
@endsection
