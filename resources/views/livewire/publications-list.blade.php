<div class="card-body mx-auto">
    <div class="post-section bg-white rounded mb-3 col-md-12 p-3" id="filter_box">
        <h3 class="">Faire un filtre :</h3>
        <strong> Selon : </strong>
        <p class="bg-light  mr-2 d-inline-block p-1 rounded">{{$type?$type:'Type' }}</p>
        <p class="bg-light  mr-2 d-inline-block p-1 rounded">{{'Domain' }}</p>
        <p class="bg-light  d-inline-block p-1 rounded">{{'Categorie' }}</p>





        <div class="input-group mb-3 mt-2">
            <input type="text" class="form-control" wire:model="query" name="query" id="query"
                placeholder="Ex: Aider moi ..." aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <span class="input-group-text text-white orange" id="basic-addon2"><i class="fa fa-search"></i></span>
            </div>
        </div>

        <div class="input-group mb-3">
            <select class="custom-select" wire:model="type" id="inputGroupSelect02">
                <option selected value="">Tout</option>
                <option value="demande">Demande</option>
                <option value="donation">Donation</option>
            </select>
            <div class="input-group-append">
                <label class="input-group-text text-white orange" for="inputGroupSelect02">type</label>
            </div>
        </div>

        <div class="input-group mb-3">
            <select class="custom-select" wire:model="domain" id="inputGroupSelect02">
                <option selected value="">Tout...</option>
                @foreach ($domains as $domain)
                <option value="{{$domain->id}}">{{$domain->name}}</option>

                @endforeach
            </select>
            <div class="input-group-append">
                <label class="input-group-text  text-white orange" for="inputGroupSelect02">Domain</label>
            </div>
        </div>
        <div class="input-group mb-3">
            <select class="custom-select" wire:model="category" id="inputGroupSelect02">
                <option selected>Tout...</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>

                @endforeach
            </select>
            <div class="input-group-append">
                <label class="input-group-text text-white orange" for="inputGroupSelect02">Categorie</label>
            </div>
        </div>

    </div>


    <!--    <article class=" post-section p-4 pl-5" id="filter_box">
        <div class="media mt-3 ">
            <div class="input-group  m-2 col-md-12">
                <input type="text" wire:model="query" name="query" id="query" class="form-control "
                    placeholder="Ex:aider moi..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text orange  " id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="media mt-3 mx-auto">
            <select class="custom-select col-md-4" wire:model="type" name="type_post" id="type_post" multiple>
                <option value="" selected>Type</option>
                <option value="demande">Demande</option>
                <option value="donation">Aide</option>
            </select>

        </div>
    </article>-->
    @include('multiauth::message')
    <ul class="list-group">
        @foreach ($publications->sortbydesc("created_at") as $publication)
        <article class="post-section">
            <div class=" d-block w-100  p-2 ">
                <img class="rounded-circle account-icon"
                    src="{{asset('storage/'.$publication->publicatable->image->image )}}">
                <div class="d-inline-block  ">
                    <a class="d-block " href="{{route('profile-visite',['user'=> $publication])}}">
                        {{ $publication->publicatable->first_name  }}
                    </a>
                    <small class="text-muted ">{{ \Carbon\Carbon::parse($publication->created_at)->format('d/m/Y') }}</small>

                </div>
                @auth('admin')


                <div class="dropdown d-inline-block float-right  m-2">
                    <button class="btn btn-default dropdown p-0  bg-white" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge-warning badge-pill ml-2">
                            {{ $publication->active? 'Active' : 'Inactive' }}
                        </span> </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if ($publication->active)

                        <a href="{{route('deactivate',['type'=>'publications','id'=>$publication])}}"" class=" btn
                            btn-sm btn-default border-secondary mr-3 dropdown-item">Masquer</a>
                        @else
                        <a href="{{route('activate',['type'=>'publications','id'=>$publication])}}"" class=" btn
                          btn-sm btn-default border-secondary mr-3 dropdown-item">Afficher</a>
                        @endif
                    </div>
                </div>
                @endauth
                <h2><a class="article-title d-inline "
                        href="{{route('publication.show',[$publication])}}">{{ $publication->title }}</a></h2>

            </div>

            <img src="{{asset('storage/'.$publication->image->image)}}" alt=""
                class="  d-block h-75 w-100 rounded-bottom">

        </article>
        @endforeach @if($publications->count()==0)
        <p>Aucune publication </p>
        @endif
        <div class="align-self-center mt-2">{{ $publications->links() }}</div>

    </ul>

</div>