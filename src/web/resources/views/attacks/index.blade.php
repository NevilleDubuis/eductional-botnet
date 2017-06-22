@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>

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
                @endforeach
              </tbody>
            </table>
          </div>
          <a href="{{ route('attacks.create') }}" class="btn btn-success btn-block">Créer une attaque</a>
          {!! $links !!}
        </div>
      </div>
    </div>
  </div>
@endsection
