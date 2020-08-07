@extends('layouts.base')

@section('content')
<div class="container">
    
@if($code ?? '')

<div class="content-section">
    <p class="p-2 pl-4 ml-5 border-bottom">  Un code de verefication envoye a votre numero</p> 

          <form method="post" id='form' action="{{ route('verify') }}" >
              @csrf
         
              <div class="form-group row">
                  <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                  <div class="col-md-2">
                      <input id="code" type="text" placeholder="######" class="form-control @error('code') is-invalid @enderror" name="code"  required  autofocus>

                      @error('code')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

             
            

              <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn text-white orange border-orange">
                          {{ __('Submit') }}
                      </button>

                      
                          <a class="btn btn-link" href="#">
                              {{ __("J'ai pas recu") }}
                          </a>
                      
                  </div>
              </div>
          </form>
      
</div>
@endif



    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                    {{ __('You are logged in! as donor') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
