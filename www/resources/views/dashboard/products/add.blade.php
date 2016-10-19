@extends('layouts.app')

@yield('message')

@section('content')
    <h1 class="page-header">Product toevoegen</h1>

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
        {!! Form::open(['url' => 'product',
                    'files' => true]) !!}
        <div class="col-md-6">

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Naam') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                {!! Form::label('image', 'Afbeelding') !!}

                {!! Form::file($name = 'image', $options = [
                                    'accept' => '.jpg,.jpeg,.png,.bmp,image/*', // @link http://www.iana.org/assignments/media-types/media-types.xhtml#image
                                    'class' => 'form-control'
                                ]) !!}
            </div>
            <div class="form-group{{ $errors->has('manufacturer_id') ? ' has-error' : '' }}">
                {!! Form::label('manufacturer_id', 'Producent') !!}
                {!! Form::select('manufacturer_id', $manufacturers, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                {!! Form::label('category_id', 'Categorie') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Beschrijving') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                {!! Form::label('price', 'Prijs') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('discount_id') ? ' has-error' : '' }}">
                {!! Form::label('discount_id', 'Korting') !!}

                <span class="text-right">
                    <a href="/discount/create">Toevoegen</a>
                </span>
                {!! Form::select('discount_id', $discounts, 0, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('tax_id') ? ' has-error' : '' }}">
                {!! Form::label('tax_id', 'BTW') !!}
                {!! Form::select('tax_id', $taxes, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('calories') ? ' has-error' : '' }}">
                {!! Form::label('calories', 'Calorieën') !!}
                {!! Form::text('calories', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::submit('Toevoegen', ['class' => 'btn btn-default form-control', 'id' => 'btn-submit']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>



@stop