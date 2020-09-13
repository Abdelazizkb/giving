<div class="card-body mx-auto">
    @include('multiauth::message')
    <ul class="list-group">
        @foreach ($annonces->sortbydesc("created_at") as $annonce)
        <article class="post-section">
            <div class=" d-block w-100  p-2 ">
                <img class="rounded-circle account-icon"
                    src="{{asset('storage/'.$annonce->association->image->image )}}">
                <div class="d-inline-block  ">
                    <a class="d-block " href="{{route('profile-visite',['user'=> $annonce])}}">
                        {{ $annonce->association->name  }}
                    </a>
                    <small class="text-muted ">{{ \Carbon\Carbon::parse($annonce->created_at)->format('d/m/Y') }}</small>

                </div>
                @auth('admin')


                <div class="dropdown d-inline-block float-right  m-2">
                    <button class="btn btn-default dropdown p-0  bg-white" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge-warning badge-pill ml-2">
                            {{ $annonce->active? 'Active' : 'Inactive' }}
                        </span> </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if ($annonce->active)

                        <a href="{{route('deactivate',['type'=>'annonces','id'=>$annonce])}}"" class=" btn
                            btn-sm btn-default border-secondary mr-3 dropdown-item">Masquer</a>
                        @else
                        <a href="{{route('activate',['type'=>'annonces','id'=>$annonce])}}"" class=" btn
                          btn-sm btn-default border-secondary mr-3 dropdown-item">Afficher</a>
                        @endif
                    </div>
                </div>
                @endauth
                <h2><a class="article-title d-inline "
                        href="{{route('publication.show',[$annonces])}}">{{ $annonce->title }}</a></h2>

            </div>

            <img src="{{asset('storage/'.$annonce->image->image)}}" alt=""
                class="  d-block h-75 w-100 rounded-bottom">

        </article>
        @endforeach @if($annonces->count()==0)
        <p>Aucune annonce </p>
        @endif
        <div class="align-self-center mt-2">{{ $annonces->links() }}</div>

    </ul>
</div>
