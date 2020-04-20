@extends('layouts.app')

@section('content')
    <section class="content-header">
        <form class="pull-right" action="{{ route('login-as') }}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-default">Login-as</button>
            <input type="hidden" name="account_id" value="{{ $account->AccountID }}">
        </form>
        <h1>
            Account
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('accounts.show_fields')
                    <a href="{!! route('accounts.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
