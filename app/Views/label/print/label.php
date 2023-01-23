<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<style>
    .barcode-div {
        width: 238px !important;
    }
</style>
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Label Printing</h1>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form class="form w-100" novalidate="validate" id="label-form" method="POST" action="<?= base_url() ?>/label_product/print_label">
                <?= csrf_field() ?>
                <div class="col-md-12 row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12 mb-7">
                                    <div class="form-floating border rounded mt-5">
                                        <div class="row" id="productSearchBoxDiv"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-7 iemi-div">
                                    <input type="hidden" value="" id="productId" class="productId" name="productId" />
                                    <div class="form-group row iemi-div-1 mb-7">
                                        <div class="col-md-8">
                                            <label class="form-label">IEMI:</label>
                                            <input type="text" class="form-control mb-2 mb-md-0 iemi" placeholder="Enter IEMI" name="iemi[]" data-id="1" />
                                        </div>

                                        <div class="col-md-4">
                                            <a href="javascript:;" class="btn btn-sm btn-light-success mt-3 mt-md-8 add add-1">
                                                <i class="la la-plus"></i>Add
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm btn-light-danger mt-3 mt-md-8 delete delete-1" onclick="IEMI.remove(1)">
                                                <i class=" la la-trash-o"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mt-3 text-center">
                                        <div class="barcode-div barcode-div-1"></div>
                                    </div>
                                    <textarea class="d-none barcode-1" name="barcode[]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-flush fw-semibold gy-1">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">D No.</td>
                                            <td class="text-gray-800" id="dnumber"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Make</td>
                                            <td class="text-gray-800" id="make"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Brand</td>
                                            <td class="text-gray-800" id="brand"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Model No.</td>
                                            <td class="text-gray-800" id="model_no"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Storage</td>
                                            <td class="text-gray-800" id="storage"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Color</td>
                                            <td class="text-gray-800" id="color"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Grade</td>
                                            <td class="text-gray-800" id="grade"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">ICloud</td>
                                            <td class="text-gray-800" id="icloud"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Carrier</td>
                                            <td class="text-gray-800" id="carrier"></td>
                                        </tr>
                                        <tr>
                                            <td class="">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="3*2" id="3-2" name="size" checked="checked">
                                                    <label class="form-check-label" for="3-2">3*2</label>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="4*6" id="4-6" name="size">
                                                    <label class="form-check-label" for="4-6">4*6</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="barcode"></div>
                            <div class="card-footer">
                                <button onclick="window.location.reload();" class="btn btn-secondary">Cancel</button>
                                <button class="btn btn-success">Generate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('public/admin/js/vendors/plugins/barcode/code39.js') ?>"></script>
