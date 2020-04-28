@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">

        <div class="col-xs-12 col-md-8">

            @include('charts.lesson-stats')

        </div>

    </div>
</div>
@endsection
