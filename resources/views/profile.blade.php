@extends('layouts.base',['title'='membre'])

@section('content')
    <div class="content-section">
      <div class="media">
        <img class="rounded-circle account-img" src="{{ user.profil.image.url }}">
        <div class="media-body">
          <h2 class="account-heading">{{ user.username }}</h2>
          <p class="text-secondary">{{ user.email }}</p>
        </div>
      </div>
      <form method="POST" enctype="multipart/form-data">
          {% csrf_token %}
          <fieldset class="form-group">
              <legend class="border-bottom mb-4">Profile Info</legend>
              {{ u_form|crispy }}
              {{ p_form|crispy }}
          </fieldset>
          <div class="form-group">
              <button class="btn btn-outline-info" type="submit">Update</button>
          </div>
      </form>

    </div>
@endsection
