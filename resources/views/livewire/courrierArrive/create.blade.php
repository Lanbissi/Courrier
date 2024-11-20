<div class="row p-4 pt-5">

    <div class="col-md-12">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"> Formulaire de création d'un nouveau courrier</h3>
        </div>
        
        <div class="row">

             <div class="col-md-12">
                  <form role="form" id="form-upload" wire:submit.prevent="addCourrier()" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div cls="form-group">
                                    <label>Numéro primaire</label>
                                    <input type="number" wire:model="numprimaireAdd" class="form-control @error('numprimaireAdd')  is-invalid  @enderror">
                                    @error('numprimaireAdd')
                                         <span class="text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Référence</label>
                                    <input type="text" wire:model="referenceAdd" class="form-control @error('referenceAdd')  is-invalid  @enderror">
                                    @error('referenceAdd')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label>Numéro enregistrement</label>
                            <input type="number" wire:model="enregistrementAdd" class="form-control @error('enregistrementAdd')  is-invalid  @enderror">
                            @error('enregistrementAdd')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                         
                        <div class="form-group">
                            <label>Objet</label>
                            <textarea class="form-control  @error('objetAdd')  is-invalid  @enderror" wire:model="objetAdd"></textarea>
                            @error('objetAdd')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Structure</label>
                                    <input type="text" wire:model="structureAdd" class="form-control @error('structureAdd')  is-invalid  @enderror">
                                    @error('structureAdd')
                                         <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Référence PJ</label>
                                    <input type="text" wire:model="referencepjAdd" class="form-control @error('referencepjAdd')  is-invalid  @enderror">
                                    @error('referencepjAdd')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Priorité</label>
                            <select  wire:model="prioriteAdd" class="form-control @error('prioriteAdd')  is-invalid  @enderror">
                                 <option></option>
                                 <option value="Très urgent">Très urgent</option>
                                 <option value="Urgent">Urgent</option>
                                 <option value="Pas urgent">Pas urgent</option>
                            </select>
                            @error('prioriteAdd')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nom expéditeur</label>
                                    <input type="text" wire:model="expediteurAdd" class="form-control @error('expediteurAdd')  is-invalid  @enderror">
                                    @error('expediteurAdd')
                                         <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Date correspondance</label>
                                    <input type="date" wire:model="datearriveAdd" class="form-control @error('datearriveAdd')  is-invalid  @enderror">
                                    @error('datearriveAdd')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>  
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                        <label>Numéro réponse</label>
                                        <input type="number" wire:model="numeroreponseAdd" class="form-control @error('numeroreponseAdd')  is-invalid  @enderror">
                                        @error('numeroreponseAdd')
                                           <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nombre de pièce</label>
                                    <input type="number" wire:model="pieceAdd" class="form-control @error('pieceAdd')  is-invalid  @enderror">
                                    @error('pieceAdd')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>     
                        </div>
  

                        <div class="form-group">
                                <label>E-mail expéditeur</label>
                                <input type="text" wire:model="emailAdd" class="form-control @error('emailAdd')  is-invalid  @enderror">
                                @error('emailAdd')
                                   <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div> 
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Chrono</label>
                                    <select class="form-control @error('chronoAdd')  is-invalid  @enderror" wire:model="chronoAdd">
                                        <option></option>
                                        @foreach ($chronos as $chrono)
                                         <option value="{{$chrono->id}}">{{$chrono->lib_chrono}}</option>
                                        @endforeach
                                    </select>
                                    @error('chronoAdd')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nature du courrier</label>
                                    <select class="form-control @error('natureAdd')  is-invalid  @enderror" wire:model="natureAdd">
                                        <option></option>
                                        @foreach ($natures as $nature)
                                         <option value="{{$nature->id}}">{{$nature->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('natureAdd')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>     
                        </div>

                        <div class="form-group">
                            <label>Choisissez le courrier</label>
                            <input type="file" wire:model="imageAdd" class="form-control @error('imageAdd')  is-invalid  @enderror" id="image{{$inputFileIterator}}">
                            @error('imageAdd')
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
            <button type="submit" class="btn btn-primary" wire:click="addCourrier()">Enregistrer</button>
            <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retourner à la liste des courriers</button>
        </div>
    </div>
</div>