@extends('layouts.app')

@section('content')
    <h1 class="page-header">Dashboard</h1>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $generalData['customers']->n }}</div>
                            <div>Actieve gebruikers</div>
                        </div>
                    </div>
                </div>
                <a href="/customer">
                    <div class="panel-footer">
                        <span class="pull-left">Bekijk Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-star fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $generalData['ratings']->n }}</div>
                            <div>Waarderingen</div>
                        </div>
                    </div>
                </div>
                <a href="/rating">
                    <div class="panel-footer">
                        <span class="pull-left">Bekijk Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                &euro;
                                @if($generalData['revenues']->amount)
                                    {{ $generalData['revenues']->amount }}
                                @else
                                    0.00
                                @endif
                            </div>
                            <div>Totale opbrengst</div>
                        </div>
                    </div>
                </div>
                <a href="#revenue">
                    <div class="panel-footer">
                        <span class="pull-left">Bekijk Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-bag fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $generalData['orders']->n }}</div>
                            <div>Verwerkte orders</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('/order?filter=delivered')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Bekijk Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">Meest verkochte producten</div>
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Productnaam</th>
                        <th># verkocht</th>
                        <th>URL</th>
                    </tr>
                    @foreach($bestProducts as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->nSold}}</td>
                            <td><a href="{{ url('/product/'.$product->id) }}">Link</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">Best beoordeelde producten</div>
                <table class="table table-striped rating">
                    <tr>
                        <th>ID</th>
                        <th>Productnaam</th>
                        <th>Rating</th>
                        <th>URL</th>
                    </tr>
                    @foreach($mostRated as $rated)
                        <tr>
                            <td>{{ $rated->id }}</td>
                            <td>{{ $rated->name }}</td>
                            <td>
                                @for ($i = 0; $i < floor($rated->avg_rating); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @if(floor($rated->avg_rating) - $rated->avg_rating < 0)
                                    <i class="fa fa-star-half-o"></i>
                                @endif

                                @for($i = 0; $i < 5 - ceil($rated->avg_rating); $i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor

                                ({{$rated->nRatings }})
                            </td>
                            <td><a href="{{ url('/product/'.$rated->id) }}">Link</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">Beste Klant(en)</div>
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Naam</th>
                        <th>Gekochte omzet</th>
                        <th>URL</th>
                    </tr>
                    @foreach($bestCustomers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                            <td>{{$customer->Total_Price}}</td>
                            <td><a href="{{ url('/customer/'.$customer->id) }}">Link</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop