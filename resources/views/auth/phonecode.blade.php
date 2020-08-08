
<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" >
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/fontawesome.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css') }}">

   
        <title>{{ $title ?? 'home' }}</title>
  
</head>
<body>
 <main role="main" class="container ">
     <div class="row pt-5 pl-5" >
        <div class="col-md-8 pt-5 pl-5"> 
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
        </div>
     </div>
 </main>
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
</body>
</html>
