<div>
    <div class="row p-4 pt-5">
        <div class="col-7">
        <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des courriers arrivés</h3>
        <div class="card-tools d-flex align-items-center">
            <a class="btn btn-link text-white mr-4 d-block"></a>
        </div>
        </div>
        
        <div class="card-body table-responsive p-0" style="height: 200px;">
        <table class="table table-head-fixed text-nowrap table-striped">
        <thead>
        <tr>
        <th style="width: 25%;">Numéro primaire</th>
        <th style="width: 35%;" class="text-center">Catégorie</th>
        <th style="width: 40%;" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
          @forelse ($courriers as $courrier)

          <tr>
            <td>Courrier n°{{$courrier->numPrimaire}}</td>
            <td class="text-center">Courrier {{$courrier->categorie}}</td>
            <td class="text-center">
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Aperçu du courrier" wire:click="goToSee({{$courrier->id}})"><i class="far fa-eye"></i></button>
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Annotation & transfert" wire:click="goToAnnote({{$courrier->id}})"><i class="fa fa-paper-plane"></i></button>
            </td>
          </tr>

          @empty
            <tr>
              <td colspan="3">
                   <div class="alert alert-info">
                       <h5><i class="icon fas fa-ban"></i> Information!</h5>
                       Vous n'avez aucun courrier en instance d'annotation.
                   </div>
              </td>
            </tr>
          @endforelse
              
        </tbody>
        </table>
        </div>
        
         <div class="card-footer">
            <div class="float-right">
               
            </div>
         </div>
    
        </div>
        
        </div>
    </div>

</div>
