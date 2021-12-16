<script>
    document.addEventListener('DOMContentLoaded', function() {

        let modal = new bootstrap.Modal(document.getElementById('customer_modal'));
        let target = document.querySelector(".modal-content");
        let blockUI = new KTBlockUI(target, {
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Cargando...</div>',
            overlayClass: "bg-info bg-opacity-25",
        });

        window.livewire.on('modal', function(msg) {
            if (msg) {
                blockUI.release();
                modal.show();
            } else {
                blockUI.block();
                modal.hide();
            }

        });

        window.livewire.on('alert', function(msg) {
            Swal.fire(
                msg.title,
                msg.message,
                msg.icon
            )
        });

        window.livewire.on('toastr', function(msg) {
            toastr[msg.icon](msg.message, msg.title);
        });

    });
</script>
