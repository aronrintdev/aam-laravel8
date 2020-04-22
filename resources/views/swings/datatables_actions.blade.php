{!! Form::open(['route' => ['swings.destroy', $SwingID], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('swings.show', $SwingID) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('swings.edit', $SwingID) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
</div>
{!! Form::close() !!}
