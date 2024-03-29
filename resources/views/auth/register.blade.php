@extends('layouts.base',['title'=>"S'inscrir"])

@section('content')
<div class="content-section justify-content-center">

    @if (session()->has('message'))
    <div class='alert alert-danger  border-danger'>
        {{ session('message') }}
    </div>
    @endif
                    <form method="POST" class="justify-content-center pb-3" action="/donor/register" enctype="multipart/form-data" name="form" id='form'>
                        @csrf
 
                        <div class="d-flex justify-content-center">
                        <label  class="ml-5 mt-2 mb-2 " for="image"><img class="rounded-circle ml-2" src="{{asset('img/user.png')}}" alt=""></label>
                            <input type="file" hidden class="form-control-file" id="image" name="image">
                            {!! $errors->first('image','
                                <div class="text-danger p2" role="alert">
                                    <strong> :message </strong>
                                </div>')!!}
                          </div>

                        <div class="form-inline ml-5 pb-2 pl-5 d-flex justify-content-center">
                            <input type="radio" class=" d-inline-flexd ml-5" id="donateur" name="gender" checked="on" value="donateur" onclick="donor()">
                            <label for="donateur"  class=" ml-1 pr-4" >Donateur</label><br>
                            <input type="radio"  id="respresentant_check" class=" d-md-inline-flexd" id="membre" name="gender" value="female"   onclick="membre()">
                            <label class="ml-1 pr-4" for="membre" >Membre</label><br>
                            <input type="radio"  id="respresentant_check"class=" d-md-inline-flexd" id="demandeur" name="gender" value="female"   onclick="demandeur()">
                            <label class=" ml-1 pr-4" for="demandeur" >demandeur</label><br>
                            
                        </div>
                        
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Association') }}</label>
                            <div class="col-md-6 ">
                               <SELECT class="form-control" id="association" name="association" disabled >
                                  @foreach($associations as $association)
                                     <option class="dropdown-item" value="{{$association->id}}"> {{$association->name}}</option>
                                  @endforeach
                               </SELECT>
                           </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Prenom') }}</label>

                            <div class="col-md-6">
                                <input id="first_name"  type="text" class="form-control @error('name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  autocomplete="name" autofocus>

                                {!! $errors->first('first_name','
                                <div class="text-danger p2" role="alert">
                                    <strong> :message </strong>
                                </div>')!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="last_name"   type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autocomplete="name" autofocus>

                                {!! $errors->first('last_name','
                                <div class="text-danger p2" role="alert">
                                    <strong> :message </strong>
                                </div>')!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                {!! $errors->first('email','
                                <div class="text-danger p2" role="alert">
                                    <strong> :message </strong>
                                </div>')!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Tel') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="email" maxlength='10'>

                                {!! $errors->first('phone','
                                <div class="text-danger p2" role="alert">
                                    <strong> :message </strong>
                                </div>')!!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"  class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                {!! $errors->first('password','
                                <div class="text-danger p2" role="alert">
                                    <strong> :message </strong>
                                </div>')!!}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le  Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm"   type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                               
                               {!! $errors->first('password_confirmation','
                                <div class="text-danger p2" role="alert">
                                    <strong> :message </strong>
                                </div>')!!}
                            
                            </div>
                        </div>
                       

                       

                         
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn text-white orange col-md-12  " disabled>
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                
</div>
<script type="text/javascript">
    function membre(){
        document.getElementById('association').disabled=false;

   document.getElementById('form').action="/membre/register";
 }
   function donor(){
    document.getElementById('association').disabled=true;
    document.getElementById('form').action="/donor/register";
 }
 function demandeur(){
    document.getElementById('association').disabled=true;
   document.getElementById('form').action="/demandeur/register";
 }

</script>
@endsection

