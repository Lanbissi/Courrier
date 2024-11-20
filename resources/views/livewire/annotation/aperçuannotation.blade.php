<div class="row p-4 pt-5">
    <div class="col-md-6">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"> Aperçu de l'annotation du courrier "{{ $selectedTypeCourrier}}"</h3>
        </div>
        
        
        <form role="form">
        <div class="card-body">

        <div class="form-group">
            <span><label>Date annotation :</label> {{$dateAnnotationAperçu}}</span>
        </div>

        <div class="form-group">
            <span><label>Date suivie :</label> {{$dateSuiviAperçu}}</span>
        </div>

        <div class="form-group">
            <span><label>Numéro :</label> {{$numeroAperçu}}</span>
        </div>

        <div class="form-group">
            <span><label>Objet :</label> {{$objetAnnotationAperçu}}</span>
        </div>

        <div class="form-group">
            <span><label>Date fin traitement théorique :</label> {{$dateTheoriqueAperçu}}</span>
        </div>
    
        <div class="form-group">
            <span><label>Date fin traitement réel :</label> {{$dateReelAperçu}}</span>
        </div>

        <div class="form-group">
            <span><label>Delai théorique :</label> {{$delaiTheoriqueAperçu}}</span>
        </div>
        
        <div class="form-group">
            <span><label>Delai réel :</label> {{$delaiReelAperçu}}</span>
        </div>

        </div>
        
        <div class="card-footer">
        <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retour</button>
        </div>
        </form>
        </div>
        
        </div>
        
</div
