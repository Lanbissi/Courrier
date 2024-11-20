<div class="row p-4 ">
    <div class="col-md-5">
        <div class="d-flex my-4 bg-gray-light p-3">
            <div class="d-flex mr-2">
                <div class="mr-2">
                  <form enctype="multipart/form-data">
                    <label for="">Choisir un fichier</label>
                    <input type="file" class="@error('fichier') is-invalid
                        
                    @enderror" wire:model="fichier" multiple>
                    @error('fichier.*')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                   </form>
                </div>
            </div>
            <div style="margin-bottom: 3px;">
                <button class="btn btn-success mr-2 mt-4" wire:click.prevent="addPJ()">Ajouter</button>
            </div>   
        </div>

        <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des pièces jointes</h3>
            
            </div>
            
            <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap table-striped">
            <thead>
            <tr>
            <th style="width: 50%;">Pièce jointe</th>
            <th style="width: 50%;" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($pj as $pj)
                <tr>
                    <td>{{$pj->pjNumerise}}</td>
                    <td class="text-center">
                        <button class="btn btn-link" wire:click="seePj({{$pj->id}})"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-link" wire:click="confirmDeletepj({{$pj->id}})"><i class="fas fa-trash-alt"></i></button>
                    </td>
                  </tr>
                @empty
                <tr>
                    <td colspan="2">
                         <div class="alert alert-danger">
                             <h5><i class="icon fas fa-ban"></i> Information!</h5>
                              Aucune pièce n'est jointe à ce courrier.
                         </div>
                    </td>
                  </tr>
                @endforelse  
            </tbody>
            </table>
            </div>
            
             <div class="card-footer">
                <div class="float-right">
                    <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retour</button>
                </div>
             </div>
        
            </div>
   
    </div>
    <div class="col-md-7 pt-5" style="margin-top: 97px;">
        @forelse ($apercudelaPJ as $apercudelaPJ)
        <iframe src="{{asset('fichier/fichier')}}/{{$apercudelaPJ->pjNumerise}}" height="550" width="500" style="background: gray" class="col-md-12" height="426"></iframe>
        @empty
           <iframe src="" class="col-md-12" height="426" style="background: gray"></iframe>
        @endforelse      
    </div>
</div>
















