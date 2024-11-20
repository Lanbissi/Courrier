<div class="row p-4 pt-5">
    <div class="col-md-12">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"> Niveau de réception de courrier </h3>
        </div>
        
        
        <div class="card-body">

            <table class="table table-head-fixed text-nowrap table-striped">
                <thead>
                <tr>
                      <th style="width: 20%;">Courrier</th>
                      <th style="width: 20%;" class="text-center">Récepteur</th>
                      <th style="width: 15%;" class="text-center">Objet</th>
                      <th style="width: 15%;" class="text-center">Date d'envoi</th>
                </tr>
                </thead>
                <tbody>
                  @forelse ($courrierIdSuivi as $courrierIdSuivi)
                  <tr>
                    <td>Courrier n°{{ $courrierIdSuivi->numPrimaire}}</td>
                    <td class="text-center">{{ $courrierIdSuivi->code_fonction}}</td>
                    <td class="text-center">{{ $courrierIdSuivi->objet}}</td>  
                    <td class="text-center">{{ $courrierIdSuivi->created_at}}</td>
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
        
</div>



<div class="row p-4 pt-5">
  <div class="col-md-12">

      <div class="card card-primary">
      <div class="card-header">
      <h3 class="card-title"> Suivi de l'évolution du courrier à chaque niveau de réception</h3>
      </div>
      
      
      <div class="card-body">

          <table class="table table-head-fixed text-nowrap table-striped">
              <thead>
              <tr>
                    <th style="width: 20%;">Récepteur / Réceptrice</th>
                    <th style="width: 20%;" class="text-center">Date fin traitement réel</th>
                    <th style="width: 15%;" class="text-center">Délai théorique</th>
                    <th style="width: 15%;" class="text-center">Délai réel</th>
                    <th style="width: 15%;" class="text-center">Statut traitement</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($courrierStat as $courrierStat)
                <tr>
                  <td>{{ $courrierStat->code_fonction}}</td>
                  <td class="text-center">{{ $courrierStat->dateFinReel}}</td>
                  <td class="text-center">{{ $courrierStat->delaiTheorique}}</td>  
                  <td class="text-center">{{ $courrierStat->delaiReel}}</td>
                  <td class="text-center">
                    @if ($courrierStat->envoyerautreagent == 1)
                    <span class="badge badge-success">Traitement achevé</span>
                    @else
                    <span class="badge badge-danger">Non traité</span>
                    @endif
                  </td>
                  
                </tr>
                @endforeach
              </tbody>
          </table>

      </div>
      
      <div class="card-footer">
      <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retour</button>
      </div>
      </form>
      </div>
      
      </div>
      
</div>



