<div>
    <div class="row p-4 pt-5">
        <div class="col-12">
        <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des types d'annotation</h3>
        <div class="card-tools d-flex align-items-center">
            <a href="#" class="btn btn-link text-white mr-4 d-block" wire:click="toggleShowAddTypeAnnotationForm"> <i class="fas fa-plus"></i> Ajouter un type d'annotation</a>
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
        <th style="width: 50%;">Type annotation</th>
        <th style="width: 20%;" class="text-center">Ajouté</th>
        <th style="width: 30;" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
             @if ($isAddTypeAnnotation)
                 <tr>
                    <td colspan="2">
                        <input type="text" class="form-control @error('newTypeAnnotationName') is-invalid
                            
                        @enderror" wire:model="newTypeAnnotationName"  wire:keydown.enter="addTypeAnnotationNature" />
                        @error('newTypeAnnotationName')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </td>
                    <td class="text-center">
                        <button class="btn btn-link" wire:click="addTypeAnnotationNature"><i class="fa fa-check"></i> Valider</button>
                        <button class="btn btn-link" wire:click="toggleShowAddTypeAnnotationForm"><i class="fas fa-trash-alt"></i> Annuler</button>
                    </td>
                 </tr>
             @endif
             @foreach ($typeannotations as $typeannotation)
                 <tr>
                    <td>{{$typeannotation->libAnnotation}}</td>
                    <td class="text-center">{{optional($typeannotation->created_at)->diffForHumans()}}</td>
                    <td class="text-center">
                            <button class="btn btn-link" wire:click="editTypeAnnotation({{$typeannotation->id}})"><i class="far fa-edit"></i></button>
                            <button class="btn btn-link" wire:click="confirmDelete('{{$typeannotation->libAnnotation}}', {{$typeannotation->id}})"><i class="fas fa-trash-alt"></i></button>
                    </td>
                 </tr>
             @endforeach
        
        </tbody>
        </table>
        </div>
        
         <div class="card-footer">
            <div class="float-right">
                {{$typeannotations->links()}}
            </div>
         </div>
    
        </div>
        
        </div>
    </div>
    
    
</div>

<script>
    window.addEventListener("showEditForm",function(e){
       Swal.fire({
            title: "Edition nature courrier arrivé",
            input: 'text',
            inputValue: e.detail.typeannotation.libAnnotation, 
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modifier <i class="fa fa-check"></i>',
            cancelButtonText: 'Annuler <i class="fa fa-times"></i>',
            inputValidator: (value) => {
                if (!value) {
                return 'Champ obligatoire'
           }

           @this.updateTypeAnnotation(e.detail.typeannotation.id, value)
        }
    })
    })
</script>

<script>
    window.addEventListener("showSuccessMessage", event=>{
                     Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        toast: 'true',
                        title: event.detail.message || "Opération effectuée avec succès!",
                        showConfirmButton: 'false',
                        timer: '5000'
                     })
                })
</script>

<script>
    window.addEventListener("showConfirmMessage", event=>{
         Swal.fire({
                     title: event.detail.message.title,
                     text: event.detail.message.text,
                     icon: event.detail.message.type,
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Continuer!',
                     cancelButtonText: 'Annuler!'
                   }).then((result) => {
                     if(result.isConfirmed){
                        if (event.detail.message.data) {
                            @this.deleteTypeAnnotation(event.detail.message.data.type_Annotation_id)
                         }
                     }
                       
                  })

    })
</script>