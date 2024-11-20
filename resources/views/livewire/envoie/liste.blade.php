<div class="row p-4 pt-5">
    <div class="col-10">
    <div class="card">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
    <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des envois</h3>
    </div>
    
    <div class="card-body table-responsive p-0" style="height: 300px;">
    <table class="table table-head-fixed text-nowrap table-striped">
    <thead>
    <tr>
    <th style="width: 10%;">Numéro Primaire</th>
    <th style="width: 20%;" class="text-center">Catégorie</th>
    <th style="width: 25%;" class="text-center">Type annotation</th>
    <th style="width: 45%;" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($annotations as $annotation)
          <tr>
            <td>Courrier n°{{$annotation->courrier->numPrimaire}}</td>
            <td class="text-center">Courrier {{$annotation->courrier->categorie}}</td>
            @if ($annotation->types->implode("libAnnotation", ' | '))
             <td class="text-center">{{$annotation->types->implode("libAnnotation", ' | ')}}</td>
            @else
             <td class="text-center"><p class="badge badge-danger">Aucune instruiction en cour</p></td>
            @endif
            
            <td class="text-center">
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Aperçu annotation" wire:click="aperçuAnnotation({{$annotation->id}})"><i class="far fa-eye"></i></button>
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier l'annotation" wire:click="goToEditAnnote({{$annotation->id}})"><i class="far fa-edit"></i></button>
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter des pièces jointes" wire:click="goToAddpj({{$annotation->id}})"><i class="fas fa-paperclip"></i></button>
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Suivre le courrier" wire:click="suivi({{$annotation->id}})"><i class="fas fa-chart-bar"></i></button>
            </td>
          </tr>
        @endforeach  
    </tbody>
    </table>
    </div>
    
     <div class="card-footer">
        <div class="float-right">
           {{$annotations->links()}}
        </div>
     </div>

    </div>
    
    </div>
  </div>