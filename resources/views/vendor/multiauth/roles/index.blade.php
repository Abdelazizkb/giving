@extends('multiauth::layouts.base')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <strong class=" p-2">    List de roles </strong>
                    @permitTo('CreateRole')
                    <span class="float-right">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-default orange text-white">Nouveau Role</a>
                    </span>
                    @endpermitTo
                </div>

                <div class="card-body">
                    @include('multiauth::message')
                    <ol class="list-group">
                        @foreach ($roles as $role)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $role->name }}
                            <span class="badge badge-primary badge-pill">{{ $role->admins->count() }} {{
                                ucfirst(config('multiauth.prefix')) }}</span>
                            <span class="badge badge-warning badge-pill">{{ $role->permissions->count() }}
                                Permissions</span>
                            <div class="float-right">
                                @permitTo('DeleteRole,UpdateRole')
                                <a href="" class="btn btn-sm btn-default border-secondary mr-3"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">Supprimer</a>
                                <form id="delete-form-{{ $role->id }}"
                                    action="{{ route('admin.role.delete',$role->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf @method('delete')
                                </form>
                                @endpermitTo

                                @permitTo('UpdateRole')
                                <a href="{{ route('admin.role.edit',$role->id) }}"
                                    class="btn btn-sm  btn-default border-secondary mr-3">Modifier</a>
                                @endpermitTo
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection