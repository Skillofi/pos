<?= $this->extend('base') ?>
<?= $this->section('content') ?>
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
                        <div class="col-md-12 row mb-3">
                            <h4>Invoice #<?= $sales['id'] ?></h4>
                        </div>
                        <div class="col-md-12 row mb-3">
                            <div class="col-md-6">
                                <h5><span class="customerName">Customer</span>: <?= ucwords($sales['name']) ?>
                                    <a href="javascript:;" onclick="Customer.updateModal('<?= $sales['customer_id'] ?>')"><i class="fa fa-pen"></i></a>
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <h5 class="customerEmail">Email: <?= strtolower($sales['email']) ?></h5>
                            </div>
                        </div>

                        <div class="col-md-12 row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date *</label>
                                    <input type="datetime-local" class="form-control" id="date_time" placeholder="Date time" required value="<?= $sales['date_time'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Reference Number</label>
                                    <input type="number" class="form-control" id="reference_no" placeholder="Reference No." value="<?= $sales['reference_no'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Warehouse *</label>
                                    <select class="form-control warehouse" name="warehouse" id="warehouse">
                                        <option <?= ($sales['warehouse'] == 'Stone Mountain') ? "selected" : "" ?> value="Stone Mountain">Stone Mountain</option>
                                        <option <?= ($sales['warehouse'] == 'Warehouse 2') ? "selected" : "" ?> value="Warehouse 2">Warehouse 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 row">

                        </div>
                    </div>
                    <hr>
                    <div class="row mt-5">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                            <thead class="">
                                <th>SR. No.</th>
                                <th>Product</th>
                                <th width="150">Price</th>
                                <th width="90">Quantity</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="">
                                <?php foreach ($salesDetails as $key => $salesDetail) : ?>
                                    <tr id="tr-<?= $salesDetail['id'] ?>">
                                        <td class="productIndex"><?= $key + 1 ?></td>
                                        <td><?= $salesDetail['name'] ?></td>
                                        <td>
                                            <input type="hidden" class="salesDetailsId" data-id="<?= $salesDetail['id'] ?>" value="<?= $salesDetail['id'] ?>">
                                            <input type="number" class="form-control productPrice productPrice-<?= $salesDetail['id'] ?>" data-id="<?= $salesDetail['id'] ?>" value="<?= $salesDetail['price'] ?>">
                                            <input type="hidden" class="productAmount productAmount-<?= $salesDetail['id'] ?>" data-id="<?= $salesDetail['id'] ?>" value="<?= $salesDetail['amount'] ?>">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control productQuantity productQuantity-<?= $salesDetail['id'] ?>" data-id="<?= $salesDetail['id'] ?>" value="<?= $salesDetail['qty'] ?>">
                                        </td>
                                        <td class="totalProduct totalProduct-<?= $salesDetail['id'] ?>"><?= $salesDetail['price'] ?></td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-icon btn-danger btn-sm removeProduct" data-id="<?= $salesDetail['id'] ?>">
                                                <i class="fas fa-minus "></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="col-md-12 row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tax *</label>
                                <select class="form-control tax" name="tax" id="tax">
                                    <option <?= ($sales['tax'] == "6") ? "selected" : "" ?> value="6">VAT@6%</option>
                                    <option <?= ($sales['tax'] == "7") ? "selected" : "" ?> value="7">VAT@7%</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="number" class="form-control" id="discount" placeholder="00" value="<?= $sales['discount'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Shipping</label>
                                <input type="number" class="form-control" id="shipping" placeholder="00" value="<?= $sales['shipping'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sale Status *</label>
                                <select class="form-control status" name="status" id="status">
                                    <option <?= ($sales['status'] == "Pending") ? "selected" : "" ?> value="Pending">Pending</option>
                                    <option <?= ($sales['status'] == "Completed") ? "selected" : "" ?> value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Status *</label>
                                <select class="form-control payment_status" name="payment_status" id="payment_status">
                                    <option <?= ($sales['payment_status'] == "Pending") ? "selected" : "" ?> value="Pending">Pending</option>
                                    <option <?= ($sales['payment_status'] == "Due") ? "selected" : "" ?> value="Due">Due</option>
                                    <option <?= ($sales['payment_status'] == "Partial") ? "selected" : "" ?> value="Partial">Partial</option>
                                    <option <?= ($sales['payment_status'] == "Paid") ? "selected" : "" ?> value="Paid">Paid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sale Note</label>
                                <textarea class="form-control sale_note" id="sale_note" name="sale_note" placeholder="Sale Note..." rows="3"><?= $sales['sale_note'] ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Staff Note</label>
                                <textarea class="form-control staff_note" id="staff_note" name="staff_note" placeholder="Staff Note..." rows="3"><?= $sales['staff_note'] ?></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> Total Items </td>
                                            <td class="totalCount">0.00</td>
                                        </tr>
                                        <tr>
                                            <td> Total Amount </td>
                                            <td>$<span class="totalAmount">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td> Order Discount </td>
                                            <td>$<span class="totalDiscount">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td> Order Tax</td>
                                            <td>$<span class="totalTax">0.00</span></td>
                                        </tr>
                                        <tr class="">
                                            <td> Shipping</td>
                                            <td>$<span class="shippingAmount">0.00</span></td>
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
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input tax" type="checkbox" value="1" id="emailInvoice">
                                    <label class="form-check-label ps-2" for="emailInvoice">Email invoice to customer</label>
                                </div>
                            </div>
                            <div class="float-end" style="margin-top:200px">
                                <a href="javascript:void(0)" class="btn btn-bg-secondary checkout"><i class="fa fa-shopping-cart"></i> Save</a>
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
<input type="hidden" class="pos_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
<input type="hidden" id="salesId" value="<?= $sales['id'] ?>" />
<div class="removeProductDiv d-none">
</div>
<script type="text/javascript">
    let productIndex = 1;

    function formateAmount(val) {
        return (parseFloat(val)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }


    const productSearchBox = {
        init: () => {},

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
                if (searchVal !== "" && searchVal != null && searchVal) {
                    $.ajax({
                        url: `${siteURL}product/search_product`,
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
                                            <div class="col-md-12">
                                                <span class="fs-6 text-gray-800 me-2">${val.name} - <small>${val.code}</small></span><br>
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
                if (e.key === "Enter") {
                    e.preventDefault();
                }
            })
        },

        process: (productId, productName, productPrice) => {

        }
    }

    const POSProcess = {
        init: () => {},
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
                totalQuantity += parseFloat(productQuantity)
                totalPrice = parseFloat(totalPrice) + parseFloat(productTotal);
            })
            let shipping = 0;
            if ($("#shipping").val() != 0) {
                shipping = $("#shipping").val()
            }
            let discount = 0;
            if ($("#discount").val() != 0) {
                discount = $("#discount").val()
            }
            let tax = $("#tax").val();
            totalPrice = parseFloat(totalPrice) - parseFloat(discount);
            totalTax = ((parseFloat(totalPrice) * parseFloat(tax)) / parseFloat(100))
            $(".totalCount").html(totalQuantity);
            $(".totalAmount").html(formateAmount(totalPrice));
            $(".totalTax").html(formateAmount(totalTax));
            $(".shippingAmount").html(formateAmount(shipping));
            let grandTotal = (parseFloat(totalPrice)) + parseFloat(totalTax) + parseFloat(shipping)
            $(".grandTotal").html(formateAmount(grandTotal));
        },
        productCalc: (productId) => {
            POSProcess.productsCalc();
        },

        removeProduct: (productId) => {
            $(`.removeProductDiv`).append(
                `<input type="hidden" value="${productId}" class="removedProduct">`
            )
            $(`#tr-${productId}`).remove();
            $(".productIndex").each(function(i, val) {
                $(val).html(i + 1)
            })
            POSProcess.productsCalc();
        }
    }

    const Init = {
        datePicker: () => {
            const element1 = document.querySelector('#date_time');
            flatpickr = $(element1).flatpickr({
                altInput: true,
                enableTime: true,
                altFormat: "m/d/Y H:i",
                dateFormat: "Y-m-d H:i",
                onChange: function(selectedDates, dateStr, instance) {
                    // handleFlatpickr(selectedDates, dateStr, instance);
                    Init.datePickerHandler(selectedDates, dateStr, instance)
                },
            });
        },

        datePickerHandler: (selectedDates, dateStr, instance) => {
            minDate = selectedDates[0] ? new Date(selectedDates[0]) : null;
            maxDate = selectedDates[1] ? new Date(selectedDates[1]) : null;

            // Datatable date filter --- more info: https://datatables.net/extensions/datetime/examples/integration/datatables.html
            // Custom filtering function which will search data in column four between two values
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = minDate;
                    var max = maxDate;
                    var dateAdded = new Date(moment($(data[5]).text(), 'DD/MM/YYYY'));
                    var dateModified = new Date(moment($(data[6]).text(), 'DD/MM/YYYY'));

                    if (
                        (min === null && max === null) ||
                        (min === null && max >= dateModified) ||
                        (min <= dateAdded && max === null) ||
                        (min <= dateAdded && max >= dateModified)
                    ) {
                        return true;
                    }
                    return false;
                }
            );
        },
        formateAmount: (val) => {
            if (val) {
                return '$' + (parseFloat(val)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            } else {
                return `$0.00`;
            }
        }
    }

    $(document).ready(() => {
        POSProcess.productsCalc();
        Init.datePicker()
    })

    $(document).on("change", "#tax", function() {
        POSProcess.productsCalc();
    })

    $(document).on("change", "#discount", function() {
        let discount = $("#discount").val()
        $(".totalDiscount").html('$' + (parseFloat(discount)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'))
        POSProcess.productsCalc();
    })

    $(document).on("change", "#shipping", function() {
        POSProcess.productsCalc();
    })

    $(document).on("change", ".productPrice", function() {
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

    $(document).on("change", ".productQuantity", () => {
        POSProcess.productsCalc()
    })

    const Product = {

    }

    const Customer = {
        updateModal: (id) => {
            $.ajax({
                url: `${siteURL}customer/update_customer`,
                type: "GET",
                dataType: "HTML",
                data: {
                    id: id
                },
                success: (result) => {
                    toastr.clear();
                    $("#modal").modal('show');
                    $("#modal-content").html(result);
                },
                beforeSend: () => {
                    toastr.info("Information", "Please wait your request is under process");
                }
            });
        },
        updateCustomer: (data) => {
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            $.ajax({
                url: `${siteURL}customer/update_customer`,
                type: "POST",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    id: data.id,
                    'name': data.name,
                    'phone': data.phone,
                    'email': data.email,
                    'company': data.company,
                    'address': data.address,
                    'city': data.city,
                    'state': data.state,
                    'postal_code': data.postal_code,
                    'country': data.country,
                },
                success: (result) => {
                    toastr.clear()
                    if (result.status == 200) {
                        toastr.success("Success", result.message);
                        $(".customerName").html(data.name);
                        $(".customerEmail").html(data.email);
                        $("#modal").modal('hide');
                        $("#modal-content").html('');
                    } else {
                        toastr.danger("Error", result.message);
                    }
                },
                beforeSend: () => {
                    toastr.info("Information", "Please wait your request is under process");
                },
                onError: () => {
                    toastr.danger("Error", "Something went wrong");

                }
            });
        },
    }

    $(".checkout").on("click", function() {
        let data = {};
        var csrfName = $('.pos_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.pos_csrfname').val(); // CSRF hash
        data['sales_id'] = $("#salesId").val();
        data['date_time'] = $("#date_time").val();
        data['reference_no'] = $("#reference_no").val();
        data['warehouse'] = $("#warehouse").val();
        data['tax'] = $("#tax").val();
        data['discount'] = $("#discount").val();
        data['shipping'] = $("#shipping").val();
        data['payment_status'] = $("#payment_status").val();
        data['sale_note'] = $("#sale_note").val();
        data['staff_note'] = $("#staff_note").val();
        data['send_email'] = ($("#emailInvoice").is(":checked")) ? 1 : 0;
        let errorFlag = 0;
        let productData = [];
        $(".salesDetailsId").each(function(i, v) {
            let productId = $(this).attr('data-id')
            productData.push({
                'salesDetailsId': $(this).val(),
                'price': $(`.productPrice-${productId}`).val(),
                'qty': $(`.productQuantity-${productId}`).val(),
                'amount': $(`.productAmount-${productId}`).val(),
            })
        })
        let removedProduct = [];
        if($(".removedProduct").length > 0){
            $(".removedProduct").each(function(i, v) {
                removedProduct.push($(v).val())
            })
        }

        if (data['date_time'] == "") {
            toastr.error("Error", 'Please select date time');
            errorFlag = 1;
        }
        if (productData.length <= 0) {
            toastr.error("Error", 'Please add product');
            errorFlag = 1;
        }
        if (errorFlag == 0) {
            data['products'] = productData;
            data['removedProduct'] = removedProduct;
            $.ajax({
                url: `${siteURL}retail_sales/edit_sales`,
                type: "POST",
                dataType: "JSON",
                data: {
                    [csrfName]: csrfHash,
                    data
                },
                success: (result) => {
                    if (result.status == 200) {
                        toastr.success("Success", result.message);
                        window.location.reload();
                    } else {
                        toastr.error("Error", result.message);
                    }
                },
                beforeSend: () => {
                    toastr.info("Information", "Please wait your request is under process");
                },
                completed: () => {}
            });
        }
    })
</script>
<?= $this->endSection('content') ?>