@extends('layouts.app')

@section('content')
    <h1 class="page-header">Order #{{ $order_details[0]->order_id }} details</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Order Details
                </div>
                <div class="panel-body">
                    <p><strong>Order nummer: </strong>{{ $order_details[0]->order_id }}<br/>
                        <strong>Geplaatst op: </strong>{{ $order_details[0]->created_at }}<br/>
                        <strong>Door: </strong>{{ $order_details[0]->first_name }} {{$order_details[0]->last_name}}<br/>
                        <strong>Laatst gewijzigd: </strong>{{ $order_details[0]->updated_at }}</p>
                    <p><strong>Status:</strong> {{$order_details[0]->status}} <br/>
                        {{ $order_details[0]->status_desc }}</p>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-default" href="{{ url('order/'.$order_details[0]->order_id.'/edit') }}"><i
                                class="fa fa-pencil"></i> Bewerken</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Bestelde producten
                </div>
                @if(count($order_products))
                <table class="table table-striped">
                    <tr>
                        <th>Product</th>
                        <th>Hoeveelheid</th>
                        <th>Prijs</th>
                    </tr>
                    @foreach($order_products as $product)
                        <tr>
                            <td>{{ $product->product }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                    <p class="text-center">Order bevat geen producten.</p>
                @endif
                <div class="panel-footer">
                    <strong>Saldo:</strong>
                    @if(count($saldo))
                         &euro; {{ $saldo->total_price }}
                    @else
                        &euro; 0.00
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop