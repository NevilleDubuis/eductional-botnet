<td>{!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-success btn-block']) !!}</td>

{!! link_to_route('user.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-info pull-right']) !!}
{!! $links !!}
