@extends('layouts.app')

@section('stylesheets')
    <link href="<?= asset('css/users.css'); ?>" rel="stylesheet">
@stop

@yield('message')

@section('content')
    <h1 class="page-header">Gebruiker aanpassen</h1>

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
        {!! Form::open(['url' => 'customer/'.$customer->customer_id,'method'=>'PUT']) !!}
        <div class="col-sm-3 col-md-6">

            <h3 class="sub-header">Klanten gegegevens</h3>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                {!! Form::label('first_name', 'Voornaam') !!}
                {!! Form::text('first_name', $customer->first_name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                {!! Form::label('last_name', 'Achternaam') !!}
                {!! Form::text('last_name', $customer->last_name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'E-mail') !!}
                {!! Form::text('email', $customer->email, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                {!! Form::label('street', 'Straat') !!}
                {!! Form::text('street', $customer->street, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                {!! Form::label('city_id', 'Stad') !!}
                {!! Form::select('city_id', $cities, $customer->city_id, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <h3 class="sub-header">Gebruikers gegegevens</h3>
            <div class="form-group">
                {!! Form::label('username', 'Username') !!}
                {!! Form::text('username', $customer->username, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Wachtwoord') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Wachtwoord herhalen') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                {!! Form::submit('Wijzigingen opslaan', ['class' => 'btn btn-default form-control']) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
@stop