<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<style>
    #productSearchBox,
    #customerSearchBox {
        background: #9b9b9b !important;
        color: white !important;
    }
</style>
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Georgia Phone Case</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('dashboard') ?>" class="text-muted text-hover-primary">Point of sale</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::About card-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-5 px-lg-19 py-lg-16">
                    <div class="row">
                        <div class="col-md-8 row">
                            <div class="col-md-12">
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addProductModal" class="btn btn-primary float-end">+ ADD PRODUCT</a>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating border rounded mt-5">
                                    <div class="row" id="productSearchBoxDiv"></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 row">
                            <div class="col-md-12">
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addCustomerModal" class="btn btn-primary float-end">+ ADD CUSTOMER</a>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating border rounded mt-5">
                                    <div class="row" id="customerSearchBoxDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                            <thead>
                                <th>SR. No.</th>
                                <th>Product</th>
                                <th width="150">Price</th>
                                <th width="90">Quantity</th>
                                <th>Amount</th>
                                <th>Tax</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="productBody">
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <textarea class="form-control note" name="note" placeholder="Order note..." rows="3"></textarea> <br>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input tax" type="checkbox" value="1" id="emailInvoice">
                                <label class="form-check-label ps-2" for="emailInvoice">Email invoice to customer</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-200px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">1</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">Total Quantity</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-200px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="75" data-kt-initialized="1">$6.99</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">Total Amount</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-200px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%" data-kt-initialized="1">$0.42</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">Total Tax</div>
                                </div>
                                <div class="border border-gray-800 border-dashed rounded min-w-200px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%" data-kt-initialized="1">$7.41</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">Grand Total</div>
                                </div>
                            </div> -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> Total Qty </td>
                                            <td class="totalCount">0</td>
                                        </tr>
                                        <tr>
                                            <td> Total Amount </td>
                                            <td>$<span class="totalAmount">0</span></td>
                                        </tr>
                                        <!--<tr class="dicountTR">-->
                                        <!--    <td> Discount - <span id="discountTitleSpan"></span></td>-->
                                        <!--    <td>$<span class="discountAmount">0</span></td>-->
                                        <!--</tr>-->
                                        <tr>
                                            <td> Total Tax</td>
                                            <td>$<span class="totalTax">0</span></td>
                                        </tr>
                                        <tr class="feesTR">
                                            <td> Fees - <span id="feesTitleSpan"></span></td>
                                            <td>$<span class="feesAmount">0</span></td>
                                        </tr>
                                        <tr class="shippingTR">
                                            <td> Shipping - <span id="shippingTitleSpan"></span></td>
                                            <td>$<span class="shippingAmount">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Grand Total</h4>
                                            </td>
                                            <td>
                                                <h4>$<span class="grandTotal">0</span></h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-end">
                                <a href="javascript:void(0)" class="btn btn-bg-secondary removeTax"><i class="fa fa-minus"></i> Remmove Tax</a>
                                <a href="javascript:void(0)" class="btn btn-bg-secondary feesA" data-bs-toggle="modal" data-bs-target="#feesModal"><i class="fa fa-money-bill"></i> Fee</a>
                                <a href="javascript:void(0)" class="btn btn-bg-secondary shippingA" data-bs-toggle="modal" data-bs-target="#shippingModal"><i class="fa fa-truck"></i> Shipping</a>
                                <!--<a href="javascript:void(0)" class="btn btn-bg-secondary shippingA" data-bs-toggle="modal" data-bs-target="#discountModal"><i class="fa fa-money-bill"></i> Discount</a>-->
                                <a href="javascript:void(0)" class="btn btn-bg-secondary checkoutModel"><i class="fa fa-shopping-cart"></i> Checkout</a>
                                <a href="javascript:void(0)" class="btn btn-bg-secondary"><i class="fa fa-refresh"></i> Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::About card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->

