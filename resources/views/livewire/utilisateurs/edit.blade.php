<div class="row p-4 pt-5">
    <div class="col-md-6">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
        </div>
        
        
        <form role="form" wire:submit.prevent="updateUser()">
        <div class="card-body">
        <div class="form-group">
        <label>Matricule</label>
        <input type="text" wire:model="editmatricule" class="form-control @error('editmatricule')  is-invalid  @enderror">
        @error('editmatricule')
            <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" wire:model="editnom" class="form-control @error('editnom')  is-invalid  @enderror">
                    @error('editnom')
                         <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" wire:model="editprenom" class="form-control @error('editprenom')  is-invalid  @enderror">
                    @error('editprenom')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Sexe</label>
            <select class="form-control @error('editsexe')  is-invalid  @enderror" wire:model="editsexe">
                <option></option>
                <option value="M">M</option>
                <option value="F">F</option>
            </select>
            @error('editsexe')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Adresse e-mail</label>
            <input type="text" class="form-control @error('editemail')  is-invalid  @enderror" wire:model="editemail">
            @error('editemail')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Nom d'utilisateur</label>
            <input type="text" class="form-control @error('editusername')  is-invalid  @enderror" wire:model="editusername">
            @error('editusername')
              <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Téléphone 1</label>
                    <input type="text" class="form-control @error('edittelephone1')  is-invalid  @enderror" wire:model="edittelephone1">
                    @error('edittelephone1')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Téléphone 2</label>
                    <input type="text" class="form-control" wire:model="edittelephone2">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Fonction</label>
            <select class="form-control @error('editfonction')  is-invalid  @enderror" wire:model="editfonction">
                <option value=""></option>
                @foreach ($fonctions as $fonction)
                   <option value="{{$fonction->id}}">{{$fonction->lib_fonction}}</option>
                @endforeach 
            </select>
            @error('editfonction')
              <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Est-il  un directeur ?</label>
            <select class="form-control @error('editestdirecteur')  is-invalid  @enderror" wire:model="editestdirecteur">
                <option></option>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
            @error('editestdirecteur')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        </div>
        
        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Modifier</button>
        <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retourner à la liste des utilisateurs</button>
        </div>
        </form>
        </div>
        
        </div>

        <div class="col-md-6">
             <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><i class="fas fa-key fa-2x"></i> Réinitialisation de mot de passe</h3>
                        </div>
                        
                        <div class="card-body">
                           <ul>
                            <li>
                                <a href="#" class="btn btn-link" wire:click.prevent="confirmPwdReset()">Réinitialiser le mot de passe</a>
                                <span>(par défaut: "password")</span>
                            </li>
                           </ul>
                        </div>
                    </div>
                        
                </div>

                <div class="col-md-12 mt-4">
                    <div class="card card-primary">
                        <div class="card-header d-flex align-items-center">
                          <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i> Role & permissions</h3>
                          <button class="btn bg-gradient-success" wire:click="updateRuleAndPermissions"><i class="fas fa-check"></i> Appliquer les modifications</button>
                        </div>
                        
                        <div class="card-body">
                           <div id="accordion">

                            @foreach ($rolepermission["roles"] as $role)

                            <div  class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title flex-grow-1">
                                        <a data-parent="#accordion" href="#" aria-expanded="true">
                                            {{$role["role_nom"]}}
                                        </a>
                                    </h4>
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                       <input type="checkbox" class="custom-control-input" id="customSwitch{{$role["role_id"]}}" @if ($role["active"])
                                          checked 
                                       @endif wire:model.lazy="rolepermission.roles.{{$loop->index}}.active">
                                       <label class="custom-control-label" for="customSwitch{{$role["role_id"]}}">{{ $role["active"]? "Activé" : "Désactivé" }}</label>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                           </div>
                        </div>

                        <div class="p-3">
                            <table class="table table-bordered">
                               <thead>
                                  <th>Permission</th>
                                  <th></th>
                               </thead> 
                               <tbody>

                                @foreach ($rolepermission["permissions"] as $permission )
                                    
                                <tr>
                                    <td>{{$permission["permission_nom"]}}</td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitchPermission{{$permission['permission_nom']}}" @if ($permission["active"])
                                            checked @endif wire:model.lazy="rolepermission.permissions.{{$loop->index}}.active">
                                            <label class="custom-control-label" for="customSwitchPermission{{$permission['permission_nom']}}">{{ $permission["active"]? "Activé" : "Désactivé" }}</label>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach

                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        
</div
