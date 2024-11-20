<div class="row p-4 pt-5">
    <div class="col-md-6">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un nouvel utilisateur</h3>
        </div>
        
        
        <form role="form" wire:submit.prevent="addUser()">
        <div class="card-body">
        <div class="form-group">
        <label>Matricule</label>
        <input type="text" wire:model="matricule" class="form-control @error('matricule')  is-invalid  @enderror">
        @error('matricule')
            <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" wire:model="nom" class="form-control @error('nom')  is-invalid  @enderror">
                    @error('nom')
                         <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" wire:model="prenom" class="form-control @error('prenom')  is-invalid  @enderror">
                    @error('prenom')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Sexe</label>
            <select class="form-control @error('sexe')  is-invalid  @enderror" wire:model="sexe">
                <option></option>
                <option value="M">M</option>
                <option value="F">F</option>
            </select>
            @error('sexe')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Adresse e-mail</label>
            <input type="text" class="form-control @error('email')  is-invalid  @enderror" wire:model="email">
            @error('email')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Nom d'utilisateur</label>
            <input type="text" class="form-control @error('username')  is-invalid  @enderror" wire:model="username">
            @error('username')
              <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Téléphone 1</label>
                    <input type="text" class="form-control @error('telephone1')  is-invalid  @enderror" wire:model="telephone1">
                    @error('telephone1')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Téléphone 2</label>
                    <input type="text" class="form-control" wire:model="telephone2">
                    @error('telephone2')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Fonction</label>
            <select class="form-control @error('fonction')  is-invalid  @enderror" wire:model="fonction">
                <option></option>
                @foreach ($fonctions as $fonction)
                   <option value="{{$fonction->id}}">{{$fonction->lib_fonction}}</option>
                @endforeach 
            </select>
            @error('fonction')
              <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Est-il  un directeur ?</label>
            <select class="form-control @error('estdirecteur')  is-invalid  @enderror" wire:model="estdirecteur">
                <option></option>
                <option value="0">Oui</option>
                <option value="1">Non</option>
            </select>
            @error('estdirecteur')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
        <label>Mot de Passe</label>
        <input type="password" class="form-control @error('password')  is-invalid  @enderror" placeholder="Password" wire:model="password" readonly value="password">
        @error('password')
            <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        </div>
        
        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retourner à la liste des utilisateurs</button>
        </div>
        </form>
        </div>
        
        </div>
</div>