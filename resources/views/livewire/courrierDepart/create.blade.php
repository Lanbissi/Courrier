<div class="row p-4 pt-5">
    <div class="col-md-12">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un nouveau courrier</h3>
        </div>
        
        <div class="row">
             <div class="col-md-12">
                  <form role="form" wire:submit.prevent="addCourrier()">
                    <div class="card-body">
                                <div class="form-group">
                                    <label>Numéro primaire</label>
                                    <input type="number" wire:model="numordre" class="form-control @error('numordre')  is-invalid  @enderror">
                                    @error('numordre')
                                         <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                         
                       
                        <div class="form-group">
                            <label>Destinataire</label>
                            <input type="text" wire:model="destinataire" class="form-control @error('destinataire')  is-invalid  @enderror">
                            @error('destinataire')
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
                        
                        <div class="form-group">
                            <label>Chrono</label>
                            <select class="form-control @error('chrono')  is-invalid  @enderror" wire:model="chrono">
                                <option></option>
                                @foreach ($chronos as $chrono)
                                    <option value="{{$chrono->id}}">{{$chrono->nom}}</option>
                                @endforeach
                            </select>
                            @error('chrono')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Observation</label>
                            <textarea class="form-control  @error('observation')  is-invalid  @enderror" wire:model="observation"></textarea>
                            @error('observation')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Choisissez un fichier</label>
                            <input type="file" wire:model="fichier" class="form-control @error('fichier')  is-invalid  @enderror">
                            @error('fichier')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" wire:submit.prevent="addCourrier()">Enregistrer</button>
                        <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retourner à la liste des courriers départs</button>
                    </div>
                  </form>
             </div>

             <div class="col-md-4">
                
            </div>
        </div>
        
    </div>
</div>