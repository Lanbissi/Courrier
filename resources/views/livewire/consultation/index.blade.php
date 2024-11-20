<div wire:ignore.self>
 
    @if ($currentPage == PAGESEEMOREFORM)
        @include("livewire.consultation.seemore")
    @endif 

    @if($currentPage == PAGECREATEFORM)
        @include("livewire.consultation.create")
    @endif

    @if ($currentPage == PAGELIST)
          @include("livewire.consultation.liste")
    @endif
    
    @if ($currentPage == PAGEEDITFORM)
          @include("livewire.consultation.edit")
    @endif 

    @if ($currentPage == PAGEAPERCUANNOTATION)
          @include("livewire.consultation.aperçuannotation")
    @endif

    @if ($currentPage == PAGESUIVIFORM)
          @include("livewire.consultation.suivi")
    @endif

    @if ($currentPage == PAGEPJFORM)
          @include("livewire.consultation.pj")
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
                            @this.deletePj(event.detail.message.data.pj_id)
                         }

                     }
                       
                  })

    })
</script>
