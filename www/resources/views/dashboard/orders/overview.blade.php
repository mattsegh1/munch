@extends('layouts.app')

@section('content')
    <h1 class="page-header">Orders</h1>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['method'=>'GET', 'class'=>'form-inline', 'role'=>'form']) }}
            <div class="form-group">
                <div class="btn-group">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-filter"></i> Status
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="clearfilter">Clear filter(s)</a></li>
                            @foreach($statuses as $status)
                                <li>
                                    <a href="filter={{ $status->name }}" class="SortFilter">
                                        {{ $status->name }}
                                    </a>
                                </li>
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
                            <li><a href="sort=id" class="SortFilter">Order #</a></li>
                            <li><a href="sort=status" class="SortFilter">Status</a></li>
                            <li><a href="sort=first_name" class="SortFilter">Geplaatst door</a></li>
                            <li><a href="sort=created_at" class="SortFilter">Geplaatst op</a></li>
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
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(count($orders))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Status</th>
                            <th>Geplaatst door</th>
                            <th>Geplaatst op</th>
                            <th>Laatste wijziging op</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id  }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td class="actions">
                                    <a href="{{ url('order/'.$order->id) }}" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('order/'.$order->id.'/edit') }}" title="Edit"><i
                                                class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>
                    Er werden geen resultaten gevonden.
                </p>
            @endif
        </div>
    </div>




@stop