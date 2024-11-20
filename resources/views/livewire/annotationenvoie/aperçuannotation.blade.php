<div class="row p-4 pt-5">
    <div class="col-md-8">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"> Aperçu de l'annotation du courrier "{{ $selectedTypeCourrier}}"</h3>
        </div>
        
        <div class="card-body">
    

       
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              
              
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="color: #000">
                        Date annotation <span class="float-right">{{$dateAnnotationAperçu}}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="color: #000">
                        Date suivie <span class="float-right">{{$dateSuiviAperçu}}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link"  style="color: #000">
                        Numéro courrier <span class="float-right">{{$numeroAperçu}}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="color: #000">
                        Objet <span class="float-right">{{$objetAperçu}}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link"  style="color: #000">
                        Date fin traitement théorique  <span class="float-right">{{$dateTheoriqueAperçu}}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="color: #000">
                        Delai théorique <span class="float-right">{{$delaiTheoriqueAperçu}}</span>
                    </a>
                  </li>
                </ul>
        
            </div>
            <!-- /.widget-user -->
          </div>
        
        <div class="card-footer">
        <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retour</button>
        </div>

        </div>
        
</div>


   