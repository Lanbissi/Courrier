<div class="row p-4 pt-5">
    <div class="col-md-4">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"> Instruction à suivre</h3>
        </div>
        
        
        <form role="form">
        <div class="card-body">

            <table class="table table-head-fixed text-nowrap table-striped">
                <thead>
                <tr>
                      <th>Pour</th>
                </tr>
                </thead>
                <tbody>
                  @forelse ($consigneCourrier as $consigneCourrier)
                  <tr>
                    <td>{{ $consigneCourrier->libAnnotation}}</td> 
                  </tr>
                  @empty
                  <tr>
                    <td colspan="1">
                         <div class="alert alert-danger">
                             <h5><i class="icon fas fa-ban"></i> Information!</h5>
                              Aucune consigne n'a été affecté pour ce courrier.
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
