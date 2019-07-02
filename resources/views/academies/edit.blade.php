@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Academy
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($academy, ['route' => ['academies.update', $academy->AcademyID], 'method' => 'patch']) !!}

                        @include('academies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection