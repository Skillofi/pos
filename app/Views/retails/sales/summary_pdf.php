<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<style>
    .container {
        width: 100%;
    }

    .wrapper {
        width: 100%;
        border: 1px solid #000;
        margin: 10px 0;

        .row {
            border-bottom: 1px solid #000;

            .border-right {
                border-right: 1px solid #000;
            }
        }

        .no-border {
            border-bottom: 0;
        }
    }

    .margin-0 {
        margin: 0;
    }

    .padding-0 {
        padding: 0;
    }

    img {
        height: 30px;
    }

    .table {
        width: 100%;
        margin: 0;

        >tbody>tr {
            >td {
                border: 1px solid #000;
                padding: 5px 0 5px 10px;
                width: 50%;
            }

            .first {
                border-top: 0;
            }

            .last {
                border-bottom: 0;
            }

            b {
                display: block;
            }

            span {
                font-size: 12px;
            }
        }
    }

    .invoice-bill {
        width: 100%;

        td {
            border: 1px solid #000;
            padding: 5px;
        }

        .serial-no {
            width: 70px;
        }

        .particulars {
            width: 500px;
        }

        .amount {
            width: 150px;
        }

        .particular-items {
            padding: 5px 10px;
        }

        .amount-items {
            padding: 5px 0;
        }
    }

    .entry-id {
        margin: 35px 0;
    }

    .bank-details {
        margin-top: 30px;
    }

    .authorised-sign-wrapper {
        width: 300px;
        border: 1px solid #000;
        padding: 5px 20px;
    }
</style>
<div class="container">
    <div class="wrapper">
        <div class="row margin-0">
            <div class="col-sm-5">
                LOGO
            </div>
        </div>
        <div class="row margin-0">
            <div class="col-sm-12 padding-0">
                <table class="invoice-bill">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-end">Sales Report</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sales</td>
                            <td><?= $formatter->formatCurrency($totalSale, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td><?= $formatter->formatCurrency($discount, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td><?= $formatter->formatCurrency($shipping, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td><?= $formatter->formatCurrency($tax, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><?= $formatter->formatCurrency($grandTotal, 'USD') ?></td>
                        </tr>
                    </tbody>
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Payment</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cash</td>
                            <td><?= $formatter->formatCurrency($cashTotal, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Gift Card</td>
                            <td><?= $formatter->formatCurrency($giftCardTotal, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Credit Card</td>
                            <td><?= $formatter->formatCurrency($creditCardTotal, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Cheque</td>
                            <td><?= $formatter->formatCurrency($chequeTotal, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Other</td>
                            <td><?= $formatter->formatCurrency($otherTotal, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Deposite</td>
                            <td><?= $formatter->formatCurrency($depositeTotal, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Total Payment</td>
                            <td><?= $formatter->formatCurrency($totalPayment, 'USD') ?></td>
                        </tr>
                        <!-- <tr>
                                        <td>Total Balance</td>
                                        <td><?= $formatter->formatCurrency(floatval($grandTotal) - floatval($totalPayment), 'USD') ?></td>
                                    </tr> -->
                    </tbody>
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Numbers</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Number of Order Total</td>
                            <td><?= $salesCount ?></td>
                        </tr>
                        <tr>
                            <td>Number of Total Item Sold</td>
                            <td><?= $salesItemCount ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<table id="datatables" class="table table-striped table-no-bordered table-hover ng-star-inserted">

</table>