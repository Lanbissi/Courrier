<div class="row p-4 pt-5">
    <div class="col-12">
    <div class="card">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
    <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des utilisateurs</h3>
    <div class="card-tools d-flex align-items-center">
        <a href="#" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToaddUser()"> <i class="fas fa-user-plus"></i> Nouvel utilisateur</a>
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
    <th style="width: 25%;">Utilisateur</th>
    <th style="width: 25%;" class="text-center">Roles</th>
    <th style="width: 20%;" class="text-center">Ajouté</th>
    <th style="width: 30;" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>

        @foreach ($users as $user )
         <tr>
            <td>{{$user->prenom}} {{$user->nom}}</td>
            <td class="text-center">{{$user->roles->implode("nom", ' | ')}}</td>
            <td class="text-center"><span class="tag tag-success">{{$user->created_at->diffforHumans()}}</span></td>
            <td class="text-center">
                <button class="btn btn-link" wire:click="goToEditUser({{$user->id}})"><i class="far fa-edit"></i></button>
                <button class="btn btn-link" wire:click="confirmDelete('{{$user->prenom}} {{$user->nom}}', {{$user->id}})"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
        @endforeach
    
    </tbody>
    </table>
    </div>
    
     <div class="card-footer">
        <div class="float-right">
            {{ $users->links() }}
        </div>
     </div>

    </div>
    
    </div>
</div>