<div class="modal fade" tabindex="-1" id="feesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Fees </h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Fee Name</label>
                    <input type="text" class="form-control fee_type" name="fee_type" id="fee_name">
                </div>
                <div class="form-group">
                    <label>Fee Amount</label>
                    <input type="text" class="form-control fee_price" name="fee_price" id="fee_amount">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addFees" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="discountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Discount </h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Discount Name</label>
                    <input type="text" class="form-control discount_name" name="discount_name" id="discount_name">
                </div>
                <div class="form-group">
                    <label>Discount Amount</label>
                    <input type="text" class="form-control discount_amount" name="discount_amount" id="discount_amount">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addDiscount" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="shippingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Shipping </h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Shipping Method</label>
                    <select class="form-control shipping_type" id="shipping_method" name="shipping_type">
                        <option value="1">Flat Rate</option>
                        <option value="2">Free Shipping</option>
                        <option value="3">Local Pickup</option>
                        <option value="4">Table Rate</option>
                        <option value="5">UPS</option>
                        <option value="6">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Shipping Amount</label>
                    <input type="text" class="form-control shipping_price" name="shipping_price" id="shipping_amount">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addShipping" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="paymentMethodModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label>Payment Method</label>
                    <select class="form-control payment_type" id="payment_type" name="payment_type">
                        <option value="1">POS Cash</option>
                        <option value="2">POS Card</option>
                        <option value="3">POS Check</option>
                        <option value="4">Zelle</option>
                        <option value="5">Cash App</option>
                        <option value="6">Others</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary checkout" data-bs-dismiss="modal">Checkout</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="addProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Product </h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Product Name">
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" id="product_price" placeholder="Price">
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" id="product_quantity" placeholder="Quantity">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addProduct" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="addCustomerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Customer </h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-2">
                            <label>First Name</label>
                            <input type="text" class="form-control fname_cus" name="fname_cus" id="first_name" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-2">
                            <label>Last Name</label>
                            <input type="text" class="form-control lname_cus" name="lname_cus" id="last_name" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control cus_email" name="cus_email" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-2">
                            <label>Phone</label>
                            <input type="number" class="form-control cus_phone" name="cus_phone" id="phone" placeholder="Phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-2">
                            <label>Address 1</label>
                            <input type="text" class="form-control address1" name="address1" id="address_1" placeholder="Address 1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-2">
                            <label>Address 2</label>
                            <input type="text" class="form-control address2" name="address2" id="address_2" placeholder="Address 2">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-2">
                            <label>Country</label>
                            <input type="text" class="form-control country" name="country" id="country" placeholder="Country">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-2">
                            <label>State</label>
                            <input type="text" class="form-control state" name="state" id="state" placeholder="State">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-2">
                            <label>City</label>
                            <input type="text" class="form-control city" name="city" id="city" placeholder="City">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-2">
                            <label>Zipcode</label>
                            <input type="text" class="form-control postcode" name="postcode" id="zipcode" placeholder="Zipcode">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addCustomer" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="feesTitle" value="">
<input type="hidden" id="fees" value="">
<input type="hidden" id="shippingTitle" value="shipping">
<input type="hidden" id="shipping" value="">

