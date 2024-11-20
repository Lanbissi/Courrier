
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Système de Gestion de Courrier</title>

<link rel="stylesheet" href="{{mix('css/app.css')}}">

@livewireStyles

<script nonce="3e43ae1b-bdec-4d55-8ffe-09165e9c0776">(function(w,d){!function(a,e,t,r){a.zarazData=a.zarazData||{};a.zarazData.executed=[];a.zaraz={deferred:[]};a.zaraz.q=[];a.zaraz._f=function(e){return function(){var t=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:t})}};for(const e of["track","set","ecommerce","debug"])a.zaraz[e]=a.zaraz._f(e);a.zaraz.init=()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r),n=e.getElementsByTagName("title")[0];n&&(a.zarazData.t=e.getElementsByTagName("title")[0].text);a.zarazData.x=Math.random();a.zarazData.w=a.screen.width;a.zarazData.h=a.screen.height;a.zarazData.j=a.innerHeight;a.zarazData.e=a.innerWidth;a.zarazData.l=a.location.href;a.zarazData.r=e.referrer;a.zarazData.k=a.screen.colorDepth;a.zarazData.n=e.characterSet;a.zarazData.o=(new Date).getTimezoneOffset();a.zarazData.q=[];for(;a.zaraz.q.length;){const e=a.zaraz.q.shift();a.zarazData.q.push(e)}z.defer=!0;for(const e of[localStorage,sessionStorage])Object.keys(e||{}).filter((a=>a.startsWith("_zaraz_"))).forEach((t=>{try{a.zarazData["z_"+t.slice(7)]=JSON.parse(e.getItem(t))}catch{a.zarazData["z_"+t.slice(7)]=e.getItem(t)}}));z.referrerPolicy="origin";z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData)));t.parentNode.insertBefore(z,t)};["complete","interactive"].includes(e.readyState)?zaraz.init():a.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

<ul class="navbar-nav ml-auto">
<li class="nav-item">
<a class="nav-link" data-widget="fullscreen" href="#" role="button">
<i class="fas fa-expand-arrows-alt"></i>
</a>
</li>
<li class="nav-item">
<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
<i class="fas fa-user"></i>
</a>
</li>
</ul>
</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="index3.html" class="brand-link">
<span class="brand-text font-weight-bold" style="font-size: 1.5rem">SGC</span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="info">
<a href="#" class="d-block ellipsis">{{userFullName()}}</a>
</div>
</div>

<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="{{route('Accueil')}}" class="nav-link {{ setMenuActive('Accueil') }} ">
            <i class="nav-icon fas fa-home"></i>
                <p>Accueil</p>
        </a>
    </li>

    @can("Directeur")
        
    <li class="nav-item">
        <a href="{{ route('directeur.courrierarrive.consultation') }}" class="nav-link {{ setMenuActive('directeur.courrierarrive.consultation') }}">
            <i class="nav-icon fas fa-link"></i>
            <p>Arrivé</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('directeur.courrierarrive.envoie')}}" class="nav-link {{setMenuActive('directeur.courrierarrive.envoie')}}">
            <i class="nav-icon fas fa-link"></i>
            <p>Envoyé</p>
        </a>
    </li>
    
    @endcan

    @can("Admin")
        
    <li class="nav-item {{ setMenuClass('admin.droit_acces.', 'menu-open') }}">
            <li class="nav-item">
                <a href="{{ route('admin.droit_acces.users.index') }}" class="nav-link {{ setMenuActive('admin.droit_acces.users.index') }}">
                   <i class="nav-icon fas fa-link"></i>
                   <p>Gestion utilisateurs</p>
                </a>
            </li>
    </li>

    <li class="nav-item {{ setMenuClass('admin.occupation.', 'menu-open') }}">
        <a href="#" class="nav-link {{ setMenuClass('admin.occupation.', 'active') }}">
            <i class="nav-icon fas fa-link"></i>
            <p>
                Administration
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.occupation.directions') }}" class="nav-link {{ setMenuActive('admin.occupation.directions') }}">
                    <i class="nav-icon fas fa-link"></i>
                    <p>Gestion directions</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.occupation.fonctions') }}" class="nav-link {{ setMenuActive('admin.occupation.fonctions') }}">
                    <i class="nav-icon fas fa-link"></i>
                    <p>Gestion services</p>
                </a>
            </li>
        </ul>
    </li>

    @endcan

     
    @can("Employé(Secrétaire)")
        
    <li class="nav-item {{ setMenuClass('secretaire.gescourrierarrive.', 'menu-open') }}">
        <a href="#" class="nav-link {{ setMenuClass('secretaire.gescourrierarrive.', 'active') }}">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>
                Courrier arrivé
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('secretaire.gescourrierarrive.courrierarrives')}}" class="nav-link {{ setMenuActive('secretaire.gescourrierarrive.courrierarrives') }}">
                   <i class="nav-icon fas fa-link"></i>
                   <p>Liste courriers</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('secretaire.gescourrierarrive.chronos') }}" class="nav-link {{ setMenuActive('secretaire.gescourrierarrive.chronos') }}">
                   <i class="nav-icon fas fa-link"></i>
                   <p>Chrono arrivés</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('secretaire.gescourrierarrive.nature_courrier_arrive')}}" class="nav-link {{ setMenuActive('secretaire.gescourrierarrive.nature_courrier_arrive') }}">
                   <i class="nav-icon fas fa-link"></i>
                   <p>Nature arrivés</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-link"></i>
            <p>
                Courrier départ
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('secretaire.gescourrierdepart.courrierdepart')}} " class="nav-link">
                   <i class="nav-icon fas fa-link"></i>
                   <p>Liste courriers</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('secretaire.gescourrierdepart.chronos')}}" class="nav-link">
                   <i class="nav-icon fas fa-link"></i>
                   <p>Chrono départs</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('secretaire.gescourrierdepart.natures')}}" class="nav-link">
                   <i class="nav-icon fas fa-link"></i>
                   <p>Nature départs</p>
                </a>
            </li>
            <li class="nav-item">
        </ul>
    </li>

    <li class="nav-item">
        <a href="{{ route('secretaire.gescourrierarrive.types_annotations')}}" class="nav-link {{ setMenuActive('secretaire.gescourrierarrive.types_annotations') }}">
            <i class="nav-icon fas fa-link"></i>
            <p>Type annotation</p>
        </a>
    </li>

    @endcan


    @can("Employé(Autres)")
        
        <li class="nav-item">
            <a href="{{route('employer.annotation.annotation')}}" class="nav-link {{ setMenuActive('employer.annotation.annotation') }}">
                <i class="nav-icon fas fa-link"></i>
                <p>Réception</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('employer.annotation.envoie')}}" class="nav-link {{ setMenuActive('employer.annotation.envoie') }}">
                <i class="nav-icon fas fa-link"></i>
                <p>Envoyé</p>
            </a>
        </li>

    @endcan

</ul>
</nav>

</div>

</aside>

<div class="content-wrapper">

<div class="content">
<div class="container-fluid">
    @yield('contenu')
</div>
</div>
</div>

@can('Directeur')
<aside class="control-sidebar control-sidebar-dark">

<div class="bg-dark">
<div class="card-body bg-dark box-profile">
<h3 class="profile-username text-center ellipsis">{{userFullName()}}</h3>
<p class="text-muted text-center"></p>
      <ul class="list-group bg-dark mb-3">
        <li class="list-group-item">
            <a href="{{route('directeur.motdepasse.modification.mot_de_passe')}}" class="d-flex align-items-center"><i class="fa fa-lock pr-2"><b> Mot de passe</b></i></a>
        </li>
      </ul>

<a class="btn btn-primary btn-block" href="{{ route('logout') }}"
    onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            Déconnexion
</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
    </form>
</div>

</div>
</aside>
@endcan

@can('Employé(Autres)')
<aside class="control-sidebar control-sidebar-dark">

<div class="bg-dark">
<div class="card-body bg-dark box-profile">
<h3 class="profile-username text-center ellipsis">{{userFullName()}}</h3>
<p class="text-muted text-center"></p>
      <ul class="list-group bg-dark mb-3">
        <li class="list-group-item">
            <a href="{{route('employer.mp_autre.mp_autre')}}" class="d-flex align-items-center"><i class="fa fa-lock pr-2"><b> Mot de passe</b></i></a>
        </li>
      </ul>

<a class="btn btn-primary btn-block" href="{{ route('logout') }}"
    onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            Déconnexion
</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
    </form>
</div>

</div>
</aside>
@endcan

@can('Admin')
<aside class="control-sidebar control-sidebar-dark">

<div class="bg-dark">
<div class="card-body bg-dark box-profile">
<h3 class="profile-username text-center ellipsis">{{userFullName()}}</h3>
<p class="text-muted text-center"></p>
      <ul class="list-group bg-dark mb-3">
        <li class="list-group-item">
            <a href="{{route('admin.adminmotdepasse.modification.admin_mp')}}" class="d-flex align-items-center"><i class="fa fa-lock pr-2"><b> Mot de passe</b></i></a>
        </li>
      </ul>

<a class="btn btn-primary btn-block" href="{{ route('logout') }}"
    onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            Déconnexion
</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
    </form>
</div>

</div>
</aside>
@endcan

@can('Employé(Secrétaire)')
<aside class="control-sidebar control-sidebar-dark">

<div class="bg-dark">
<div class="card-body bg-dark box-profile">
<h3 class="profile-username text-center ellipsis">{{userFullName()}}</h3>
<p class="text-muted text-center"></p>
      <ul class="list-group bg-dark mb-3">
        <li class="list-group-item">
            <a href="{{route('secretaire.secretairemotdepasse.modification.secretaire_mp')}}" class="d-flex align-items-center"><i class="fa fa-lock pr-2"><b> Mot de passe</b></i></a>
        </li>
      </ul>

<a class="btn btn-primary btn-block" href="{{ route('logout') }}"
    onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            Déconnexion
</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
    </form>
</div>

</div>
</aside>
@endcan


<footer class="main-footer">

<strong>Copyright &copy; 2022 <a href="#">SGC v1</a>.</strong> Touts droits réservés.
</footer>
</div>

<script src="{{mix('js/app.js')}}"></script>

@livewireScripts

</body>
</html>
