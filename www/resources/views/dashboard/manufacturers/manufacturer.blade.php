@extends('layouts.app')

@section('content')
    <h1 class="page-header">{{ $manufacturer->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Producent Details
                </div>
                <div class="panel-body">
                    @if(!$manufacturer->logo_url)
                        Deze producent heeft geen logo ingesteld.
                    @else
                        <img src="{{ asset($manufacturer->logo_url) }}" alt="{{$manufacturer->name}}'s logo"
                             id="preview" class="large-thumbnail"/>
                    @endif

                    <p><strong>Naam: </strong>{{ $manufacturer->name }}</p>
                    <p><strong>Toegevoegd op: </strong>{{ $manufacturer->created_at }}</p>
                    <p><strong>Bijgewerkt op: </strong>{{ $manufacturer->updated_at }}</p>
                </div>
                <div class="panel-footer">
                    {{ Form::open(['url' => 'manufacturer/'.$manufacturer->id, 'method'=>'DELETE', 'class'=>'delete']) }}
                    <a class="btn btn-default" href="{{$manufacturer->id}}/edit/"><i class="fa fa-pencil"></i> Bewerken</a>
                    {{ Form::button('<i class="fa fa-trash"></i> Verwijderen', ['class' => 'btn btn-warning', 'role' => 'button', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Producten van producent</div>
                <table class="table table-striped">
                    <tr>
                        <th>PID</th>
                        <th>Product</th>
                        <th>Prijs</th>
                        <th>URL</th>
                    </tr>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td><a href="{{ url('/product/'.$product->id) }}">Detail</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@stop