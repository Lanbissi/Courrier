<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="d-flex my-4 bg-gray-light p-3">
            <div class="d-flex flex-grow-1 mr-2">
                <div class="flex-grow-1 mr-2">
                    <input type="text" placeholder="Code fonction" class="form-control @error('code') is-invalid
                        
                    @enderror" wire:model="code">
                    @error('code')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="flex-grow-1 mr-2">
                    <input type="text" placeholder="Libellé fonction" class="form-control @error('libelle') is-invalid
                        
                    @enderror" wire:model="libelle">
                    @error('libelle')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="flex-grow-1">
                    <select class="form-control @error("direction") is-invalid
                        
                    @enderror" wire:model="direction">
                          <option>====Choisissez une direction====</option>
                          @foreach ($directions as $direction)
                            <option value="{{$direction->id}}">{{$direction->lib_direction}}</option> 
                          @endforeach  
                    </select>
                    @error("direction")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div>
                <button class="btn btn-success mr-2" wire:click.prevent="addFonction()">Ajouter</button>
                <button class="btn btn-success" wire:click.prevent="editFonction()">Modifier</button>
            </div>
        </div>
    <div class="card">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
    <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des fonctions</h3>
    <div class="card-tools d-flex align-items-center">
        <a href="#" class="btn btn-link text-white mr-4 d-block"></a>
    <div class="input-group input-group-md" style="width: 250px;">
    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
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
    <th style="width: 15%;">Code fonction</th>
    <th style="width: 35%;" class="text-center">libellé fonction</th>
    <th style="width: 25%;" class="text-center">Ajouté</th>
    <th style="width: 25%;" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($fonctions as $fonction) 
         <tr>
            <td>{{$fonction->code_fonction}}</td>
            <td class="text-center">{{$fonction->lib_fonction}}</td>
            <td class="text-center">{{ optional($fonction->created_at)->diffForHumans() }}</td>
            <td class="text-center">
                <button class="btn btn-link" wire:click="goToEditFonction({{$fonction->id}})"><i class="far fa-edit"></i></button>
                <button class="btn btn-link" wire:click="confirmDelete('{{$fonction->lib_fonction}}', {{$fonction->id}})"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
        @endforeach
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
                            @this.deleteUser(event.detail.message.data.fonction_id)
                         }
                     }
                       
                  })

    })
</script>
