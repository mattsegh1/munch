@extends('layouts.app')

@section('content')
    <h1 class="page-header">Ratings</h1>
    <div class="row">
        <div class="col-md-12">
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="fa fa-sort-amount-asc"></i> Sorteer</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="sort=name" class="SortFilter">Product</a></li>
                    <li><a href="sort=username" class="SortFilter">Gebruiker</a></li>
                    <li><a href="sort=value" class="SortFilter">Waarde</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(count($ratings))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Geplaatst door</th>
                            <th>Waarde</th>
                            <th>Geplaatst op</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ratings as $rating)
                            <tr>
                                <td>
                                    <a href="{{ url('product/'.$rating->product_id) }}">{{ $rating->name  }}</a>
                                </td>
                                <td>
                                    <a href="{{ url('customer/'.$rating->customer_id) }}">{{ $rating->username }}</a>
                                </td>
                                <td>{{ $rating->value }}</td>
                                <td>{{ $rating->created_at }}</td>
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