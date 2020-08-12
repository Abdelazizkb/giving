@extends('layouts.base')

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Retrouvez votre compte') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('password-search',['type'=>'donor'])}}" id="form">
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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Tel') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script type="text/javascript">
                function membre(){
               document.getElementById('form').action="{{route('password-search',['type'=>'membre'])}}";
             }
               function donor(){
               document.getElementById('form').action="{{route('password-search',['type'=>'donor'])}}";
             }
             function demandeur(){
               document.getElementById('form').action="{{route('password-search',['type'=>'demandeur'])}}";
             }
            
            </script>
@endsection
