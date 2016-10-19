@extends('layouts.app')

@yield('message')

@section('content')
    <h1 class="page-header">Order aanpassen</h1>
    <div class="row">
        <div class="col-md-12">
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="row">
        {!! Form::open(['url' => 'order/'.$order[0]->order_id,'method'=>'PUT']) !!}
        <div class="col-md-12">
            <strong>Order #:</strong> {{ $order[0]->order_id }}


            <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                {!! Form::label('status_id', 'Status') !!}
                {!! Form::select('status_id', $list_statuses, $order[0]->status_id, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Wijzigingen opslaan', ['class' => 'btn btn-default form-control', 'id'=>'confirm_button']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>



@stop