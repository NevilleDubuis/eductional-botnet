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
                        <h3 class="panel-title">Liste des utilisateurs</h3>
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
                                    <td><a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-warning btn-block">Modifier</a></td>
                                    <td>
                                      {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                                        {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                                      {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <a href="{{ route('users.create') }}" class="btn btn-success btn-block">Créer utilisateur</a>


            </div>


        </div>
    </div>
</div>
@endsection
