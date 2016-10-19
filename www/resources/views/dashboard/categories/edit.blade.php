@extends('layouts.app')

@yield('message')

@section('content')
    <h1 class="page-header">Product aanpassen</h1>




    <div class="row">
        <div class="col-md-12">
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="row">
        {!! Form::open(['url' => 'category/'.$category->id, 'method'=>'PUT']) !!}
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Beschrijving') !!}
                {!! Form::textarea('description', $category->description, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Wijzigingen opslaan', ['class' => 'btn btn-default form-control', 'id'=>'confirm_button']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>




@stop