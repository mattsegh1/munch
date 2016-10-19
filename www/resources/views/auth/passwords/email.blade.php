@extends('layouts.auth')

<!-- Main Content -->
@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> {{ $error }}
            </div>
        @endforeach
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-signin" role="form" method="POST" action="{{ url('/password/email') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>E-Mail Address</label>

            <input type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                   </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">
                <i class="fa fa-btn fa-envelope"></i> Versturen
            </button>
            <div class="col-md-12">
                <a href="{{ url('/login') }}">
                    Terugkeren naar wachtwoord.</a>
            </div>

        </div>
    </form>
@endsection
