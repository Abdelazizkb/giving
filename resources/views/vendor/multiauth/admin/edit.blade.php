@extends('multiauth::layouts.base') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body "><strong class="card p-2 bg-light rounded "> les information de {{$admin->name}}</strong></div>

                <div class="card-body">
                    @include('multiauth::message')
                    <form action="{{route('admin.update',[$admin->id])}}" method="post">
                        @csrf @method('patch')
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Nom d'utilisateur</label>
                            <input type="text" value="{{ $admin->name }}" name="name" class="form-control col-md-6" id="role">
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Email</label>
                            <input type="text" value="{{ $admin->email }}" name="email" class="form-control col-md-6" id="role">
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right"> Role</label>

                            <select name="role_id[]" id="role_id" class="form-control col-md-6 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" multiple>
                                <option selected disabled>Sélectionné Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" 
                                        @if (in_array($role->id,$admin->roles->pluck('id')->toArray())) 
                                            selected 
                                        @endif >{{ $role->name }}
                                    </option>
                                @endforeach
                            </select> 

                            @if ($errors->has('role_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span> 
                            @endif
                        </div>

                        <div class="form-group block">
                            <label for="active" class="col-md-4 col-form-label text-md-right d-inline-block">Activer</label>
                            <input type="checkbox" value="1" {{ $admin->active ? 'checked':'' }} name="activation" class="p-2 d-inline-block" id="active">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Confirmer
                                </button>
                                <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm float-right">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
