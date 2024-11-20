<div class="row p-4 pt-5">
    <div class="col-md-12">
    <div class="card">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
    <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des envois</h3>
    <div class="card-tools d-flex align-items-center">
        <a class="btn btn-link text-white mr-4 d-block"></a>
    <div class="input-group input-group-md" style="width: 250px;">
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
      <th style="width: 10%;">Numéro primaire</th>
      <th style="width: 15%;" class="text-center">Catégorie</th>
      <th style="width: 15%;" class="text-center">Date fin traitement théorique</th>
      <th style="width: 30%;" class="text-center">Délai de traitement</th>
      <th style="width: 30%;" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
      @forelse ($courriers as $courrier)
      <tr>
        <td>Courrier n°{{$courrier->numPrimaire}}</td>
        <td>Courrier {{$courrier->categorie}}</td>
        <td class="text-center"> {{date('d-m-Y', strtotime($courrier->dateFinTraitementTheorique))}}</td>
        <td class="text-center">{{$courrier->delaiTheorique}} jour(s)</td>
        <td class="text-center">
            <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Aperçu de l'annotation" wire:click="aperçuAnnotation({{$courrier->id}})"><i class="far fa-eye"></i></button>
            <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Modififier l'annotation" wire:click="goToEditAnnote({{$courrier->id}})"><i class="far fa-edit"></i></button>
            <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter des pièces jointes" wire:click="goToAddpj({{$courrier->id}})"><i class="fas fa-paperclip"></i></button>
            <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Fin de traitement" wire:click="valider({{$courrier->id}})"><i class="fa fa-check"></i></button>
            <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Suivre le courrier" wire:click="suivi({{$courrier->id}})"><i class="fas fa-chart-bar"></i></button>
        </td>
      </tr> 
      @empty
      <tr>
        <td colspan="5">
             <div class="alert alert-info">
                 <h5><i class="icon fas fa-ban"></i> Information!</h5>
                 Vous n'avez aucun courrier en instance d'annotation.
             </div>
        </td>
      </tr>
      @endforelse
  
    </tbody>
    </tbody>
    </table>
    </div>
    
     <div class="card-footer">
        
     </div>

    </div>
    
    </div>
  </div> 