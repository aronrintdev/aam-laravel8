{!! Form::open(['route' => ['accounts.destroy', $AccountID], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('accounts.show', $AccountID) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('accounts.edit', $AccountID) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
</div>
{!! Form::close() !!}
