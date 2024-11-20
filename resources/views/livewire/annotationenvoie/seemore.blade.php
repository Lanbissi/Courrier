<div class="row p-4 pt-5">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Voir le fichier</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Détails du courrier</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                @forelse ($fileCourriersAperçu as $fileCourriersAperçu)
                <iframe src="{{asset('fichier/fichier')}}/{{$fileCourriersAperçu->courrierNumerise}}" height="650" class="col-md-12" style="background: gray"></iframe>
                @empty
                <iframe src="" height="550" width="500" style="background: gray"></iframe>
                @endforelse
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                  
                    <div class="col-md-8">
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="card-footer p-0">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link"  style="color: #000">
                                    Référence <span class="float-right">{{$referenceSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Numéro d'enregistrement <span class="float-right">{{$enregistrementSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Objet <span class="float-right">{{$objetSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Structure <span class="float-right">{{$structureSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Référence pièce jointe <span class="float-right">{{$referencepjSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Priorité <span class="float-right">{{$prioriteSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Expéditeur <span class="float-right">{{$expediteurSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Date arrivée <span class="float-right">{{$datearriveSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Numéro de réponse <span class="float-right">{{$numeroreponseSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Nombre de pièce <span class="float-right">{{$pieceSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Email <span class="float-right">{{$emailSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link" style="color: #000">
                                    Chrono <span class="float-right">{{$chronoSee}}</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link"  style="color: #000">
                                    Nature <span class="float-right">{{$natureSee}}</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </div>
                    </div>       
            </div>
          </div>
          <!-- /.card -->
          <div class="card-footer">
            <button type="button" wire:click="goToListCourrier()" class="btn btn-danger">Retour</button>
          </div>
        </div>
        
      </div>
</div>