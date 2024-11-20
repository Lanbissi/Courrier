<div class="row p-4 pt-5">
    <div class="col-md-6">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'annotation</h3>
        </div>
        
        
        <form role="form" wire:submit.prevent="annotation()">
        <div class="card-body">

        <div class="form-group">
            <label>Numéro</label>
            <input type="text" readonly wire:model="numero" class="form-control @error('numero')  is-invalid  @enderror">
            @error('numero')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Instruction</label>
            <textarea wire:model="objet" class="form-control @error('objet')  is-invalid  @enderror"></textarea>
            @error('objet')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Date fin traitement théorique</label>
            <input type="date" wire:model="dateTheorique" class="form-control @error('dateTheorique')  is-invalid  @enderror">
            @error('dateTheorique')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>


        </div>
        
        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
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
                                @foreach ($typefonctionTable["types"] as $type)
                                    
                                 <tr>
                                     <td>{{$type["nom_annotation"]}}</td>
                                     <td>
                                         <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                             <input type="checkbox" class="custom-control-input" id="customSwitchPermission{{$type["type_id"]}}" wire:model.lazy="typefonctionTable.types.{{$loop->index}}.active">
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
                                 
                                @foreach ($typefonctionTable["fonctions"] as $fonction)
                                <tr>
                                    <td>{{$fonction["nom_fonction"]}}</td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitchPermission{{$fonction["nom_fonction"]}}" wire:model.lazy="typefonctionTable.fonctions.{{$loop->index}}.active">
                                            <label class="custom-control-label" for="customSwitchPermission{{$fonction["nom_fonction"]}}"></label>
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
