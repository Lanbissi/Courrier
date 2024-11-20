<div class="row p-4 pt-5">

   <div class="col-md-12">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit fa-2x"></i> Formulaire d'édition de courrier</h3>
        </div>
        
        <div class="row">

             <div class="col-md-12">
                  <form role="form" wire:submit.prevent="editCourrier()">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div cls="form-group">
                                    <label>Numéro primaire</label>
                                    <input type="text" wire:model="numprimaire" class="form-control @error('numprimaire')  is-invalid  @enderror">
                                    @error('numprimaire')
                                         <span class="text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Référence</label>
                                    <input type="text" wire:model="reference" class="form-control @error('reference')  is-invalid  @enderror">
                                    @error('reference')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label>Numéro enregistrement</label>
                            <input type="text" wire:model="enregistrement" class="form-control @error('enregistrement')  is-invalid  @enderror">
                            @error('enregistrement')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                         
                        <div class="form-group">
                            <label>Objet</label>
                            <textarea class="form-control  @error('objet')  is-invalid  @enderror" wire:model="objet"></textarea>
                            @error('objet')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Structure</label>
                                    <input type="text" wire:model="structure" class="form-control @error('structure')  is-invalid  @enderror">
                                    @error('structure')
                                         <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Référence PJ</label>
                                    <input type="text" wire:model="referencepj" class="form-control @error('referencepj')  is-invalid  @enderror">
                                    @error('referencepj')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Priorité</label>
                            <select  wire:model="priorite" class="form-control @error('priorite')  is-invalid  @enderror">
                                 <option></option>
                                 <option value="Très urgent">Très urgent</option>
                                 <option value="Urgent">Urgent</option>
                                 <option value="Pas urgent">Pas urgent</option>
                            </select>
                            @error('priorite')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nom expéditeur</label>
                                    <input type="text" wire:model="expediteur" class="form-control @error('expediteur')  is-invalid  @enderror">
                                    @error('expediteur')
                                         <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Date de correspondance</label>
                                    <input onfocus="this.type='date'" wire:model="datearrive" class="form-control @error('datearrive')  is-invalid  @enderror">
                                    @error('datearrive')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>  
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Numéro réponse</label>
                                    <input type="text" wire:model="numeroreponse" class="form-control @error('numeroreponse')  is-invalid  @enderror">
                                    @error('numeroreponse')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nombre de pièce</label>
                                    <input type="text" wire:model="piece" class="form-control @error('piece')  is-invalid  @enderror">
                                    @error('piece')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                                <label>E-mail expéditeur</label>
                                <input type="text" wire:model="email" class="form-control @error('email')  is-invalid  @enderror">
                                @error('email')
                                   <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div> 
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Chrono</label>
                                    <select class="form-control @error('chrono')  is-invalid  @enderror" wire:model="chrono">
                                        <option></option>
                                        @foreach ($chronos as $chrono)
                                         <option value="{{$chrono->id}}">{{$chrono->lib_chrono}}</option>
                                        @endforeach
                                    </select>
                                    @error('chrono')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nature du courrier</label>
                                    <select class="form-control @error('nature')  is-invalid  @enderror" wire:model="nature">
                                        <option></option>
                                        @foreach ($natures as $nature)
                                         <option value="{{$nature->id}}">{{$nature->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('nature')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>     
                        </div>
                        <div class="form-group">
                            <label>Choisissez le courrier</label>
                            <input type="file" wire:model="newImageEdit" class="form-control @error('newImageEdit')  is-invalid  @enderror">
                            @error('newImageEdit')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                    </div>
                  </form>
             </div>

             <div class="col-md-4 mt-3">
                
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" wire:click="editCourrier()">Modifier</button>
            <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retourner à la liste des courriers</button>
        </div>
    </div>
</div>