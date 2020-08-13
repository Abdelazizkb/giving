@extends('layouts.base',['title'=>'home'])

@section('content')
<div class="container">
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

                    @auth('donor')                       
                        {{ __('You are logged in! as donor') }}
                    @endauth
                    @auth('membre')
                    {{ __('You are logged in! as membre') }}
                    @endauth
                    @auth('demandeur')
                    {{ __('You are logged in! as demandeur') }}
                    @endauth
                    @auth('representant')
                    {{ __('You are logged in! as representant') }}
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
