<!-- resources/views/auth/reset.blade.php -->
<!-- OLD -->
@extends('auth')

@section('content')

            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> {{ $error }}
                    </div>
                    @endforeach
                    @endif
                            <!-- / error -->

                    <form class="form-signin" action="/password/reset" method="POST">
                        {!! csrf_field() !!}
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="E-mailadres" required autofocus>
                        <input type="password" name="password" class="form-control" placeholder="Nieuw wachtwoord" required>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Wachtwoord herhalen" required>
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Wachtwoord herstellen</button>
                    </form>
                    <!-- /form -->

@stop