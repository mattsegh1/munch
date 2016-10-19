@extends('layouts.app')

@section('content')
    <h1 class="page-header">Producten</h1>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['method'=>'GET', 'class'=>'form-inline', 'role'=>'form']) }}
            <div class="form-group">
                <div class="btn-group" role="group" aria-label="overview-controls">
                    <a href="{{ url('product/create') }}" class="btn btn-default">
                        <i class="fa fa-plus"></i> Toevoegen
                    </a>

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-filter"></i> Categorie
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="clearfilter">Clear filter(s)</a></li>
                            @foreach($categories_list as $cat)
                                <li><a href="filter={{$cat}}" class="SortFilter">{{$cat}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-sort-amount-asc"></i> Sorteer</span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="sort=name" class="SortFilter">Naam</a></li>
                            <li><a href="sort=category_name" class="SortFilter">Categorie</a></li>
                            <li><a href="sort=price" class="SortFilter">Prijs</a></li>
                            <li class="hidden-xs"><a href="sort=calories" class="SortFilter">Calorieën</a></li>
                            <li class="hidden-xs"><a href="sort=manufacturer_name" class="SortFilter">Producent</a></li>
                            <li class="hidden-xs hidden-sm"><a href="sort=created_at" class="SortFilter">Toegevoegd
                                    op</a>
                            </li>
                            <li class="hidden-xs hidden-sm"><a href="sort=updated_at" class="SortFilter">Bijgewerkt
                                    op</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    {{ Form::text('search',null,['placeholder'=>'Zoeken naar...', 'class'=>'form-control']) }}
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                {{ Form::select('searchby',['products.name'=>'Naam','manufacturers.name'=>'Producent'],null,['class'=>'form-control']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(count($products))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Categorie</th>
                            <th>Prijs (Excl. BTW)</th>
                            <th class="hidden-xs">Calorieën</th>
                            <th class="hidden-xs">Producent</th>
                            <th class="hidden-xs hidden-sm">Toegevoegd op</th>
                            <th class="hidden-xs hidden-sm">Bijgewerkt op</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->category_name}}</td>
                                @if(strtotime($item->discount_start) <= strtotime('now') &&
                                    strtotime($item->discount_end) >= strtotime('now'))
                                    <td>&euro; <span class="discount oldprice">{{ $item->price }}</span>
                                        <span>{{ round($item->price - ($item->price * $item->discount / 100),2) }}</span>
                                    </td>
                                @else
                                    <td>&euro; {{$item->price}}</td>
                                @endif
                                <td class="hidden-xs">{{$item->calories}}</td>
                                <td class="hidden-xs">{{$item->manufacturer_name}}</td>
                                <td class="hidden-xs hidden-sm">{{$item->created_at}}</td>
                                <td class="hidden-xs hidden-sm">{{$item->updated_at}}</td>
                                <td class="actions">
                                    {{ Form::open(['url' => 'product/'.$item->id, 'method'=>'DELETE', 'class'=>'delete']) }}
                                    <a href="{{ url('product/'.$item->id) }}" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('product/'.$item->id.'/edit') }}" title="Edit"><i
                                                class="fa fa-pencil"></i></a>
                                    {{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'text_button', 'role' => 'button', 'type' => 'submit', 'id' => 'delete'.$item->id]) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            @else
                <div>
                    Er werden geen resultaten gevonden.
                </div>
            @endif
        </div>
    </div>
@stop