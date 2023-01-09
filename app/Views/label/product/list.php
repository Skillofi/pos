<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<style>
    td img {
        width: 6em;
    }
</style>
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product List</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('product') ?>" class="text-muted text-hover-primary">Label Product List</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card" id="kt_block_ui_1_target">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-toolbar flex-row-fluid gap-5 justify-content-end">
                        <a onclick="Product.addModal()" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal" class="float-end btn btn-sm fw-bold btn-secondary">Add Product</a>
                    </div>
                </div>
                <div class="card-body p-5 px-lg-19 py-lg-16">
                    <div class="row">
                        <div class="table-response">
                            <table class="table  table-row-bordered fs-6 gy-5 dataTable no-footer" id="product-list">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Make</th>
                                        <th>Brand</th>
                                        <th>Storage</th>
                                        <th>ICloud</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content wrapper-->
<input type="hidden" class="product_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
<script>
    const Init = {
        dataTables: () => {
            // Transaction List Datatable
            if ($.fn.DataTable.isDataTable('#product-list')) {
                $('#product-list').dataTable().fnClearTable();
                $('#product-list').dataTable().fnDestroy();
            }
            $("#product-list").DataTable({
                language: {
                    // processing: `<img src="${siteLogo}" width="100">`,
                },
                serverSide: true,
                ajax: {
                    url: `${siteURL}label_product/productJson`,
                    data: {

                    },
                },
                columns: [{
                        data: "id",
                        mRender: (data, type, full) => {
                            return `${full.id}`;
                        },
                    },
                    {
                        data: "dnumber",
                        mRender: (data, type, full) => {
                            return `${full.dnumber} - ${full.make}`;
                        },
                    },
                    {
                        data: "brand",
                        mRender: (data, type, full) => {
                            return `${full.brand}`;
                        },
                    },
                    {
                        data: "storage",
                        mRender: (data, type, full) => {
                            return `${full.storage}`;
                        },
                    },
                    {
                        data: "icloud",
                        mRender: (data, type, full) => {
                            return `${full.icloud}`;
                        },
                    },
                    {
                        data: null,
                        mRender: (data, type, full) => {
                            return `
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" onclick="Product.updateModal(${full.id})"><i class="fa fa-pen"></i></button>
                                    <button class="btn-sm btn btn-primary" onclick="Product.deleteProduct(${full.id})"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            `;
                        },
                    },
                ],
                dom: "Bfrtilp",
                "searching": true,
            });
        },
    }

    const Product = {
        addModal: () => {
            $.ajax({
                url: `${siteURL}label_product/add_product`,
                type: "GET",
                dataType: "HTML",
                data: {},
                success: (result) => {
                    toastr.clear()
                    $("#modal-content").html(result)
                },
                beforeSend: () => {
                    toastr.info("Information", "Please wait your request is under process");
                }
            });
        },

        updateModal: (id) => {
            $.ajax({
                url: `${siteURL}label_product/update_product`,
                type: "GET",
                dataType: "HTML",
                data: {
                    id: id
                },
                success: (result) => {
                    toastr.clear()
                    $("#modal-content").html(result)
                },
                beforeSend: () => {
                    toastr.info("Information", "Please wait your request is under process");
                }
            });
        },

        addProduct: (data) => {
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            $.ajax({
                url: `${siteURL}label_product/add_product`,
                type: "POST",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    dnumber: data.dnumber,
                    brand: data.brand,
                    make: data.make,
                    storage: data.storage,
                    model_no: data.model_no,
                    color: data.color,
                    grade: data.grade,
                    icloud: data.icloud,
                    carrier: data.carrier,
                },
                success: (result) => {
                    toastr.clear()
                    if (result.status == 200) {
                        toastr.success("Success", result.message);
                        Init.dataTables();
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

        updateProduct: (data) => {
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            $.ajax({
                url: `${siteURL}label_product/update_product`,
                type: "POST",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    id: data.id,
                    dnumber: data.dnumber,
                    brand: data.brand,
                    make: data.make,
                    storage: data.storage,
                    model_no: data.model_no,
                    color: data.color,
                    grade: data.grade,
                    icloud: data.icloud,
                    carrier: data.carrier,
                },
                success: (result) => {
                    toastr.clear()
                    if (result.status == 200) {
                        toastr.success("Success", result.message);
                        Init.dataTables();
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
        
        deleteProduct: (id) => {
            Swal.fire({
                html: `You won't be able to recover this product`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: 'Nope, cancel it',
                confirmButtonText: "Yes, delete it",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(data) {

                if (data.isConfirmed) {
                    $.ajax({
                        url: `${siteURL}label_product/delete_product`,
                        type: "get",
                        dataType: "json",
                        data: {
                            id: id,
                        },
                        success: (result) => {
                            toastr.clear()
                            if (result.status == 200) {
                                toastr.success("Success", result.message);
                                Init.dataTables();
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
                }
            });
        }
    }

    $(document).ready(() => {
        Init.dataTables();

    })
</script>
<?= $this->endSection('content') ?>