@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="post" id='form' action="{{ route('Login',['type'=>'donor']) }}" >
                        @csrf
                        <div class="form-inline p-1">
                            <input type="radio" class=" d-inline-flexd" id="donateur" name="gender" checked="on" value="donateur" onclick="donor()">
                            <label for="donateur"  class=" pr-4" >Donateur</label><br>
                            <input type="radio"  id="respresentant_check"class=" d-md-inline-flexd" id="membre" name="gender" value="female"   onclick="membre()">
                            <label class="pr-4" for="female" >Membre</label><br>
                            <input type="radio"  id="respresentant_check"class=" d-md-inline-flexd" id="membre" name="gender" value="female"   onclick="demandeur()">
                            <label class="pr-4" for="female" >demandeur</label><br>
                            
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function membre(){
   document.getElementById('form').action="{{ route('Login',['type'=>'membre']) }}";
  
 }
   function donor(){
   document.getElementById('form').action="{{ route('Login',['type'=>'donor']) }}";
 }
 function demandeur(){
   document.getElementById('form').action="{{ route('Login',['type'=>'demandeur']) }}";
 }
</script>
@endsection
