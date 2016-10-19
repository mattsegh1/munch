@extends('layouts.app')

@section('content')
    <h1 class="page-header">{{ $customer->first_name }} {{ $customer->last_name }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Klant detail
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        @if($customer->avatar_url != "")
                            <img src="{{ $customer->avatar_url }}" id="preview" class="large-thumbnail"/>
                        @else
                            <img src="{{ asset('img/default_avatar.png') }}" id="preview" class="large-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h3>Contact gegevens</h3>
                        <p><strong>Naam: </strong>{{ $customer->first_name }} {{ $customer->last_name }} <br/>
                            <strong>Klant sinds: </strong>{{ $customer->created_at }}</p>
                        <p><strong>Email:</strong> {{$customer->email}}</p>
                        <p><strong>Adres:</strong> {{$customer->street}} te {{ $customer->city }}
                            in {{ $customer->country }}</p>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ Form::open(['url' => 'customer/'.$customer->customer_id, 'method'=>'DELETE', 'class'=>'delete']) }}
                    <a class="btn btn-default" href="{{$customer->customer_id}}/edit/"><i class="fa fa-pencil"></i>
                        Bewerken</a>
                    {{ Form::button('<i class="fa fa-trash"></i> Verwijderen', ['class' => 'btn btn-warning', 'role' => 'button', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-star fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$customer->ratings->n}}</div>
                            <div>Ratings geplaatst</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-bag fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$customer->orders->n}}</div>
                            <div>Orders</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">&euro;
                                @if($customer->revenue->TOTAL)
                                    {{$customer->revenue->TOTAL}}
                                @else
                                    0.00
                                @endif
                            </div>
                            <div>Omzet</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop