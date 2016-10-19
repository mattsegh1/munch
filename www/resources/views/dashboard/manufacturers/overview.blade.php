@extends('layouts.app')

@section('content')
    <h1 class="page-header">Producenten</h1>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['method'=>'GET', 'class'=>'form-inline', 'role'=>'form']) }}
            <div class="form-group">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ url('manufacturer/create') }}" class="btn btn-default">
                            <i class="fa fa-plus"></i> Toevoegen
                        </a>

                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-sort-amount-asc"></i> Sorteer</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="sort=name" class="SortFilter">Naam</a></li>
                            <li><a href="sort=created_at" class="SortFilter">Toegevoegd</a></li>
                            <li><a href="sort=updated_at" class="SortFilter">Bijgewerkt</a></li>
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
            @if(count($manufacturers))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Toegevoegd op</th>
                            <th>Bijgewerkt op</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($manufacturers as $man)
                            <tr>
                                <td>{{ $man->name  }}</td>
                                <td>{{ $man->created_at }}</td>
                                <td>{{ $man->updated_at }}</td>
                                <td class="actions">
                                    {{ Form::open(['url' => 'manufacturer/'.$man->id, 'method'=>'DELETE', 'class' => 'delete']) }}
                                    <a href="{{ url('manufacturer/'.$man->id) }}" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('manufacturer/'.$man->id.'/edit') }}" title="Edit"><i class="fa fa-pencil"></i></a>
                                    {{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'text_button', 'role' => 'button', 'type' => 'submit']) }}
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