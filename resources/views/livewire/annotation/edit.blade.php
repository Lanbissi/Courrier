<div class="row p-4 pt-5">
    <div class="col-md-6">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'annotation</h3>
        </div>
        
        
        <form role="form" wire:submit.prevent="annotationEdit()">
        <div class="card-body">

        <div class="form-group">
                    <label>Date suivie</label>
                    <input type="date" wire:model="dateSuivieEdit" class="form-control @error('dateSuivieEdit')  is-invalid  @enderror">
                    @error('dateSuivieEdit')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
        </div>

        <div class="form-group">
            <label>Numéro</label>
            <input type="text" wire:model="numeroEdit" class="form-control @error('numeroEdit')  is-invalid  @enderror">
            @error('numeroEdit')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Objet</label>
            <textarea wire:model="objetEdit" class="form-control @error('objetEdit')  is-invalid  @enderror"></textarea>
            @error('objetEdit')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Date fin traitement théorique</label>
                    <input type="date" wire:model="dateTheoriqueEdit" class="form-control @error('dateTheoriqueEdit')  is-invalid  @enderror">
                    @error('dateTheoriqueEdit')
                         <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Delai théorique</label>
                    <input type="text" wire:model="delaiTheoriqueEdit" class="form-control @error('delaiTheoriqueEdit')  is-invalid  @enderror">
                    @error('delaiTheoriqueEdit')
                         <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        

        </div>
        
        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Modifier</button>
        <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retour</button>
        </div>
        </form>
        </div>
        
        </div>

        <div class="col-md-6">
             <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex align-items-center">
                          <h3 class="card-title flex-grow-1"><i></i>Types annotations & services</h3>
                        </div>
                               
                        <div class="p-3">
                            <table class="table table-bordered">
                                <thead>
                                   <th style="width: 40%">Types d'annotations</th>
                                   <th></th>
                                </thead> 
                                <tbody>                      
                                 @foreach ($typefonctionEdit["types"] as $type)      
                                 <tr>
                                     <td>{{$type["type_nom"]}}</td>
                                     <td>
                                         <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                             <input type="checkbox" class="custom-control-input" id="customSwitchPermission{{$type["type_id"]}}" @if ($type["active"])
                                             checked
                                             @endif wire:model.lazy="typefonctionEdit.types.{{$loop->index}}.active">
                                             <label class="custom-control-label" for="customSwitchPermission{{$type["type_id"]}}"></label>
                                         </div>
                                     </td>
                                 </tr>
                                 @endforeach 
                                </tbody>
                             </table>
                        </div>   

                        <div class="p-3">
                            <table class="table table-bordered">
                               <thead>
                                  <th style="width: 40%">Transférer à :</th>
                                  <th></th>
                               </thead> 
                               <tbody>
                                @foreach ($typefonctionEdit["fonctions"] as $fonction)     
                                <tr>
                                    <td>{{$fonction["fonction_nom"]}}</td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitchPermission{{$fonction["fonction_nom"]}}" @if ($fonction["active"])
                                              checked
                                            @endif wire:model.lazy="typefonctionEdit.fonctions.{{$loop->index}}.active">
                                            <label class="custom-control-label" for="customSwitchPermission{{$fonction["fonction_nom"]}}"></label>
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
