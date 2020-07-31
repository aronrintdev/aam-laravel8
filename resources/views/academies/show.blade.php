@extends('layouts.app')

@section('content')
    <section class="content-header">
        <a href="{!! route('academies.index') !!}" class="btn btn-default pull-right">Back</a>
        <h1>
            Academy
        </h1>
    </section>
    <div class="content">
        <h5>
            Instructors
        </h5>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
@foreach($instructors as $inst)
    <a href="{!! route('accounts.show', $inst->InstructorID) !!}" class="">
@if($inst->accout)
{{ $inst->account->FirstName }}
{{ $inst->account->LastName }}
-
{{ $inst->account->Email }}
@else
Broken Accounts
@endif
</a>
    @if ($inst->pivot->IsMaster) 
<span class="small">
        *owner*
</span>
    @endif

<hr/>
@endforeach
                </div>
            </div>
        </div>

        <h5>
            Info
        </h5>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('academies.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
