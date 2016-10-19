@extends('layouts.app')

@yield('message')

@section('content')
    <h1 class="page-header">Categorie toevoegen</h1>

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
        {!! Form::open(['url' => 'category/all']) !!}
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Naam') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Beschrijving') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Toevoegen', ['class' => 'btn btn-default form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop