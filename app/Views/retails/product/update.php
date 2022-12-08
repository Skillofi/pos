<div class="modal-header">
    <h5 class="modal-title">Update Product</h5>
    <!--begin::Close-->
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-2x"></span>
    </div>
    <!--end::Close-->
</div>

<div class="modal-body">
    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Name" id="name" name="name" autocomplete="off" class="form-control bg-transparent" required value="<?= $product['name'] ?>" />
        <!--end::Email-->
        <span class="text-danger name-error"></span>
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Product Code" id="code" name="code" autocomplete="off" class="form-control bg-transparent" required value="<?= $product['code'] ?>" />
        <!--end::Email-->
        <span class="text-danger code-error"></span>
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="number" placeholder="Price" id="price" name="price" autocomplete="off" class="form-control bg-transparent" required value="<?= $product['price'] ?>" />
        <!--end::Email-->
        <span class="text-danger price-error"></span>
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="number" placeholder="Stock" id="stock" name="stock" autocomplete="off" class="form-control bg-transparent" required value="<?= $product['stock'] ?>" />
        <!--end::Email-->
        <span class="text-danger stock-error"></span>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary save">Save changes</button>
</div>
<input type="hidden" id="id" value="<?= $product['id'] ?>">
<script>
    $(".save").on("click", () => {
        let id = $("#id").val()
        let name = $("#name").val()
        let code = $("#code").val()
        let price = $("#price").val()
        let stock = $("#stock").val()
        let errorFlag = 0;

        if (name == "") {
            errorFlag = 1;
            $(".name-error").html('field required');
        } else {
            $(".name-error").html('');
        }
        if (code == "") {
            errorFlag = 1;
            $(".code-error").html('field required');
        } else {
            $(".code-error").html('');
        }
        if (price == "") {
            errorFlag = 1;
            $(".price-error").html('field required');
        } else {
            $(".price-error").html('');
        }
        if (stock == "") {
            errorFlag = 1;
            $(".stock-error").html('field required');
        } else {
            $(".stock-error").html('');
        }

        if (errorFlag == 1) {
            return false;
        }
        Product.updateProduct({
            'id': id,
            'name': name,
            'code': code,
            'price': price,
            'stock': stock
        })
    })
</script>