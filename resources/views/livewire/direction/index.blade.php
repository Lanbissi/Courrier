<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="d-flex my-4 bg-gray-light p-3">
            <div class="d-flex flex-grow-1 mr-2">
                <div class="flex-grow-1 mr-2">
                    <input type="text" placeholder="Code direction" class="form-control @error('code') is-invalid
                        
                    @enderror" wire:model="code">
                    @error('code')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="flex-grow-1">
                    <input type="text" placeholder="Libellé direction" class="form-control @error('libelle') is-invalid
                        
                    @enderror" wire:model="libelle">
                    @error('libelle')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div>
                <button class="btn btn-success mr-2" wire:click.prevent="addDirection()">Ajouter</button>
                <button class="btn btn-success" wire:click.prevent="editDirection()">Modifier</button>
            </div>
        </div>
    <div class="card">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
    <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des directions</h3>
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
    <th style="width: 15%;">Code direction</th>
    <th style="width: 35%;" class="text-center">libellé direction</th>
    <th style="width: 25%;" class="text-center">Ajouté</th>
    <th style="width: 25%;" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($directions as $direction) 
         <tr>
            <td>{{$direction->code_direction}}</td>
            <td class="text-center">{{$direction->lib_direction}}</td>
            <td class="text-center">{{ optional($direction->created_at)->diffForHumans() }}</td>
            <td class="text-center">
                <button class="btn btn-link" wire:click="goToEditDirection({{$direction->id}})"><i class="far fa-edit"></i></button>
                <button class="btn btn-link" wire:click="confirmDelete('{{$direction->lib_direction}}', {{$direction->id}})"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
        @endforeach
    </tbody>
    </table>
    </div>
    
     <div class="card-footer">
        <div class="float-right">
            {{$directions->links()}}
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
                            @this.deleteUser(event.detail.message.data.direction_id)
                         }
                     }
                       
                  })

    })
</script>
