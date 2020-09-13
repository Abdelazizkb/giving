@extends('multiauth::layouts.base')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body "><strong class="bg-light rounded p-2 border"> Ajouter un nouveau role </strong></div>

                <div class="card-body">
                    @include('multiauth::message')
                    <form action="{{ route('admin.role.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="role"> Nom de role</label>
                            <input type="text" placeholder="Donne un nom pour le role" name="name"
                                class="form-control" id="role" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Permissions</label>
                            <div class="container">
                                @foreach($permissions as $key => $value)
                                <label for="role">{{$key}}</label>
                                <div class="d-flex justify-content-between">
                                    @foreach($value as $permission)
                                    <div class="form-group">
                                        <label for="{{$permission->id}}">{{$permission->name}}</label>
                                        <input type="checkbox" name="permissions[]" class="form-control"
                                            value="{{$permission->id}}" id="{{$permission->id}}">
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                        <a href="{{ route('admin.roles') }}" class="btn btn-sm btn-danger float-right">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection