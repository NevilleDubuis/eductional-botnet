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
              <h3 class="panel-title">Utilisateurs appartenant au Groupe ID {!! $group !!}</h3>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>email</th>
                  <th>admin</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{!! $user->id !!}</td>
                    <td class="text-primary"><strong>{!! $user->name !!}</strong></td>
                    <td class="text-primary"><strong>{!! $user->email !!}</strong></td>
                    <td class="text-primary"><strong>
                      @if($user->isAdmin())
                        x
                      @endif
                    </strong></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!--
          <a href="{{ route('users.create') }}" class="btn btn-success btn-block">Créer utilisateur</a>
        -->
          {!! $links !!}
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
          <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
      </div>
    </div>
  </div>
@endsection
