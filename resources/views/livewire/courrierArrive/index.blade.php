<div wire:ignore.self>
 
    @if ($currentPage == PAGECREATEFORM)
        @include("livewire.courrierArrive.create")
    @endif 

    @if($currentPage == PAGEEDITFORM)
        @include("livewire.courrierArrive.edit")
    @endif

    @if ($currentPage == PAGELIST)
          @include("livewire.courrierArrive.liste")
    @endif 
    
    @if ($currentPage == PAGEPJFORM)
          @include("livewire.courrierArrive.pj")
    @endif 

    @if ($currentPage == PAGESEEMOREFORM)
         @include("livewire.courrierArrive.seemore")
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
    window.addEventListener("showConfirmMessageCourrier", event=>{
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
                            @this.deleteCourrier(event.detail.message.data.courrier_id)
                         }

                     }
                       
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
                            @this.deletepj(event.detail.message.data.pj_id)
                         }

                     }
                       
                  })

    })
</script>