@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>

        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-6">
              attente <i class="fa fa-circle attack waiting" aria-hidden="true "></i>&nbsp;&nbsp;&nbsp;
              attaque <i class="fa fa-circle attack running" aria-hidden="true "></i>&nbsp;&nbsp;&nbsp;
              terminé <i class="fa fa-circle attack finished" aria-hidden="true "></i>&nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-sm-6">
              <div class="pull-right">
                <a href="{{ route('attacks.create') }}" class="btn btn-success  btn-sm">Créer une attaque</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          &nbsp;
        </div>
        <div class="col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Liste des Attacks</h3>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th></th>
                  <th>Nom</th>
                  <th>Hacker</th>
                  <th>Cible</th>
                  <th>Port</th>
                  <th>Méthode</th>
                  <th>Nombre de bots</th>
                  <th>Durée</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($attacks as $attack)
                  @if($currentUser->isAdmin() || $currentUser->id === $attack->user_id)
                    <tr>
                      <td class="text-primary"><i class="fa fa-circle attack {{ $attack->state() }}" aria-hidden="true "></i></td>
                      <td class="text-primary"><strong>{{ $attack->name }}</strong></td>
                      <td class="text-primary"><strong>{{ $attack->user->name }}</strong></td>
                      <td class="text-primary"><strong>{{ $attack->target }}</strong></td>
                      <td class="text-primary"><strong>{{ $attack->port }}</strong></td>
                      <td class="text-primary"><strong>{{ $attack->method->name }}</strong></td>
                      <td class="text-primary"><strong>{{ $attack->bots_number }}</strong></td>
                      <td class="text-primary"><strong>{{ $attack->duration }}</strong></td>
                      <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['attacks.destroy', $attack->id]]) !!}
                          {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cette attaque ?\')']) !!}
                        {!! Form::close() !!}
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
          {!! $links !!}
        </div>
      </div>
    </div>
  </div>
@endsection
