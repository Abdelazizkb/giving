@extends('layouts.base',['title'=>'Connexion'])

@section('content')
<div class="content-section">
   
                

                
                    <form method="post" id='form' action="{{ route('Login',['type'=>'donor']) }}" >
                        @csrf
                        <div class="form-inline ml-5 pb-2 pl-5">
                            <input type="radio" class=" d-inline-flexd ml-5" id="donateur" name="gender" checked="on" value="donateur" onclick="donor()">
                            <label for="donateur"  class=" ml-1 pr-4" >Donateur</label><br>
                            <input type="radio"  id="respresentant_check"class=" d-md-inline-flexd" id="membre" name="gender" value="female"   onclick="membre()">
                            <label class="ml-1 pr-4" for="female" >Membre</label><br>
                            <input type="radio"  id="respresentant_check"class=" d-md-inline-flexd" id="membre" name="gender" value="female"   onclick="demandeur()">
                            <label class=" ml-1 pr-4" for="female" >demandeur</label><br>
                            
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Tel') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

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
                                        {{ __('Enregistrer') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn text-white orange border-orange">
                                    {{ __('Connexion') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublie?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                
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
