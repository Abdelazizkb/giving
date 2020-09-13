<div class="container">
    <h2 class="text-secondary bg-white border rounded p-1 mb-2">La list de demandeurs</h2>
    <div class="row ">
        <div class="col-md-12">
            <div class="card p-2">
              
                <div class="row col-md-6 ml-2 mt-1 mb-1">
                    <label class="text-muted " for="query">Rechercher :</label>
                    <input type="text" wire:model="query" class="form-control" name="query" id="query"
                        placeholder="Ex: Ahmed rekibi">
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    
                    <table class="table table-striped border">
                        <thead>
                            <tr>
                             
                              </tr>
                          <tr>
                            <th scope="col"></th>
                            
                            <th scope="col">Prenom</th>
                            <th scope="col">Nom</th>

                            <th scope="col">Email</th>
                            <th scope="col">Statu</th>
                            <th scope="row"></th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandeurs as $demandeur)
                          <tr>
                            <th scope="row"></th>
                            <td>{{ $demandeur->last_name }}</td>
                            <td>{{ $demandeur->first_name }}</td>
                            <td>{{ $demandeur->email }}</td>

                            <th scope="row"><span class="badge">
                                {{ $demandeur->is_active? 'Active' : 'Inactive' }}

                            </span></th>
                            <td>
                                @if ($demandeur->is_active)

                                <a href="{{route('deactivate',['type'=>'demandeurs','id'=>$demandeur])}}"" class=" btn
                                    btn-sm btn-default  mr-3 ">Bloquer</a>
                                @else
                                <a href="{{route('activate',['type'=>'demandeurs','id'=>$demandeur])}}"" class=" btn
                                  btn-sm btn-default  mr-3 ">Debloquer</a>
                                @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table> 
                    @if($demandeurs->count()==0)
                        <p>Aucun demandeur </p>
                        @endif

                    
                </div>
                <div class="align-self-center">{{ $demandeurs->links('vendor.pagination.bootstrap-4') }}</div>

            </div>
        </div>
    </div>
</div>



