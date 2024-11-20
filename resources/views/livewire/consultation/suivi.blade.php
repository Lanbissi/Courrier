<div class="row p-4 pt-5">
    <div class="col-md-12">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"> Suivi de l'évolution de courrier</h3>
        </div>
        
        
        <form role="form">
        <div class="card-body">

            <table class="table table-head-fixed text-nowrap table-striped">
                <thead>
                <tr>
                      <th style="width: 20%;">Courrier</th>
                      <th style="width: 20%;" class="text-center">Services ayant reçu</th>
                      <th style="width: 15%;" class="text-center">Date traitement réel</th>
                      <th style="width: 15%;" class="text-center">Délai traitement réel</th>
                      <th style="width: 15%;" class="text-center">Statut</th>
                </tr>
                </thead>
                <tbody>
                  @forelse ($courrierIdSuivi as $courrierIdSuivi)
                  <tr>
                    <td>{{ $courrierIdSuivi->numPrimaire}}</td>
                    <td class="text-center">{{ $courrierIdSuivi->code_fonction}}</td> 
                    <td class="text-center">{{ $courrierIdSuivi->dateFinReel}}</td>
                    <td class="text-center">{{ $courrierIdSuivi->dateFinTraitementReel}}</td>
                    <td class="text-center"></td>
                    @if ($courrierIdSuivi->statut == 1)
                     <td class="text-center"><p class="badge badge-success">Fin traitement</p></td>
                    @else
                     <td class="text-center"><p class="badge badge-danger">En cours de traitement</p></td>
                    @endif
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4">
                         <div class="alert alert-danger">
                             <h5><i class="icon fas fa-ban"></i> Information!</h5>
                              Aucun courrier n'a été affecté pour être suivi.
                         </div>
                    </td>
                  </tr>
                  @endforelse
                  
                  
                </tbody>
            </table>

        </div>
        
        <div class="card-footer">
        <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retour</button>
        </div>
        </form>
        </div>
        
        </div>
        
</div
