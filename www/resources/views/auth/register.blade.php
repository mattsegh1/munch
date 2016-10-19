@extends('layouts.auth')

@section('content')
    <form class="form-signin" role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>Gebruikersnaam</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Gebruikersnaam">

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>E-Mailadres</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mailadres">

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

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label>Bevestig wacthwoord</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Bevestig wachtwoord">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">
                Registreer <i class="fa fa-pencil-square-o"></i>
            </button>
            <div class="col-md-12">
                <a href="{{ url('/login') }}">Hebt u al een account?</a>
            </div>
        </div>
    </form>
@endsection
