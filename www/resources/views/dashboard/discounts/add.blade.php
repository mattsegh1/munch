@extends('layouts.app')

@yield('message')

@section('content')
    <h1 class="page-header">Korting toevoegen</h1>

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
        {!! Form::open(['url' => 'discount']) !!}
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Naam') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('percentage') ? ' has-error' : '' }}">
                {!! Form::label('percentage', 'Percentage') !!}
                {!! Form::number('percentage', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('discount_start') ? ' has-error' : '' }}
                                  {{ $errors->has('discount_end') ? ' has-error' : '' }}">
                {!! Form::label('discount_start', 'Begindatum korting') !!}
                {!! Form::text('discount_start', null, ['class' => 'form-control datepicker']) !!}
                {!! Form::label('discount_end', 'Einddatum korting') !!}
                {!! Form::text('discount_end', null, ['class' => 'form-control datepicker']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Toevoegen', ['class' => 'btn btn-default form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop