<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #section-to-print,
        #section-to-print * {
            visibility: visible;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Transaction Summary</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('dashboard') ?>" class="text-muted text-hover-primary">POS Summary Compare</a>
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
                <!--begin::Card header-->
                <div class="">
                    <form class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid gap-5">
                            <!--begin::Flatpickr-->
                            <div class="input-group w-500px">
                                <input class="form-control form-control-solid rounded rounded-end-0" placeholder="Pick date 1" id="date1" name="date1" value="" />
                            </div>
                            <div class="input-group w-500px">
                                <input class="form-control form-control-solid rounded rounded-end-0" placeholder="Pick date 2" id="date2" name="date2" value="" />
                            </div>
                            <!--end::Flatpickr-->
                        </div>
                        <!--end::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid gap-5 justify-content-end">
                            <!--begin::Flatpickr-->
                            <button type="button" onclick="AjaxCall.search()" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <!--end::Flatpickr-->
                        </div>
                    </form>
                </div>
                <!--end::Card header-->
                <!--begin::Body-->
                <div class="card-body p-5 px-lg-19 py-lg-16" id="section-to-print">
                    <div class="row">
                        <center>
                            <h3>POS Summary</h3>
                        </center>
                        <div class="table-response">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover ng-star-inserted">
                                <thead class="bg-primary text-white">
                                    <tr class="bg-success">
                                        <th></th>
                                        <th class="date1">Select Date</th>
                                        <th class="date2">Select Date</th>
                                    </tr>
                                    <tr>
                                        <th>Sales Report</th>
                                        <th>Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sales</td>
                                        <td class="total_sale1">$0.00</td>
                                        <td class="total_sale2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td class="total_discount1">$0.00</td>
                                        <td class="total_discount2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Refund</td>
                                        <td class="total_refund1">$0.00</td>
                                        <td class="total_refund2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="total_shipping1">$0.00</td>
                                        <td class="total_shipping2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td class="total_tax1">$0.00</td>
                                        <td class="total_tax2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Fee</td>
                                        <td class="total_fee1">$0.00</td>
                                        <td class="total_fee2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td class="order_total1">$0.00</td>
                                        <td class="order_total2">$0.00</td>
                                    </tr>
                                </tbody>
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Payment Gateway</th>
                                        <th>Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>POS Card</td>
                                        <td class="pos_card1">$0.00</td>
                                        <td class="pos_card2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>POS Checks</td>
                                        <td class="pos_check1">$0.00</td>
                                        <td class="pos_check2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>POS CASH</td>
                                        <td class="pos_cash1">$0.00</td>
                                        <td class="pos_cash2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>PAYPAL</td>
                                        <td class="paypal1">$0.00</td>
                                        <td class="paypal2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>WEBSITE CREDITCARD</td>
                                        <td class="creditcard1">$0.00</td>
                                        <td class="creditcard2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>CASH APP</td>
                                        <td class="cash_app1">$0.00</td>
                                        <td class="cash_app2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>ZELLE</td>
                                        <td class="zelle1">$0.00</td>
                                        <td class="zelle2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>OTHERS</td>
                                        <td class="others1">$0.00</td>
                                        <td class="others2">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td class="order_total1">$0.00</td>
                                        <td class="order_total2">$0.00</td>
                                    </tr>
                                </tbody>
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Numbers</th>
                                        <th>Count</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Number of Order Total</td>
                                        <td class="orders_count1">0</td>
                                        <td class="orders_count2">0</td>
                                    </tr>
                                    <tr>
                                        <td>Number of Total Item Sold</td>
                                        <td class="items_count1">0</td>
                                        <td class="items_count2">0</td>
                                    </tr>
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
<script>
    const Init = {
        datePicker: () => {
            const element1 = document.querySelector('#date1');
            flatpickr = $(element1).flatpickr({
                altInput: true,
                altFormat: "m/d/Y",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    // handleFlatpickr(selectedDates, dateStr, instance);
                    Init.datePickerHandler(selectedDates, dateStr, instance)
                },
            });

            const element2 = document.querySelector('#date2');
            flatpickr = $(element2).flatpickr({
                altInput: true,
                altFormat: "m/d/Y",
                dateFormat: "Y-m-d",
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
    const AjaxCall = {
        search: () => {
            let date1 = $("#date1").val();
            let date2 = $("#date2").val();

            if (date1 != "" && date2 != "") {
                $.ajax({
                    url: `${siteURL}online_report/summary_json`,
                    type: "GET",
                    dataType: "json",
                    data: {
                        date1: date1,
                        date2: date2,
                    },
                    success: (result) => {
                        toastr.clear()
                        if (result.status == 200) {
                            toastr.clear();
                            $('.items_count1').html(result.date1.items_count);
                            $('.orders_count1').html(result.date1.orders_count);
                            $('.creditcard1').html(Init.formateAmount(result.date1.creditcard));
                            $('.order_total1').html(Init.formateAmount(result.date1.order_total));
                            $('.others1').html(Init.formateAmount(result.date1.others));
                            $('.paypal1').html(Init.formateAmount(result.date1.paypal));
                            $('.pos_card1').html(Init.formateAmount(result.date1.pos_card));
                            $('.pos_cash1').html(Init.formateAmount(result.date1.pos_cash));
                            $('.pos_check1').html(Init.formateAmount(result.date1.pos_check));
                            $('.total_discount1').html(Init.formateAmount(result.date1.total_discount));
                            $('.total_fee1').html(Init.formateAmount(result.date1.total_fee));
                            $('.total_refund1').html(Init.formateAmount(result.date1.total_refund));
                            $('.total_sale1').html(Init.formateAmount(result.date1.total_sale));
                            $('.total_shipping1').html(Init.formateAmount(result.date1.total_shipping));
                            $('.total_tax1').html(Init.formateAmount(result.date1.total_tax));
                            $('.cash_app1').html(Init.formateAmount(result.date1.cash_app));
                            $('.zelle1').html(Init.formateAmount(result.date1.zelle));
                            $('.date1').html(result.date1.date);

                            $('.items_count2').html(result.date2.items_count);
                            $('.orders_count2').html(result.date2.orders_count);
                            $('.creditcard2').html(Init.formateAmount(result.date2.creditcard));
                            $('.order_total2').html(Init.formateAmount(result.date2.order_total));
                            $('.others2').html(Init.formateAmount(result.date2.others));
                            $('.paypal2').html(Init.formateAmount(result.date2.paypal));
                            $('.pos_card2').html(Init.formateAmount(result.date2.pos_card));
                            $('.pos_cash2').html(Init.formateAmount(result.date2.pos_cash));
                            $('.pos_check2').html(Init.formateAmount(result.date2.pos_check));
                            $('.total_discount2').html(Init.formateAmount(result.date2.total_discount));
                            $('.total_fee2').html(Init.formateAmount(result.date2.total_fee));
                            $('.total_refund2').html(Init.formateAmount(result.date2.total_refund));
                            $('.total_sale2').html(Init.formateAmount(result.date2.total_sale));
                            $('.total_shipping2').html(Init.formateAmount(result.date2.total_shipping));
                            $('.total_tax2').html(Init.formateAmount(result.date2.total_tax));
                            $('.cash_app2').html(Init.formateAmount(result.date1.cash_app));
                            $('.zelle2').html(Init.formateAmount(result.date1.zelle));
                            $('.date2').html(result.date2.date);
                        } else {
                            toastr.error("Error", result.message);
                        }
                    },
                    beforeSend: () => {
                        toastr.info("Information", "Please wait your request is under process");
                    },
                    onError: () => {
                        toastr.error("Error", "Something went wrong");

                    }
                });
            } else {
                toastr.error("Error", "Select dates to compare");
            }
        }
    }

    $(document).ready(() => {
        Init.datePicker()
    })
</script>

<?= $this->endSection('content') ?>