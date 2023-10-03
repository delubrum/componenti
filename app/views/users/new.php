<form id="form" autocomplete="off">
    <div class="modal-header">
        <h5 class="modal-title">Nuevo Usuario</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card p-2">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Nombre</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" name="name" value="<?php echo (isset($id->id) and $a == 'Profile') ? $id->username : '';  ?>" required>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="email" class="form-control" name="email" value="<?php echo (isset($id->id) and $a == 'Profile') ? $id->email : ''  ?>" required>
                    </div>
                </div>
                 <!--
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Language</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <select class="form-control" name="lang">
                            <option value="en" <?php echo (isset($id->id) and $id->lang == 'en') ? 'selected' : '' ?>><?php echo $lang['English'] ?></option>
                            <option value="es" <?php echo (isset($id->id) and $id->lang == 'es') ? 'selected' : '' ?>><?php echo $lang['Spanish'] ?></option>
                        </select>
                    </div>
                </div>

                -->
                <input type="hidden" name="lang" value="es">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Contraseña (Alfanumérica, 4 caracteres mínimo)</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="password" minlength="4" id="newpass" name="newpass" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Confirmación Nueva Contraseña</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="password" minlength="4" id="cpass" name="cpass" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<script>
$(document).on('submit', '#form', function(e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    if ($("#type").val() === 'Cliente') {
        if ($('.btn-info').length < 1) {
            toastr.error('Seleccione almenos un producto');
            return
        }
    }
    if (document.getElementById("form").checkValidity()) {
        $("#loading").show();
        $.post( "?c=Users&a=Save", $( "#form" ).serialize()).done(function(res) {
            if (isNaN(res)) {
                toastr.error(res);
                $("#loading").hide();
            } else {
                window.location = '?c=Users&a=Profile&id='+res;
            }
        });
    }
});
</script>