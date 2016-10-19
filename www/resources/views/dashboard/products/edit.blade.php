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
        {!! Form::open(['url' => 'product/'.$product->id, 'method'=>'PUT',
                            'files' => true]) !!}
        <div class="col-md-6">
            @if($product->preview_url)
                <img src="{{ asset( $product->preview_url ) }}" id="preview" alt="{{$product->name}}" class="large-thumbnail"/>
            @else
                <p>No avatar uploaded.</p>
            @endif
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                {!! Form::label('image', 'Afbeelding') !!}
                {!! Form::file($name = 'image', $options = [
                                    'accept' => '.jpg,.jpeg,.png,.bmp,image/*', // @link http://www.iana.org/assignments/media-types/media-types.xhtml#image
                                    'class' => 'form-control'
                                ]) !!}
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Naam') !!}
                {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                {!! Form::label('category_id', 'Categorie') !!}
                {!! Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Beschrijving') !!}
                {!! Form::textarea('description', $product->description, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                {!! Form::label('price', 'Prijs') !!}
                {!! Form::text('price', $product->price, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('discount_id') ? ' has-error' : '' }}">
                {!! Form::label('discount_id', 'Korting') !!}
                <span class="text-right">
                    <a href="/discount/create">Toevoegen</a>
                </span>
                {!! Form::select('discount_id', $discounts, $product->discount_id == null ? 0 : $product->discount_id, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('tax_id') ? ' has-error' : '' }}">
                {!! Form::label('tax_id', 'BTW') !!}
                {!! Form::select('tax_id', $taxes, $product->tax_id, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                {!! Form::label('quantity', 'Aantal in voorraad') !!}
                {!! Form::text('quantity', $product->quantity, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('calories') ? ' has-error' : '' }}">
                {!! Form::label('calories', 'Calorieën') !!}
                {!! Form::text('calories', $product->calories, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group{{ $errors->has('manufacturer_id') ? ' has-error' : '' }}">
                {!! Form::label('manufacturer_id', 'Producent') !!}
                {!! Form::select('manufacturer_id', $manufacturers, $product->manufacturer_id, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::submit('Wijzigingen opslaan', ['class' => 'btn btn-default form-control', 'id'=>'confirm_button']) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>




@stop