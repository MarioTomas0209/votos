
{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('livewire:init', ()=>{
            Livewire.on('close-modal', (idModal)=> {
                $('#'+idModal).modal('hide');
            })
        })

        document.addEventListener('livewire:init', ()=>{
            Livewire.on('alert', function(message) {
                Swal.fire({
                    title: "¡Listo!",
                    text: message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
            });
        })

        document.addEventListener('livewire:init', ()=>{
        Livewire.on('open-modal', (idModal)=> {
            $('#'+idModal).modal('show');
        })
    })

        document.addEventListener('livewire:init', ()=>{
            Livewire.on('delete', (e)=> {
                // alert(e.id + ' ' + e.eventName);
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡Esta acción no se puede revertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, ¡eliminar esto!",
                    cancelButtonText: "Cancelar"
                    }).then((result) => {
                    if (result.isConfirmed) {
                    Livewire.dispatch(e.eventName, {id: e.id});

                    }
                });
            })
        })

</script>