@extends('layouts.app')

@yield('message')

@section('content')
    <h1 class="page-header">Producent aanpassen</h1>
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
        {!! Form::open(['url' => 'manufacturer/'.$manufacturer->id, 'method'=>'PUT',
                            'files' => true]) !!}
        <div class="col-md-12">
            @if($manufacturer->logo_url)
                <img src="{{ asset($manufacturer->logo_url) }}" alt="{{$manufacturer->name}}'s logo" id="preview"
                     class="large-thumbnail"/>
            @else
                <p>Geen logo ingesteld.</p>
            @endif

            <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                {!! Form::label('logo', 'Logo') !!}
                {!! Form::file('logo') !!}
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Naam') !!}
                {!! Form::text('name', $manufacturer->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Wijzigingen opslaan', ['class' => 'btn btn-default form-control', 'id'=>'confirm_button']) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
@stop