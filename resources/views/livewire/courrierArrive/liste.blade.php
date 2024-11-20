<div>
    <div class="row p-4 pt-5">
        <div class="col-12">
        <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fa fa-list"></i> Liste courriers</h3>
        <div class="card-tools d-flex align-items-center">
            <a class="btn btn-link text-white mr-4 d-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter un nouveau courrier" wire:click="goToaddCourrier"> <i class="fas fa-plus"></i> </a>
        
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
        <th>Courrier</th>
        <th class="text-center" style="width: 20%;">Catégorie</th>
        <th class="text-center" style="width: 20%;">Statut d'envoi au directeur</th>
        <th style="width: 20%;" class="text-center">Ajouté</th>
        <th style="width: 40%;" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($courrierArrives as $courrierArrive )
              <tr>
                <td>Courrier n°{{$courrierArrive->numPrimaire}}</td>
                <td class="text-center">Courrier {{$courrierArrive->categorie}}</td>
                <td class="text-center">
                    @if ($courrierArrive->estEnvoyer == 1)
                        <span class="badge badge-success">Envoyé au directeur</span>
                    @else
                        <span class="badge badge-danger">Non envoyé</span>    
                    @endif
                </td>
                <td  class="text-center">{{optional($courrierArrive->created_at)->diffForHumans()}}</td>
                 
                    <td class="text-center">
                        <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Aperçu du courrier" wire:click="goToSee({{$courrierArrive->id}})"><i class="far fa-eye"></i></button>
                        <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Mettre à jour" wire:click="goToEditCourrierArrive({{$courrierArrive->id}})"><i class="far fa-edit"></i></button>
                        <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Transférer au directeur" wire:click="send({{$courrierArrive->id}})"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter des pièces jointes"  wire:click="goToAddpj({{$courrierArrive->id}})"><i class="fas fa-paperclip"></i></button>
                        <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer le courrier"  wire:click="confirmDelete('{{$courrierArrive->numPrimaire}}', {{$courrierArrive->id}})"><i class="fas fa-trash-alt"></i></button>
                    </td>
              </tr>

            @endforeach
        </tbody>
        </table>
        </div>
        
         <div class="card-footer">
            <div class="float-right">
               {{$courrierArrives->links()}}
            </div>
         </div>
    
        </div>
        
        </div>
    </div>
    
    
</div>
