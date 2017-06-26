@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>

        <div class="col-sm-offset-2 col-sm-8">
          <div class="pull-right">
            connecté <i class="fa fa-circle bot connected" aria-hidden="true "></i>&nbsp;&nbsp;&nbsp;
            occupé <i class="fa fa-circle bot attacking" aria-hidden="true "></i>&nbsp;&nbsp;&nbsp;
            déconnecté <i class="fa fa-circle bot disconnected" aria-hidden="true "></i>&nbsp;&nbsp;&nbsp;
          </div>
        </div>
        <div class="col-sm-offset-2 col-sm-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Liste des Bots</h3>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th></th>
                  <th>MAC</th>
                  <th>Nom</th>
                  <th>Sytem d'exploitation</th>
                  <th>cpu</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bots as $bot)
                  <tr>
                    <td class="text-primary"><i class="fa fa-circle bot {{ $bot->state }}" aria-hidden="true "></i></td>
                    <td>{{ $bot->mac_address }}</td>
                    <td class="text-primary"><strong>{{ $bot->name }}</strong></td>
                    <td class="text-primary"><strong>{{ $bot->operating_system }}</strong></td>
                    <td class="text-primary"><strong>{{ $bot->cpu }}</strong></td>
                    <td><a href="{{ route('bots.show', [$bot->id]) }}" class="btn btn-success btn-block">Voir</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