<script src="<?= base_url('public/admin/js/vendors/plugins/html2canvas/html2canvas.min.js') ?>"></script>
<script>
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
                            <div class="text-gray-400 fs-6">Try to search by D Number or Make...</div>
                        </div>
                    </div>
                </div>
            </div>`)
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
                if (searchVal !== "" && searchVal != null && searchVal) {
                    $.ajax({
                        url: `${siteURL}label_product/search_product`,
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            'term': searchVal
                        },
                        success: (result) => {
                            $(`#productResultInnerHTML`).html('');
                            if (result.length > 0) {
                                let data = {};
                                $.each(result, (i, val) => {
                                    if (val.id != undefined) {
                                        $(`#productResultInnerHTML`).append(
                                            `<div class="product d-flex align-items-center p-3 rounded-3 border-hover border border-dashed border-gray-300 cursor-pointer mb-1 products" data-kt-search-element="product" data-id="${val.id}" onclick='productSearchBox.process(id = "${val.id}", dnumber = "${val.dnumber}", make = "${val.make}", brand = "${val.brand}", model_no = "${val.model_no}", storage="${val.storage}", color = "${val.color}", grade = "${val.grade}", icloud =" ${val.icloud}", carrier = "${val.carrier}")'>
                                                <div class="fw-semibold">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <span class="fs-6 text-gray-800 me-2">${val.dnumber} - <small>${val.make}</small></span><br>
                                                            <span class="badge badge-light">Brand : ${val.brand}</span>
                                                            <span class="badge badge-light">Model No. : ${val.model_no}</span>
                                                            <span class="badge badge-light">Color : ${val.color}</span>
                                                            <span class="badge badge-light">Storage : ${val.storage}</span>
                                                            <span class="badge badge-light">Grade : ${val.grade}</span>
                                                            <span class="badge badge-light">ICloud : ${val.icloud}</span>
                                                            <span class="badge badge-light">Carrier : ${val.carrier}</span>
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
                // if (e.key === "Enter") {
                //     e.preventDefault();
                //     // if (searchVal !== "" && searchVal != null && searchVal) {
                //     //     $.ajax({
                //     //         url: `${siteURL}label_product/search_product`,
                //     //         type: "GET",
                //     //         dataType: "JSON",
                //     //         data: {
                //     //             'term': searchVal
                //     //         },
                //     //         success: (result) => {
                //     //             $(`#productResultInnerHTML`).html('');
                //     //             if (result.length > 0) {
                //     //                 let data = {};
                //     //                 $.each(result, (i, val) => {
                //     //                     if (val.id != undefined) {
                //     //                         $(`#productResultInnerHTML`).append(
                //     //                             `<div class="product d-flex align-items-center p-3 rounded-3 border-hover border border-dashed border-gray-300 cursor-pointer mb-1 products" data-kt-search-element="product" data-id="${val.id}" onclick='productSearchBox.process(id = "${val.id}", dnumber = "${val.dnumber}", make = "${val.make}", brand = "${val.brand}", model_no = "${val.model_no}", storage="${val.storage}", color = "${val.color}", grade = "${val.grade}", icloud =" ${val.icloud}", carrier = "${val.carrier}")'>
                //     //                             <div class="fw-semibold">
                //     //                                 <div class="row">
                //     //                                     <div class="col-md-12">
                //     //                                         <span class="fs-6 text-gray-800 me-2">${val.dnumber} - <small>${val.make}</small></span><br>
                //     //                                         <span class="badge badge-light">Brand : ${val.brand}</span>
                //     //                                         <span class="badge badge-light">Model No. : ${val.model_no}</span>
                //     //                                         <span class="badge badge-light">Color : ${val.color}</span>
                //     //                                         <span class="badge badge-light">Storage : ${val.storage}</span>
                //     //                                         <span class="badge badge-light">Grade : ${val.grade}</span>
                //     //                                         <span class="badge badge-light">ICloud : ${val.icloud}</span>
                //     //                                         <span class="badge badge-light">Carrier : ${val.carrier}</span>
                //     //                                     </div>
                //     //                                 </div>
                //     //                             </div>
                //     //                         </div>`
                //     //                         )
                //     //                     }
                //     //                 })
                //     //                 $(`#productResultDiv`).show();
                //     //             } else {
                //     //                 $(`#productResultDiv`).hide();
                //     //                 $(`#productEmptyDiv`).show();
                //     //             }
                //     //         },
                //     //         beforeSend: () => {
                //     //             $(`#productResultInnerHTML`).html('');
                //     //         },
                //     //     });
                //     // }
                // }
            })
        },

        process: (id = id, dnumber = dnumber, make = make, brand = brand, model_no = model_no, storage = storage, color = color, grade = grade, icloud = icloud, carrier = carrier) => {
            $("#productId").val(id);
            $("#dnumber").html(dnumber);
            $("#make").html(make);
            $("#brand").html(brand);
            $("#model_no").html(model_no);
            $("#color").html(color);
            $("#storage").html(storage);
            $("#grade").html(grade);
            $("#icloud").html(icloud);
            $("#carrier").html(carrier);
            productSearchBox.clearAll();
        }
    }

    let iemiIndex = 2;
    const IEMI = {
        init: () => {
            $(".delete").hide();
            $(".add").show();

        },
        add: () => {
            $(".delete").show();
            $(".add").hide();
            updateDiv = `
                <div class="form-group row iemi-div-${iemiIndex}">
                    <div class="col-md-8 mb-7">
                        <label class="form-label">IEMI:</label>
                        <input type="text" class="form-control mb-2 mb-md-0 iemi" placeholder="Enter IEMI" name="iemi[]" data-id="${iemiIndex}" />
                    </div>
                    <div class="col-md-4">
                        <a href="javascript:;" class="btn btn-sm btn-light-success mt-3 mt-md-8 add add-${iemiIndex}">
                            <i class="la la-plus"></i>Add
                        </a>
                        <a href="javascript:;" class="btn btn-sm btn-light-danger mt-3 mt-md-8 delete delete-${iemiIndex}" onclick="IEMI.remove(${iemiIndex})">
                            <i class="la la-trash-o"></i>Delete
                        </a>
                    </div>
                    <div class="row mt-3 text-center">
                        <div class="barcode-div barcode-div-${iemiIndex}"></div>
                    </div>
                    <textarea class="d-none barcode-${iemiIndex}" name="barcode[]"></textarea>
                </div>`;
            $(".iemi-div").append(updateDiv);
            $(`.delete-${iemiIndex}`).hide();
            $(`.add-${iemiIndex}`).show();
            iemiIndex++;
        },
        remove: (id) => {
            $(`.iemi-div-${id}`).remove();
        }
    }

    $(document).on("click", ".add", () => {
        IEMI.add();
    })
    $(document).ready(function() {
        productSearchBox.init();
        IEMI.init();
    })

    $("#label-form").on("submit", (e) => {
        e.preventDefault();
        let productId = $("#productId").val();
        let errorFlag = 0;
        if (productId == "") {
            errorFlag = 1;
            toastr.error("Error", 'Please select product');
        }
        $(".iemi").each((index, value) => {
            if ($(value).val() == "") {
                errorFlag = 1;
                toastr.error("Error", 'Please enter IEMI');
            }
        })
        if (errorFlag == 0) {
            $("#label-form")[0].submit();
        }
    })

    $(document).on("blur", ".iemi", function() {
        let iemi = $(this).val();
        if (iemi != "") {
            let id = $(this).attr('data-id');
            let barcode = DrawCode39Barcode(iemi, 0);
            $(`.barcode-div-${id}`).html(barcode);
            var convertMeToImg = $(`.barcode-div-${id}:first-child`)[0];
            html2canvas(convertMeToImg).then(function(canvas) {
                $(`.barcode-div-${id}`).html(canvas);
                let canvasDiv = $(`.barcode-div-${id}`).children()[0];
                let dataURL = canvasDiv.toDataURL();
                $(`.barcode-${id}`).html(dataURL);
            });
        }
    })
</script>
<?= $this->endSection('content') ?>