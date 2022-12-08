<div class="modal-header">
    <h5 class="modal-title">Add Customer</h5>
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
        <input type="text" placeholder="Name" id="name" name="name" autocomplete="off" class="form-control bg-transparent" required />
        <!--end::Email-->
        <span class="text-danger name-error"></span>
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Phone" id="phone" name="phone" autocomplete="off" class="form-control bg-transparent" required />
        <!--end::Email-->
        <span class="text-danger phone-error"></span>
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="email" placeholder="Email" id="email" name="email" autocomplete="off" class="form-control bg-transparent" />
        <!--end::Email-->
        <span class="text-danger email-error"></span>
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Company" id="company" name="company" autocomplete="off" class="form-control bg-transparent" required />
        <!--end::Email-->
        <span class="text-danger company-error"></span>
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Address" id="address" name="address" autocomplete="off" class="form-control bg-transparent" required />
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="City" id="city" name="city" autocomplete="off" class="form-control bg-transparent" required />
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="State" id="state" name="state" autocomplete="off" class="form-control bg-transparent" required />
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Postal code" id="postal_code" name="postal_code" autocomplete="off" class="form-control bg-transparent" required />
    </div>
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Country" id="country" name="country" autocomplete="off" class="form-control bg-transparent" required />
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary save">Save changes</button>
</div>

<script>
    $(".save").on("click", () => {
        let name = $("#name").val()
        let phone = $("#phone").val()
        let email = $("#email").val()
        let company = $("#company").val()
        let address = $("#address").val()
        let city = $("#city").val()
        let state = $("#state").val()
        let postal_code = $("#postal_code").val()
        let country = $("#country").val()
        let errorFlag = 0;

        if (name == "") {
            errorFlag = 1;
            $(".name-error").html('field required');
        } else {
            $(".name-error").html('');
        }
        if (phone == "") {
            errorFlag = 1;
            $(".phone-error").html('field required');
        } else {
            $(".phone-error").html('');
        }

        if (errorFlag == 1) {
            return false;
        }
        Customer.addCustomer({
            'name' : name,
            'phone' : phone,
            'email' : email,
            'company' : company,
            'address' : address,
            'city' : city,
            'state' : state,
            'postal_code' : postal_code,
            'country' : country,
        })
    })
</script>