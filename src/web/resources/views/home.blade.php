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
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $attacks->count() }}</td>
                  <td>{{ $runningAttacks }}</td>
                  <td>{{ $waitingAttacks }}</td>
                </tr>
              </tbody>
            </table>
          </br>
            <table class="table">
              <thead>
                <tr>
                  <th>Bots</th>
                  <th>Actifs</th>
                  <th>Disponibles</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>5</td>
                  <td>3</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
