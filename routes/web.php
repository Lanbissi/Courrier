<?php

use App\Http\Livewire\DemandeComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Livewire\AdminPasswordEditComponent;
use App\Http\Livewire\AnnotationCourrierArriveeComponent;
use App\Http\Livewire\AnnotationEnvoieComponent;
use App\Http\Livewire\ChronoComponent;
use App\Http\Livewire\ChronoCourrierDepartComponent;
use App\Http\Livewire\ConsultationComponent;
use App\Http\Livewire\CourrierArriveComponent;
use App\Http\Livewire\CourrierDepartComponent;
use App\Http\Livewire\DirectionComponent;
use App\Http\Livewire\EditEmployerPasswordComponent;
use App\Http\Livewire\EnvoyerComponent;
use App\Http\Livewire\FonctionComponent;
use App\Http\Livewire\NatureCourrierArriveComponent;
use App\Http\Livewire\NatureCourrierDepartComponent;
use App\Http\Livewire\PasswordEditComponent;
use App\Http\Livewire\PJCourrierArriveComponent;
use App\Http\Livewire\SecretaireEditMotdepasseComponent;
use App\Http\Livewire\TypeAnnotationComponent;
use App\Http\Livewire\Utilisateurs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('Accueil');

Route::group([
    "middleware" => ["auth", "auth.admin"],
    "as" => "admin."
], function(){
   
     Route::group([
        "prefix" => "droit_acces",
        "as" => "droit_acces."
     ], function(){
          Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");
     });

     Route::group([
          "prefix" => "occupation",
          "as" => "occupation."
       ], function(){
          Route::get("/directions", DirectionComponent::class)->name("directions");
          Route::get("/fonctions", FonctionComponent::class)->name("fonctions");
     });

     Route::group([
          "prefix" => "adminmotdepasse",
          "as" => "adminmotdepasse."
       ], function(){
          Route::get("/mp",AdminPasswordEditComponent::class)->name("modification.admin_mp");
     });

});

Route::group([
     "middleware" => ["auth", "auth.employesecretaire"],
     "as" => "secretaire."
 ], function(){
    
      Route::group([
         "prefix" => "gescourrierarrive",
         "as" => "gescourrierarrive."
      ], function(){
           Route::get("/chronos", ChronoComponent::class)->name("chronos");
      });

      Route::group([
          "prefix" => "gescourrierarrive",
          "as" => "gescourrierarrive."
       ], function(){
            Route::get("/naturecourrierarrive", NatureCourrierArriveComponent::class)->name("nature_courrier_arrive");
            Route::get("/courrierarrives", CourrierArriveComponent::class)->name("courrierarrives");
            Route::get("/typesannotations", TypeAnnotationComponent::class)->name("types_annotations");
            Route::get("/pjCA", PJCourrierArriveComponent::class)->name("pjCA");
       });

       Route::group([
          "prefix" => "gescourrierdepart",
          "as" => "gescourrierdepart."
       ], function(){
            Route::get("/chronos", ChronoCourrierDepartComponent::class)->name("chronos");
            Route::get("/natures", NatureCourrierDepartComponent::class)->name("natures");
            Route::get("/courrierdepart", CourrierDepartComponent::class)->name("courrierdepart");
       });

       Route::group([
          "prefix" => "secretairemotdepasse",
          "as" => "secretairemotdepasse."
       ], function(){
          Route::get("/mp",SecretaireEditMotdepasseComponent::class)->name("modification.secretaire_mp");
     });
 
 });

 Route::group([
     "middleware" => ["auth", "auth.directeur"],
     "as" => "directeur."
 ], function(){
 
      Route::group([
           "prefix" => "courrierarrive",
           "as" => "courrierarrive."
        ], function(){
           Route::get("/consultation", ConsultationComponent::class)->name("consultation");
           Route::get("/envoie", EnvoyerComponent::class)->name("envoie");
      });

      Route::group([
          "prefix" => "motdepasse",
          "as" => "motdepasse."
       ], function(){
          Route::get("/mp",PasswordEditComponent::class)->name("modification.mot_de_passe");
     });
 
 }); 


 Route::group([
     "middleware" => ["auth", "auth.employeautres"],
     "as" => "employer."
 ], function(){
 
      Route::group([
           "prefix" => "annotation",
           "as" => "annotation."
        ], function(){
           Route::get("/annotation", AnnotationCourrierArriveeComponent::class)->name("annotation");
           Route::get("/envoie", AnnotationEnvoieComponent::class)->name("envoie");
      });

      Route::group([
          "prefix" => "mp_autre",
          "as" => "mp_autre."
       ], function(){
          Route::get("/mp", EditEmployerPasswordComponent::class)->name("mp_autre");
     });
 
 }); 










