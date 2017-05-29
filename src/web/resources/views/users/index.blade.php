@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <br>

            <div class="col-sm-offset-4 col-sm-4">
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
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{!! $user->id !!}</td>
                                    <td class="text-primary"><strong>{!! $user->name !!}</strong></td>
                                    <td>{!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-success btn-block']) !!}</td>
                                    <td>{!! link_to_route('user.edit', 'Modifier', [$user->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
                                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! link_to_route('user.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-info pull-right']) !!}
                {!! $links !!}
            </div>


        </div>
    </div>
</div>
@endsection
