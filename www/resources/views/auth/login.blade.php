@extends('layouts.auth')

@section('content')
    @if(count($errors))
        <!-- error alert example -->
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
        <!-- / error -->
    @endif

    <form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>E-mailadres</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                   placeholder="E-mailadres">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label>Wachtwoord</label>
            <input type="password" class="form-control" name="password" placeholder="Wachtwoord">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>


        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Aangemeld blijven
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="login">
                Aanmelden <i class="fa fa-btn fa-sign-in"></i>
            </button>
        </div>
    </form>

    @if (Auth::guest())
        <div class="col-md-6">
            <a class="" href="{{ url('/password/reset') }}">Geen toegang tot uw account?</a>
        </div>
        <div class="col-md-6">
            <a class="" href="{{ url('/register') }}">
                Nog niet geregistreerd?</a>
        </div>
    @else

    @endif
@endsection
