@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>

        <div class="col-sm-offset-2 col-sm-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Liste des Attacks</h3>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Hacker</th>
                  <th>Cible</th>
                  <th>Port</th>
                  <th>Nombre de bots</th>
                  <th>Méthode</th>
                  <th>Début</th>
                  <th>Fin</th>
                  <th>Modifiée le</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($attacks as $attack)
                  <tr>
                    <td>{{ $attack->id }}</td>
                    <td class="text-primary"><strong>{{ $attack->name }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->user->name }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->target }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->port }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->bots_number }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->method->name }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->start }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->finish }}</strong></td>
                    <td class="text-primary"><strong>{{ $attack->updated_at }}</strong></td>
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
