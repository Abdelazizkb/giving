@extends('layouts.base',['title'=>'home'])

@section('content')
<div class="content-section justify-content-center">

<h3>Publiez votre besoin @include('partials._createdomain')
</h3>

    <form class="p-3" action="{{route('publication.store')}}" enctype="multipart/form-data"  method="post">
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
        <select name="domain" class=" custom-select  pl-5 pr-5  mb-2" id="domain">
            <option selected>Domain</option>
                 @foreach ($domains as $domain)
                       <option  value="{{$domain->name}}">{{$domain->name}}</option> 
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
 
            <select name="category" class=" custom-select  pl-5 pr-5 ml-5 mb-2 " id="category">
                   @foreach ($categories as $category)
                         <option selected>Categorie</option>
                        <option value="{{$category->id}}">{{$category->name}}</option> 
                    @endforeach 
            </select>
            
             <div class="d-inline-block ml-5">
               <label for="image" ><i class="fa fa-plus" aria-hidden="true"></i> <i class="fa fa-image fa-2x m-1 "></i></label>           
               <input type="file" hidden id="image" name="image">
               {!! $errors->first('image','
               <div class="text-danger p2" role="alert">
                   <strong> :message </strong>
               </div>')!!}
            </div>

        </div>
        
        

        <input type="file"
               id="avatar" name="avatar"
               accept="image/png, image/jpeg" hidden id="image" name="image">


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
        <input type="submit" id="title" class="form-control border-rounded orange text-white"  value="Partager">
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
