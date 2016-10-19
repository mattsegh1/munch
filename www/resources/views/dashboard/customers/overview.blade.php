@extends('layouts.app')

@section('content')
    <h1 class="page-header">Klanten</h1>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['method'=>'GET', 'class'=>'form-inline', 'role'=>'form']) }}
            <div class="form-group">
                <div class="btn-group" role="group" aria-label="overview-controls">
                    <a href="{{ url('customer/create') }}" class="btn btn-default">
                        <i class="fa fa-plus"></i> Toevoegen
                    </a>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-sort-amount-asc"></i> Sorteer</span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="sort=first_name" class="SortFilter">Voornaam</a></li>
                            <li><a href="sort=last_name" class="SortFilter">Achternaam</a></li>
                            <li><a href="sort=created_at" class="SortFilter">Klant sinds</a></li>
                            <li><a href="sort=updated_at" class="SortFilter">Bijgewerkt op</a></li>
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
            @if(count($customers))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Klant sinds</th>
                            <th>Bijgewerkt op</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $cust)
                            <tr>
                                <td>{{ $cust->first_name }}</td>
                                <td>{{ $cust->last_name }}</td>
                                <td>{{ $cust->created_at }}</td>
                                <td>{{ $cust->updated_at }}</td>
                                <td class="actions">
                                    {{ Form::open(['url' => 'customer/'.$cust->id, 'method'=>'DELETE', 'class' => 'delete']) }}
                                    <a href="{{ url('customer/'.$cust->id) }}" title="View"><i
                                                class="fa fa-eye"></i></a>
                                    @if(!$cust->deleted_at)
                                        <a href="{{ url('customer/'.$cust->id.'/edit') }}" title="Edit"><i
                                                    class="fa fa-pencil"></i></a>
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'text_button', 'role' => 'button', 'type' => 'submit']) }}
                                        {{ Form::close() }}

                                    @endif
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