<script type="text/javascript">
    let productIndex = 1;

    function formateAmount(val) {
        return (parseFloat(val)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    const customerSearchBox = {
        init: () => {
            $("#customerSearchBoxDiv").html(`
                <div class="w-100 position-relative mb-5">
                    <input id="customerSearchBox" type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search customer by name or email..." data-kt-search-element="input" />
                    <input type="hidden" class="customer" id="customer" value="-1">
                    <button class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5" onclick="customerSearchBox.clearAll()">
                        X
                    </button>
                </div>
                <div class="py-5">
                    <div id="customerResultDiv" data-kt-search-element="results">
                        <div class="mh-300px scroll-y me-n5 pe-5" id="customerResultInnerHTML">
                        </div>
                    </div>
                    <div id="customerEmptyDiv" data-kt-search-element="empty" class="text-center">
                        <div data-kt-search-element="empty" class="text-center">
                            <div class="fw-semibold py-0 mb-10">
                                <div class="text-gray-600 fs-3 mb-2">No customer found</div>
                                <div class="text-gray-400 fs-6">Try to search by full name or email...</div>
                            </div>
                        </div>
                    </div>
                </div>
            `)
            $("#customerResultDiv").hide();
            $("#customerEmptyDiv").hide();
            customerSearchBox.inputHandler();
        },

        clear: () => {
            $(`#customerResultDiv`).hide();
            $(`#customerEmptyDiv`).hide();
            $(`#customerResultInnerHTML`).html('');

        },

        clearAll: () => {
            $(`#customer`).val('');
            $(`#customerResultDiv`).hide();
            $(`#customerEmptyDiv`).hide();
            $(`#customerResultInnerHTML`).html('');
            $("#customerSearchBox").val('')
        },

        inputHandler: () => {
            $("#customerSearchBox").on('keyup', (e) => {
                customerSearchBox.clear();
                let searchVal = $("#customerSearchBox").val();
                if (e.key === "Enter") {
                    e.preventDefault();
                    if (searchVal !== "" && searchVal != null && searchVal) {
                        $.ajax({
                            url: `${apiURL}getcustomer.php`,
                            type: "GET",
                            dataType: "JSON",
                            data: {
                                'term': searchVal
                            },
                            success: (result) => {
                                $(`#customerResultInnerHTML`).html('');
                                if (result.length > 0) {
                                    $.each(result, (i, val) => {
                                        $(`#customerResultInnerHTML`).append(
                                            `<div class="cutomer d-flex align-items-center p-3 rounded-3 border-hover border border-dashed border-gray-300 cursor-pointer mb-1 customers" data-kt-search-element="customer" data-id="${val.id}" onclick="customerSearchBox.process(${val.id}, '${val.first_name} ${val.last_name}', '${val.user_email}')">
                                            <div class="fw-semibold">
                                                <span class="fs-6 text-gray-800 me-2">${val.first_name} ${val.last_name}</span>
                                                <span class="badge badge-light">${val.user_email}</span>
                                            </div>
                                        </div>`
                                        )
                                    })
                                    $(`#customerResultDiv`).show();
                                } else {
                                    $(`#customerResultDiv`).hide();
                                    $(`#customerEmptyDiv`).show();
                                }
                            },
                            beforeSend: () => {
                                $(`#customerResultInnerHTML`).html('');
                            },
                        });
                    }

                }
            })
        },

        process: (id, name, email) => {
            $("#customerSearchBox").val(`${name} - ${email}`)
            $(`#customer`).val(id);
            customerSearchBox.clear();
        }
    }

    const productSearchBox = {
        init: () => {
            $("#productSearchBoxDiv").html(`
            <div class="w-100 position-relative mb-5">
                <input id="productSearchBox" type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search product by name..." data-kt-search-element="input" />
                <input type="hidden" id="product">
                <button class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5" onclick="productSearchBox.clearAll()">
                    X
                </button>
            </div>
            <div class="py-5">
                <div id="productResultDiv" data-kt-search-element="results">
                    <div class="mh-300px scroll-y me-n5 pe-5" id="productResultInnerHTML">
                    </div>
                </div>
                <div id="productEmptyDiv" data-kt-search-element="empty" class="text-center">
                    <div data-kt-search-element="empty" class="text-center">
                        <div class="fw-semibold py-0 mb-10">
                            <div class="text-gray-600 fs-3 mb-2">No product found</div>
                            <div class="text-gray-400 fs-6">Try to search by full name or email...</div>
                        </div>
                    </div>
                </div>
            </div>
        `)
            $("#productResultDiv").hide();
            $("#productEmptyDiv").hide();
            productSearchBox.inputHandler();
        },

        clear: () => {
            $(`#productResultDiv`).hide();
            $(`#productEmptyDiv`).hide();
            $(`#productResultInnerHTML`).html('');

        },

        clearAll: () => {
            $(`#product`).val('');
            $(`#productResultDiv`).hide();
            $(`#productEmptyDiv`).hide();
            $(`#productResultInnerHTML`).html('');
            $("#productSearchBox").val('')
        },

        inputHandler: () => {
            $("#productSearchBox").on('keyup', (e) => {
                productSearchBox.clear();
                let searchVal = $("#productSearchBox").val();
                if (e.key === "Enter") {
                    e.preventDefault();
                    if (searchVal !== "" && searchVal != null && searchVal) {
                        $.ajax({
                            url: `${apiURL}products.php`,
                            type: "GET",
                            dataType: "JSON",
                            data: {
                                'term': searchVal
                            },
                            success: (result) => {
                                $(`#productResultInnerHTML`).html('');
                                if (result.length > 0) {
                                    $.each(result, (i, val) => {
                                        if (val.id != undefined) {
                                            $(`#productResultInnerHTML`).append(
                                                `<div class="product d-flex align-items-center p-3 rounded-3 border-hover border border-dashed border-gray-300 cursor-pointer mb-1 products" data-kt-search-element="product" data-id="${val.id}" onclick="productSearchBox.process(${val.id}, '${val.name}', '${val.price}')">
                                                <div class="fw-semibold">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <div class="symbol-label">
                                                                    <img src="https://www.georgiaphonecase.com/wp-content/uploads/${val.thumbnail}" alt="Emma Smith" class="w-100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <span class="fs-6 text-gray-800 me-2">${val.name}</span><br>
                                                            <span class="badge badge-light">Stock : ${val.stock}</span>
                                                            <span class="badge badge-light">price : $${val.price}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`
                                            )
                                        }
                                    })
                                    $(`#productResultDiv`).show();
                                } else {
                                    $(`#productResultDiv`).hide();
                                    $(`#productEmptyDiv`).show();
                                }
                            },
                            beforeSend: () => {
                                $(`#productResultInnerHTML`).html('');
                            },
                        });
                    }
                }
            })
        },

        process: (productId, productName, productPrice) => {
            let continueProcess = 1;
            $(".productId").each((i, val) => {
                if ($(val).val() == productId) {
                    continueProcess = 0;
                }
            })
            if (continueProcess) {
                let tr = `
                <tr id="tr-${productId}">
                    <td class="productIndex">${productIndex}</td>
                    <td>${productName}</td>
                    <td>
                        <input type="hidden" class="productId" data-id="${productId}" value="${productId}">
                        <input type="hidden" class="productName productName-${productId}" data-id="${productId}" value="${productName}">
                        <input type="hidden" class="productAmount productAmount-${productId}" data-id="${productId}">
                        <input type="number" class="form-control productPrice productPrice-${productId}" data-id="${productId}" value="${productPrice}">
                    </td>
                    <td>
                        <input type="number" class="form-control productQuantity productQuantity-${productId}" data-id="${productId}" value="1">
                    </td>
                    <td class="totalProduct totalProduct-${productId}">${productPrice}
                        
                    </td>
                    <td>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input tax" type="checkbox" value="1" id="tax-${productId}" checked="checked" data-id="${productId}">
                            <label class="form-check-label ps-2" for="tax-${productId}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="btn btn-icon btn-danger btn-sm removeProduct" data-id="${productId}">
                            <i class="fas fa-minus "></i>
                        </a>
                    </td>
                </tr>
                `;
                $("#productBody").append(tr);
                productIndex += 1;
                POSProcess.productsCalc()
            }
            productSearchBox.clearAll();
        }
    }

    const POSProcess = {
        init: () => {

        },
        productsCalc: () => {
            let totalPrice = 0;
            let totalQuantity = 0;
            let totalTax = 0;
            $(".productId").each(function(i, val) {
                let productId = $(val).attr('data-id');
                let productPrice = $(`.productPrice-${productId}`).val();
                let productQuantity = $(`.productQuantity-${productId}`).val();
                let productTotal = parseFloat(productPrice) * parseFloat(productQuantity)
                $(`.totalProduct-${productId}`).html(productTotal);
                $(`.productAmount-${productId}`).val(productTotal);
                let tax = 0;
                if ($(`#tax-${productId}`).is(":checked")) {
                    totalTax = parseFloat(totalTax) + (parseFloat(productTotal) / 100) * 6;
                }
                totalQuantity += parseFloat(productQuantity)
                totalPrice = parseFloat(totalPrice) + parseFloat(productTotal);
            })
            let fees = 0;
            let shipping = 0;
            if ($("#fees").val() != 0) {
                fees = $("#fees").val()
            }
            let discount = 0;
            if ($("#discount_amount").val() != 0) {
                discount = $("#discount_amount").val()
            }
            if ($("#shipping").val() != 0) {
                shipping = $("#shipping").val()
            }
            $(".totalCount").html(totalQuantity);
            $(".totalAmount").html(formateAmount(totalPrice));
            totalPrice = parseFloat(totalPrice) - parseFloat(discount)
            $(".totalTax").html(formateAmount(totalTax));
            $(".feesAmount").html(formateAmount(fees));
            $(".discountAmount").html(formateAmount(discount));
            $(".shippingAmount").html(formateAmount(shipping));
            let grandTotal = parseFloat(totalPrice) + parseFloat(totalTax) + parseFloat(fees) + parseFloat(shipping)
            $(".grandTotal").html(formateAmount(grandTotal));
        },
        productCalc: (productId) => {
            POSProcess.productsCalc();
        },

        removeProduct: (productId) => {
            $(`#tr-${productId}`).remove();
            $(".productIndex").each(function(i, val) {
                $(val).html(i + 1)
            })
            POSProcess.productsCalc();
        }
    }

    $(document).ready(() => {
        customerSearchBox.init()
        productSearchBox.init()
        // POSProcess.init();
        POSProcess.productsCalc();

        $(".feesTR").hide();
        $(".shippingTR").hide();
        $(".discountTR").hide();
    })

    $(document).on("click", ".addFees", function() {
        let fee_name = $("#fee_name").val()
        let fee_amount = $("#fee_amount").val()
        $("#feesTitle").val(fee_name)
        $("#fees").val(fee_amount)
        $("#feesTitleSpan").html(fee_name)
        POSProcess.productsCalc();
        $(".feesTR").show();
    })

    $(document).on("click", ".addDiscount", function() {
        let discount_name = $("#discount_name").val()
        $("#discountTitleSpan").html(discount_name)
        POSProcess.productsCalc();
        $(".discountTR").show();
    })
    
    $(document).on("change", ".productPrice", function(){
        POSProcess.productsCalc();
    })

    $(document).on("click", ".addShipping", function() {
        let shippingTitle = $("#shipping_method").val()
        let shipping = $("#shipping_amount").val()
        $("#shippingTitle").val(shippingTitle)
        $("#shipping").val(shipping)
        $("#shippingTitleSpan").html(shippingTitle)
        POSProcess.productsCalc();
        $(".shippingTR").show();

    })

    $(document).on("click", ".removeProduct", function() {
        let productId = $(this).attr('data-id')
        POSProcess.removeProduct(productId)
    })

    $(document).on("click", ".addCustomer", function() {
        $("#customerSearchBox").val(`${$(".fname_cus").val()} ${$(".lname_cus").val()} - ${$(".cus_email").val()}`)
        $(`#customer`).val('-1');
        customerSearchBox.clear();
    })

    $(document).on("click", ".removeTax", () => {
        $(".tax").each(function(i, val) {
            $(val).prop('checked', false);
        })
        POSProcess.productsCalc()
    })

    $(document).on("change", ".productQuantity", () => {
        POSProcess.productsCalc()
    })

    $(document).on("change", ".tax", () => {
        POSProcess.productsCalc()
    })

    let newProduct = 99999999;
    $(".addProduct").on("click", function() {
        let productName = $("#product_name").val()
        let productPrice = $("#product_price").val()
        let productQuantity = $("#product_quantity").val()

        let tr = `
            <tr id="tr-${newProduct}">
                <td class="productIndex">${productIndex}</td>
                <td>${productName}</td>
                <td>
                    <input type="hidden" class="productId" data-id="${newProduct}" value="-1">
                    <input type="hidden" class="productName productName-${newProduct}" data-id="${newProduct}" value="${productName}">
                    <input type="number" class="form-control productPrice productPrice-${newProduct}" data-id="${newProduct}" value="${productPrice}">
                    <input type="hidden" class="productAmount productAmount-${newProduct}" data-id="${newProduct}">
                </td>
                <td>
                    <input type="number" class="form-control productQuantity productQuantity-${newProduct}" data-id="${newProduct}" value="1">
                </td>
                <td class="totalProduct totalProduct-${newProduct}">${productPrice}
                </td>
                <td>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input tax" type="checkbox" value="1" id="tax-${newProduct}" checked="checked" data-id="${newProduct}">
                        <label class="form-check-label ps-2" for="tax-${newProduct}"></label>
                    </div>
                </td>
                <td>
                    <a href="javascript:;" class="btn btn-icon btn-danger btn-sm removeProduct" data-id="${newProduct}">
                        <i class="fas fa-minus "></i>
                    </a>
                </td>
            </tr>
            `;
        $("#productBody").append(tr);
        newProduct += 1;
        POSProcess.productsCalc()
    })

    $(".checkoutModel").on("click", () => {
        let customer = $("#customerSearchBox").val();
        let errorFlag = 0;
        if (customer == "") {
            toastr.error("Error", 'Please select customer');
            errorFlag = 1;
        }
        if ($(".productId").length <= 0) {
            toastr.error("Error", 'Please add product in order');
            errorFlag = 1;
        }
        if (errorFlag == 0) {
            $("#paymentMethodModal").modal('show');
        }
    })

    const sendInvoiceEmail = (ID) => {
        $.ajax({
            url: `${siteURL}online_sales/send_invoice_email`,
            type: "GET",
            dataType: "JSON",
            data: {
                id: ID
            },
            success: (result) => {
                if (result.status == 200) {
                    toastr.success("Success", result.message);
                } else {
                    toastr.error("Error", result.message);
                }
                window.location.reload();
            },
            beforeSend: () => {
                toastr.info("Information", "Please wait your request is under process");
            },
            completed: () => {}
        });
    }

    $(".checkout").on("click", function() {
        let data = {};
        data['shipping_price'] = $(".shipping_price").val()
        data['shipping_type'] = $(".shipping_type").val()
        data['fee_type'] = $(".fee_type").val()
        data['fee_price'] = $(".fee_price").val()
        data['discount_name'] = $(".discount_name").val()
        data['discount_amount'] = $(".discount_amount").val()
        data['payment_type'] = $(".payment_type").val()
        data['customer'] = $(".customer").val()
        data['fname_cus'] = $(".fname_cus").val()
        data['lname_cus'] = $(".lname_cus").val()
        data['cus_phone'] = $(".cus_phone").val()
        data['cus_email'] = $(".cus_email").val()
        data['address2'] = $(".address2").val()
        data['country'] = $(".country").val()
        data['city'] = $(".city").val()
        data['state'] = $(".state").val()
        data['postcode'] = $(".postcode").val()
        data['note'] = $(".note").val()
        data['tr_body_total'] = $(".productId").length;
        $(".productId").each(function(i, v) {
            let index = parseFloat(i) + 1
            let productId = $(this).attr('data-id')
            data[`pid${index}`] = $(this).val();
            data[`product_name${index}`] = $(`.productName-${productId}`).val();
            data[`price${index}`] = $(`.productPrice-${productId}`).val();
            data[`qty${index}`] = $(`.productQuantity-${productId}`).val();
            data[`amount${index}`] = $(`.productAmount-${productId}`).val();
            data[`type${index}`] = "1";
            if ($(`#tax-${productId}`).is(":checked")) {
                data[`tax${index}`] = "1";
            } else {
                data[`tax${index}`] = "0";
            }
        })
        let jsonString = JSON.stringify(data);
        const obj = JSON.parse(jsonString)
        $.ajax({
            url: `${apiURL}addorder.php`,
            type: "POST",
            dataType: "JSON",
            data: {
                obj
            },
            success: (result) => {
                console.log(result)
                if (result.status == 200) {
                    let sendInvoice = $("#emailInvoice").is(":checked");
                    if (sendInvoice) {
                        sendInvoiceEmail(result.pid)
                    } else {
                        toastr.success("Success", result.message);
                        window.location.reload();
                    }
                } else {
                    toastr.error("Error", result.message);
                }
            },
            beforeSend: () => {
                toastr.info("Information", "Please wait your request is under process");
            },
            completed: () => {}
        });
    })
</script>
<?= $this->endSection('content') ?>