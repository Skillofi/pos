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
                <p><img style="padding-left: 50%;" src="<?= FCPATH ?>public\uploads\<?= $data['system_setting']['logo'] ?>"></p>
            </div>
        </div>
        <div class="row margin-0">
            <div class="col-sm-12 padding-0">
                <table class="invoice-bill">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Sales Report</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sales</td>
                            <td><?= $formatter->formatCurrency(($data['total_sale']) ? $data['total_sale'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td><?= $formatter->formatCurrency(($data['total_discount']) ? $data['total_discount'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Refund</td>
                            <td><?= $formatter->formatCurrency(($data['total_refund']) ? $data['total_refund'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td><?= $formatter->formatCurrency(($data['total_shipping']) ? $data['total_shipping'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td><?= $formatter->formatCurrency(($data['total_tax']) ? $data['total_tax'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Fee</td>
                            <td><?= $formatter->formatCurrency(($data['total_fee']) ? $data['total_fee'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><?= $formatter->formatCurrency(($data['order_total']) ? $data['order_total'] : 0, 'USD') ?></td>
                        </tr>
                    </tbody>
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Payment Gateway</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>POS Card</td>
                            <td><?= $formatter->formatCurrency(($data['pos_card']) ? $data['pos_card'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>POS Checks</td>
                            <td><?= $formatter->formatCurrency(($data['pos_check']) ? $data['pos_check'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>POS CASH</td>
                            <td><?= $formatter->formatCurrency(($data['pos_cash']) ? $data['pos_cash'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>PAYPAL</td>
                            <td><?= $formatter->formatCurrency(($data['paypal']) ? $data['paypal'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>WEBSITE CREDITCARD</td>
                            <td><?= $formatter->formatCurrency(($data['creditcard']) ? $data['creditcard'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>CASH APP</td>
                            <td><?= $formatter->formatCurrency(($data['cash_app']) ? $data['cash_app'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>ZELLE</td>
                            <td><?= $formatter->formatCurrency(($data['zelle']) ? $data['zelle'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>OTHERS</td>
                            <td><?= $formatter->formatCurrency(($data['others']) ? $data['others'] : 0, 'USD') ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><?= $formatter->formatCurrency(($data['order_total']) ? $data['order_total'] : 0, 'USD') ?></td>
                        </tr>
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
                            <td><?= ($data['orders_count']) ? $data['orders_count'] : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Number of Total Item Sold</td>
                            <td><?= ($data['items_count']) ? $data['items_count'] : 0 ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<table id="datatables" class="table table-striped table-no-bordered table-hover ng-star-inserted">

</table>