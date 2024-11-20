<div class="row p-4 pt-5">
    <div class="col-6">
        <div class="d-flex my-4 bg-gray-light p-3">
            <div class="d-flex mr-2">
                <div class=" mr-2">
                    <input type="file" class="@error('fichier') is-invalid
                        
                    @enderror" wire:model="fichier">
                    @error('fichier')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                </div>
            </div>
            <button class="btn btn-success mr-2" wire:click.prevent="addPJ()">Ajouter</button>
        </div>
    <div class="card">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
    <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des pièces jointes</h3>
    <div class="card-tools d-flex align-items-center">
        <a href="#" class="btn btn-link text-white mr-4 d-block"></a>
    </div>
    </div>
    </div>
    
    <div class="card-body table-responsive p-0" style="height: 300px;">
    <table class="table table-head-fixed text-nowrap table-striped">
    <thead>
    <tr>
    <th style="width: 15%;">Pièce jointe</th>
    <th style="width: 25%;" class="text-center">Ajouté</th>
    <th style="width: 25%;" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
        @forelse ($pj as $pj)
        <tr>
            <td> {{$pj->pjNumerise}}</td>
            <td class="text-center">{{ optional($pj->created_at)->diffForHumans() }}</td>
            <td class="text-center">
                <button class="btn btn-link" wire:click="seePj({{$pj->id}})"><i class="fas fa-eye"></i></button>
                <button class="btn btn-link" wire:click="confirmDelete({{$pj->id}})"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
        @empty
        <tr>
            <td colspan="3">
                 <div class="alert alert-info">
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
            
        </div>
     </div>

    </div>
    <div class="col-6">
        <div class="row p-4">
             <div class="col-12">
                @foreach ($apercudelaPJ as $apercudelaPJ)
                   <iframe src="{{asset('fichier/fichier')}}/{{$apercudelaPJ->pjNumerise}}" height="500" width="500"></iframe>
                @endforeach
             </div>
        </div>
    </div>
    </div>

</div>
















 