@extends('layouts.app')

@section('content')
    <h1 class="page-header">{{ $category->name }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Categorie Details
                </div>
                <div class="panel-body">
                    <p><strong>Naam: </strong>{{ $category->name }}</p>
                    <p><strong>Beschrijving: </strong>{{ $category->description }}</p>
                </div>
                <div class="panel-footer">
                    {{ Form::open(['url' => 'category/'.$category->id, 'method'=>'DELETE', 'class'=>'delete']) }}
                    <a class="btn btn-default" href="{{$category->id}}/edit/"><i class="fa fa-pencil"></i> Bewerken</a>
                    {{ Form::button('<i class="fa fa-trash"></i> Verwijderen', ['class' => 'btn btn-warning', 'role' => 'button', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop