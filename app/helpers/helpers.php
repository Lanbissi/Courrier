<?php

use Illuminate\Support\Str;

function userFullName(){
    return auth()->user()->prenom . " " . auth()->user()->nom;
}

/*function activity(){
    return auth()->user()->service->lib_fonction;
}*/

function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();
    if(contains($routeActuel, $route)){
         return $classe;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();
    if($routeActuel === $route){
         return 'active';
    }
    return "";
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}

// Affichage des pages

define("PAGELIST", "liste");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");
define("PAGESEEMOREFORM", "seemore");
define("PAGESUIVIFORM", "suivi");
define("PAGEAPERCUANNOTATION", "aperçuannotation");
define("DEFAULTPASSWORD", "password");
define("PAGEPJFORM", "pj");
define("PAGECONSIGNE", "consigne");

