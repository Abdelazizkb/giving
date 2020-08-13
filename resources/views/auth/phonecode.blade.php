@extends('layouts.base')

@section('content')

           <div class="content-section pt-2">

              <p class="p-2 pl-4 ml-5 border-bottom">  Un code de verefication envoye a votre numero de telephone</p> 

                    <form method="post" id='form' action="{{ route('verify',['type'=>$type]) }}" >
                        @csrf
                   
                        <div class="form-group row ">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                            <div class="col-md-2">
                            
                                <input id="code" type="text" maxlength="6" placeholder="######" onclick="codetest()" oninput="codetest()" onkeypress="codetest()" class="form-control @error('code') is-invalid @enderror" name="code"  required  autofocus>
                            </div>
                        </div>
                   
                       
                      

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" id='verifybtn'class="btn text-white orange border-orange" disabled>
                                    {{ __('Submit') }}
                                </button>

                                
                                    <a class="btn btn-link" href="{{route('resendcode',['type'=>$type])}}">
                                        {{ __("J'ai pas recu ") }}
                                    
                                    </a>
                                
                            </div>
                        </div>
                    </form>
                
               </div>

<script type="text/javascript">

               function codetest(){
               code=document.getElementById('code').value.length;
               console.log(code);
               if(code==6){
               document.getElementById('verifybtn').disabled=false;
               }
               else
               document.getElementById('verifybtn').disabled=true;

               }
</script>

@endsection