@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        {{ $product->name }}
    </h1>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Product details
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <p><strong>Naam: </strong>{{ $product->name }}</p>
                        <p><strong>Categorie: </strong>{{ $product->category_name }}</p>
                        <p><strong>Beschrijving: </strong>{{ $product->description }}</p>
                        <p>
                            <strong>Prijs (excl. BTW):</strong>
                            @if($discount)
                                @if(strtotime($discount->discount_start) <= strtotime('now') &&
                                    strtotime($discount->discount_end) >= strtotime('now'))
                                    <span class="discount oldprice">
                                        &euro; {{ $product->price }}
                                    </span>
                                    <span class="discount newprice">
                                        &euro; {{ $discounted_price = round($product->price - ($product->price * ($discount->percentage/100)),2) }}
                                    </span>
                                    ({{ $discount->percentage }}% korting)
                                @else
                                    <span>&euro; {{ $product->price }}</span>
                                @endif
                            @else
                                <span>&euro; {{ $product->price }}</span>
                            @endif
                        </p>
                        <p>
                            <strong>Prijs (incl. BTW): </strong>
                            @if($discount)
                                @if(strtotime($discount->discount_start) <= strtotime('now') &&
                                    strtotime($discount->discount_end) >= strtotime('now'))
                                    <span class="discount oldprice">
                                        &euro; {{ round($product->price*(1+$tax->tax_rate/100),2) }}
                                    </span>
                                    <span class="discount newprice">
                                        &euro; {{ round($discounted_price*(1+$tax->tax_rate/100),2) }}
                                    </span>
                                @else
                                    <span>&euro; {{ round($product->price*(1+$tax->tax_rate/100),2) }}</span>
                                @endif
                            @else
                                <span>
                                &euro; {{ round($product->price*(1+$tax->tax_rate/100),2) }}
                                </span>
                            @endif
                            ({{ $tax->tax_rate }}% BTW)
                        </p>
                        <p><strong>Calorieën: </strong>{{ $product->calories }}</p>
                        <p><strong>Producent: </strong>{{ $product->manufacturer_name }}</p>
                        <p>
                            <strong>Voorraad:</strong>
                            {{ $product->quantity }}
                            @if($product->quantity == 0)
                                <span class="label label-danger">NIET MEER BESCHIKBAAR</span>
                            @elseif($product->quantity < 50)
                                <span class="label label-warning">Bijna uit voorrraad</span>
                            @endif
                        </p>
                        <p><strong>Aangemaakt op: </strong>{{ $product->created_at }}</p>
                        <p><strong>Geupdate op: </strong>{{ $product->updated_at }}</p>
                        <p class="rating"><strong>Waardering:</strong>


                            @for ($i = 0; $i < floor($product->ratings->avgValue); $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @if(floor($product->ratings->avgValue) - $product->ratings->avgValue < 0)
                                <i class="fa fa-star-half-o"></i>
                            @endif

                            @for($i = 0; $i < 5 - ceil($product->ratings->avgValue); $i++)
                                <i class="fa fa-star-o"></i>
                            @endfor
                        ({{$product->ratings->n }} ratings)


                        </p>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset( $product->preview_url ) }}" id="preview" alt="{{$product->name}}"/>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ Form::open(['url' => 'product/'.$product->id, 'method'=>'DELETE', 'class'=>'delete']) }}
                    <a class="btn btn-default" href="{{$product->id}}/edit/"><i class="fa fa-pencil"></i> Bewerken</a>
                    {{ Form::button('<i class="fa fa-trash"></i> Verwijderen', ['class' => 'btn btn-warning', 'role' => 'button', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Product historiek</div>
                <div class="panel-body">
                    @if(count($priceHistory) || count($stockHistory))
                        <div>
                            <canvas id="lineChart" class="chart" width="300" height="300"></canvas>
                        </div>
                        <?php
                        $chartData = [];
                        $chartData['priceHistory'] = $priceHistory;
                        $chartData['stockHistory'] = $stockHistory;
                        $chartData['timeStamps'] = $timeStamps;
                        ?>

                        @include('partials.chart')
                    @else
                        <p>Data (nog) niet beschikbaar voor dit product.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop