<div wire:ignore.self>
 
    @if ($currentPage == PAGESEEMOREFORM)
        @include("livewire.annotation.seemore")
    @endif 

    @if($currentPage == PAGECREATEFORM)
        @include("livewire.annotation.create")
    @endif

    @if ($currentPage == PAGELIST)
          @include("livewire.annotation.liste")
    @endif
    
    @if ($currentPage == PAGEEDITFORM)
          @include("livewire.annotation.edit")
    @endif 

    @if ($currentPage == PAGEAPERCUANNOTATION)
          @include("livewire.annotation.aperçuannotation")
    @endif

    @if ($currentPage == PAGESUIVIFORM)
          @include("livewire.annotation.suivi")
    @endif

    @if ($currentPage == PAGEPJFORM)
          @include("livewire.annotation.pj")
    @endif

    @if ($currentPage == PAGECONSIGNE)
          @include("livewire.annotation.consigne")
    @endif

</div>

<!-- Script js communique avec livewire pour la suppression et pour envoyer à l'utilisateur que l'enregistrement s'est bien passé-->
<script>
    window.addEventListener("showSuccessMessage", event=>{
                     Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        toast: 'true',
                        title: event.detail.message || "Opération effectuée avec succès!",
                        showConfirmButton: 'false',
                        timer: '5000'
                     })
                })
</script>

<script>
    window.addEventListener("showConfirmMessage", event=>{
         Swal.fire({
                     title: event.detail.message.title,
                     text: event.detail.message.text,
                     icon: event.detail.message.type,
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Continuer!',
                     cancelButtonText: 'Annuler!'
                   }).then((result) => {
                     if(result.isConfirmed){
                        if (event.detail.message.data) {
                            @this.deleteUser(event.detail.message.data.courrier_id)
                         }

                     }
                       
                  })

    })
</script>