@extends('layouts.base',['title'=>' cree annonce'])

@section('content')
<h3>Publiez votre annonce</h3>
<div class="ml-5 pl-5 col-md-12 col-md-offset-2 col-sm-10 col-sm-offset-1">
    <form action="{{route('annonce.store')}}" enctype="multipart/form-data"  method="post">
    @csrf
        <div class="d-block form-group row">
            <label class="d-block" for="title"> Titre</label>
            <input type="text" id="title" class="form-control"  name="title"/>
            {!! $errors->first('title','
            <div class="text-danger p2" role="alert">
                <strong> :message </strong>
            </div>')!!}
       </div>



       <div class="d-block form-inline  row">    
           <select name="domain" class=" custom-select  pl-5 pr-5 mr-5 mb-2" id="domain">
            <option selected>Domain</option>
                   @foreach ($domains as $domain)
                       <option  value="{{$domain->id}}">{{$domain->name}}</option> 
                  @endforeach 
            </select>
            <div class="dropdown d-inline-block">
                <button class="btn btn-default dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-plus"></i>
                </button>
                <div class="dropdown-menu p-4">
                  <div class="form-group">
                    <label for="name">Nom de domain</label>
                    <input type="text" class="form-control m-1"  id="domainname" name="domainname" >
                  </div>
             
                  <button type="button"  class="btn btn-primary "  onclick="add_domain()" >ajouter</button>
              </div>
              </div>

            
            <div class="d-inline-block ml-5">
               <label for="image" ><i class="fa fa-plus" aria-hidden="true"></i> <i class="fa fa-image fa-2x m-1 "></i></label>           
               <input type="file" hidden id="image" accept="image/png, image/jpeg"  name="image">
               {!! $errors->first('image','
               <div class="text-danger p2" role="alert">
                   <strong> :message </strong>
               </div>')!!}
            </div>

        </div>
        
        
        <div class="d-block form-group row">
            <label class="d-block" for="date"> Date  de l'evenement </label>
             <input type="date" id="date" name="date" class="form-control">
             {!! $errors->first('date','
             <div class="text-danger p2" role="alert">
                 <strong> :message </strong>
             </div>')!!}
        </div>
        <div class="d-block form-group row">
            <label class="d-block" for="body"> Description </label>
            <textarea  class="form-control"  rows="12" id="body" name="body">
            </textarea>
            {!! $errors->first('body','
            <div class="text-danger p2" role="alert">
                <strong> :message </strong>
            </div>')!!}
       </div>
         

       <div class="d-block form-group row">
        <input type="submit" id="title" class="form-control border-rounded"  value="Partager">
        </div>


   </form>
</div>
<script>
    function add_domain(){
    var domain=document.getElementById('domain');
    var option=document.createElement('option');
    var inputVal = document.getElementById("domainname");
    
    option.value=inputVal.value;
    option.selected=true;
    option.innerText=inputVal.value;
    console.log(option);
    domain.appendChild(option);
    
    }
      </script>

@endsection
