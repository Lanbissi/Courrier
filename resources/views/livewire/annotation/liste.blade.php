<div>
    <div class="row p-4 pt-5">
        <div class="col-md-12">
        <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des courriers à traiter</h3>
        <div class="card-tools d-flex align-items-center">
            <a class="btn btn-link text-white mr-4 d-block"></a>
        <div class="input-group input-group-md" style="width: 250px;">
        <div class="input-group-append">
        </div>
        </div>
        </div>
        </div>
        
        <div class="card-body table-responsive p-0" style="height: 200px;">
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
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Aperçu du courrier" wire:click="goToSee({{$courrier->id}})"><i class="far fa-eye"></i></button>
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir les instructions" wire:click="consigne({{$courrier->id}})"><i class="fa fa-question-circle"></i></button>
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Annoter & transférer" wire:click="goToAnnote({{$courrier->id}})"><i class="fa fa-paper-plane"></i></button>
                <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Continuer pour mettre fin au traitement" wire:click="mettreFin({{$courrier->id}})"><i class="fa fa-arrow-right"></i></button>
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


