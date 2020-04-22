{!! Form::open(['route' => ['academies.destroy', $AcademyID], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('academies.show', $AcademyID) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('academies.edit', $AcademyID) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
</div>
{!! Form::close() !!}
