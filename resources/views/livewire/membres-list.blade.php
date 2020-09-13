<div class="container">
    <h2 class="text-secondary bg-white border rounded p-1 mb-2">La list de membres</h2>
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
                            @foreach ($membres as $membre)
                          <tr>
                            <th scope="row"></th>
                            <td>{{ $membre->last_name }}</td>
                            <td>{{ $membre->first_name }}</td>
                            <td>{{ $membre->email }}</td>

                            <th scope="row"><span class="badge">
                                {{ $membre->is_active? 'Active' : 'Inactive' }}

                            </span></th>
                            <td>
                                @if ($membre->is_active)

                                <a href="{{route('deactivate',['type'=>'membres','id'=>$membre])}}"" class=" btn
                                    btn-sm btn-default  mr-3 ">Bloquer</a>
                                @else
                                <a href="{{route('activate',['type'=>'membres','id'=>$membre])}}"" class=" btn
                                  btn-sm btn-default  mr-3 ">Debloquer</a>
                                @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table> 
                    @if($membres->count()==0)
                        <p>Aucun demandeur </p>
                        @endif

                    
                </div>
                <div class="align-self-center">{{ $membres->links('vendor.pagination.bootstrap-4') }}</div>

            </div>
        </div>
    </div>
</div>



