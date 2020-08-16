@extends('layouts.base',['title'=>'home'])

@section('content')
<h3>Publiez votre besoin</h3>
<div class="ml-5 pl-5 col-md-12 col-md-offset-2 col-sm-10 col-sm-offset-1">
    <form action="{{route('publication.store')}}" enctype="multipart/form-data"  method="post">
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
                 @foreach ($domains as $domain)
                      <option selected>Domain</option>
                       <option  value="{{$domain->id}}">{{$domain->name}}</option> 
                  @endforeach 
            </select>
            <select name="category" class=" custom-select  pl-5 pr-5 mb-2 " id="category">
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
        <input type="submit" id="title" class="form-control border-rounded"  value="Partager">
        </div>


   </form>
</div>


@endsection
