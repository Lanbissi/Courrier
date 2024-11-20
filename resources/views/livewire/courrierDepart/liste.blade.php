<div>
    <div class="row p-4 pt-5">
        <div class="col-md-12">
        <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1">Liste des courriers départs</h3>
        <div class="card-tools d-flex align-items-center">
            <a class="btn btn-link text-white mr-4 d-block" wire:click="goToaddCourrier"> <i class="fas fa-plus"></i></a>
        <div class="input-group input-group-md" style="width: 200px;">
        <input type="text" name="table_search" class="form-control float-right" placeholder="Recherche" wire:model.debounce.500ms="search">
        <div class="input-group-append">
        <button type="submit" class="btn btn-default">
        <i class="fas fa-search"></i>
        </button>
        </div>
        </div>
        </div>
        </div>
        
        <div class="card-body table-responsive p-0" style="height: 300px;">
        <table class="table table-head-fixed text-nowrap table-striped">
        <thead>
        <tr>
        <th class="text-center">Numéro primaire</th>
        <th class="text-center">Catégorie</th>
        <th class="text-center">Destinataire</th>
        <th class="text-center">Objet</th>
        <th class="text-center">Observation</th>
        <th class="text-center">Statut d'envoi au directeur</th>
        <th class="text-center" class="text-center">Ajouté</th>
        <th class="text-center" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($courrierdeparts as $courrierdepart)
              <tr>
                <td class="text-center">Courrier {{$courrierdepart->numPrimaire}}</td>
                <td class="text-center">{{$courrierdepart->categorie}}</td>
                <td class="text-center">{{$courrierdepart->destinataire}}</td>
                <td class="text-center">{{$courrierdepart->objet}}</td>
                <td class="text-center">{{$courrierdepart->observation}}</td>
                <td class="text-center">
                    @if ($courrierdepart->estEnvoyer == 1)
                        <span class="badge badge-success">Envoyé au directeur</span>
                    @else
                        <span class="badge badge-danger">Non envoyé</span>    
                    @endif
                </td>
                <td class="text-center">{{ optional($courrierdepart->created_at)->diffForHumans() }}</td>
                <td class="text-center">
                    <button class="btn btn-link" wire:click="goToEditCourrierDepart({{$courrierdepart->id}})"><i class="far fa-edit"></i></button>
                    <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Transférer au directeur" wire:click="send({{$courrierdepart->id}})"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    <button class="btn btn-link" wire:click="confirmDelete({{$courrierdepart->id}})"><i class="fas fa-trash-alt"></i></button>
                </td>
              </tr>
            @endforeach  
        </tbody>
        </table>
        </div>
        
         <div class="card-footer">
            <div class="float-right">
               {{$courrierdeparts->links()}}
            </div>
         </div>
    
        </div>
        
        </div>
    </div>
    
    
</div>
