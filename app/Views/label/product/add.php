<div class="modal-header">
    <h5 class="modal-title">Add Label Product</h5>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-2x"></span>
    </div>
</div>

<div class="modal-body">
    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

    <div class="fv-row mb-8">
        <input type="text" placeholder="D Number" id="dnumber" name="dnumber" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger dnumber-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="Brand" id="brand" name="brand" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger brand-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="Make" id="make" name="make" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger make-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="Storage" id="storage" name="storage" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger storage-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="Model Number" id="model_no" name="model_no" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger model_no-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="Color" id="color" name="color" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger color-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="Grade" id="grade" name="grade" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger grade-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="ICloud" id="icloud" name="icloud" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger icloud-error"></span>
    </div>
    <div class="fv-row mb-8">
        <input type="text" placeholder="Carrier" id="carrier" name="carrier" autocomplete="off" class="form-control bg-transparent" required />
        <span class="text-danger carrier-error"></span>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary save">Save changes</button>
</div>

<script>
    $(".save").on("click", () => {
        let dnumber = $("#dnumber").val();
        let brand = $("#brand").val();
        let make = $("#make").val();
        let storage = $("#storage").val();
        let model_no = $("#model_no").val();
        let color = $("#color").val();
        let grade = $("#grade").val();
        let icloud = $("#icloud").val();
        let carrier = $("#carrier").val();
        let errorFlag = 0;

        if (dnumber == "") {
            errorFlag = 1;
            $(".dnumber-error").html('Field required');
        } else {
            $(".dnumber-error").html('');
        }
        if (brand == "") {
            errorFlag = 1;
            $(".brand-error").html('Field required');
        } else {
            $(".brand-error").html('');
        }
        if (make == "") {
            errorFlag = 1;
            $(".make-error").html('Field required');
        } else {
            $(".make-error").html('');
        }
        if (storage == "") {
            errorFlag = 1;
            $(".storage-error").html('Field required');
        } else {
            $(".storage-error").html('');
        }
        if (model_no == "") {
            errorFlag = 1;
            $(".model_no-error").html('Field required');
        } else {
            $(".model_no-error").html('');
        }
        if (color == "") {
            errorFlag = 1;
            $(".color-error").html('Field required');
        } else {
            $(".color-error").html('');
        }
        if (grade == "") {
            errorFlag = 1;
            $(".grade-error").html('Field required');
        } else {
            $(".grade-error").html('');
        }
        if (icloud == "") {
            errorFlag = 1;
            $(".icloud-error").html('Field required');
        } else {
            $(".icloud-error").html('');
        }
        if (carrier == "") {
            errorFlag = 1;
            $(".carrier-error").html('Field required');
        } else {
            $(".carrier-error").html('');
        }

        if (errorFlag == 1) {
            return false;
        }
        Product.addProduct({
            'dnumber' : dnumber,
            'brand' : brand,
            'make' : make,
            'storage' : storage,
            'model_no' : model_no,
            'color' : color,
            'grade' : grade,
            'icloud' : icloud,
            'carrier' : carrier,
        })
    })
</script>