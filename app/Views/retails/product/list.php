<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<style>
    td img {
        width: 6em;
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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product List</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('product') ?>" class="text-muted text-hover-primary">Product List</a>
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
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="col-md-12">
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
                                        <th>Name</th>
                                        <th>Product Code</th>
                                        <th>Price</th>
                                        <th>Stock </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!---->
                                </tbody>
                            </table>
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
                    url: `${siteURL}product/productJson`,
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
                        data: "code",
                        mRender: (data, type, full) => {
                            return `${full.code}`;
                        },
                    },
                    {
                        data: "name",
                        mRender: (data, type, full) => {
                            return `${full.name}`;
                        },
                    },
                    {
                        data: "price",
                        mRender: (data, type, full) => {
                            return `${full.price}`;
                        },
                    },
                    {
                        data: "stock",
                        mRender: (data, type, full) => {
                            return `${full.stock}`;
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
                dom: "Blrtip",
                "searching": true,
            });
        },
    }

    const Product = {
        addModal: () => {
            $.ajax({
                url: `${siteURL}product/add_product`,
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
                url: `${siteURL}product/update_product`,
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
                url: `${siteURL}product/add_product`,
                type: "POST",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    name: data.name,
                    code: data.code,
                    price: data.price,
                    stock: data.stock,
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
                url: `${siteURL}product/update_product`,
                type: "POST",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    id: data.id,
                    name: data.name,
                    code: data.code,
                    price: data.price,
                    stock: data.stock,
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
                        url: `${siteURL}product/delete_product`,
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