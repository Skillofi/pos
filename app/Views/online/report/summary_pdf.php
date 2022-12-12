<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<style>
* {
    border: none;
    /*box-sizing: content-box;*/
    /* margin: 6px; */
    padding: 0px; 
    text-decoration: none;
    vertical-align: top;
}

h1 {
    font-size: 26px;
    font-weight: 600;
    justify-content: center;
    text-align: center;
    margin-bottom: 70px;
}

table,
th,
td {
    border-collapse: collapse;
    padding: 4px;
    /*margin-left: 10px;*/
    font-size:14px;
}
br{
    content: "";
    margin: 0.5em;
    display: block;
    font-size: 5%;
}
th{
    text-align:left;
}
</style>
<table style="width:100%">
    <tr style="border-bottom:10x solid black">
        <td width="30%">
            <img style="width:90%" src="<?=$data['logo']?>">
        </td>
        <td width="70%">
            <strong style="font-size:22px">Georgia Phone Case</strong><br>
            <span>Email: <?= $data['setting']['email'] ?></span><br>
            <span><?= $data['setting']['address'] ?></span><br>
            <span>Tel: <?= $data['setting']['phone'] ?></span><br>
            <span>Fax: <?= $data['setting']['fax'] ?></span>

        </td>
    </tr>
</table>
<table style="width:100%;">
    <tr>
        <td colspan="2" style="text-align:center">
            <p>From <?=date('M d, Y', strtotime($data['fromDate']))?> To <?=date('M d, Y', strtotime($data['endDate']))?></p><br>
        </td>
    </tr>
</table>
<table style="width:100%">
    <thead  style="background:#b2e8f2">
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
            <td style="border-top: 1px solid gray;"><?= $formatter->formatCurrency(($data['order_total']) ? $data['order_total'] : 0, 'USD') ?></td>
        </tr>
    </tbody>
    <thead  style="background:#b2e8f2">
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
            <td>POS Cash</td>
            <td><?= $formatter->formatCurrency(($data['pos_cash']) ? $data['pos_cash'] : 0, 'USD') ?></td>
        </tr>
        <tr>
            <td>Paypal</td>
            <td><?= $formatter->formatCurrency(($data['paypal']) ? $data['paypal'] : 0, 'USD') ?></td>
        </tr>
        <tr>
            <td>Website Credit Card</td>
            <td><?= $formatter->formatCurrency(($data['creditcard']) ? $data['creditcard'] : 0, 'USD') ?></td>
        </tr>
        <tr>
            <td>Cash App</td>
            <td><?= $formatter->formatCurrency(($data['cash_app']) ? $data['cash_app'] : 0, 'USD') ?></td>
        </tr>
        <tr>
            <td>Zelle</td>
            <td><?= $formatter->formatCurrency(($data['zelle']) ? $data['zelle'] : 0, 'USD') ?></td>
        </tr>
        <tr>
            <td>Others</td>
            <td><?= $formatter->formatCurrency(($data['others']) ? $data['others'] : 0, 'USD') ?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td style="border-top: 1px solid gray;"><?= $formatter->formatCurrency(($data['order_total']) ? $data['order_total'] : 0, 'USD') ?></td>
        </tr>
    </tbody>
    <thead  style="background:#b2e8f2">
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