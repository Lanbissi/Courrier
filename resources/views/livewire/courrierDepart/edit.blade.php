<div class="row p-4 pt-5">
    <div class="col-md-12">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition d'un nouveau courrier départ</h3>
        </div>
        
        <div class="row">
             <div class="col-md-8">
                  <form role="form" wire:submit.prevent="addCourrier()">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Numéro d'ordre</label>
                            <input type="text" wire:model="numordre" class="form-control @error('numordre')  is-invalid  @enderror">
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
                    </div>
                  </form>
             </div>

             <div class="col-md-4">
                
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" wire:click="editCourrier">Modifier</button>
            <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retourner à la liste des courriers départs</button>
        </div>
    </div>
</div>