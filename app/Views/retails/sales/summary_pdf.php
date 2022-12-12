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
        font-size: 14px;
    }

    br {
        content: "";
        margin: 0.5em;
        display: block;
        font-size: 5%;
    }

    th {
        text-align: left;
    }
</style>
<table style="width:100%">
    <tr style="border-bottom:10x solid black">
        <td width="30%">
            <img style="width:90%" src="<?= $logo ?>">
        </td>
        <td width="70%">
            <strong style="font-size:22px">Georgia Phone Case</strong><br>
            <span>Email: <?= $setting['email'] ?></span><br>
            <span><?= $setting['address'] ?></span><br>
            <span>Tel: <?= $setting['phone'] ?></span><br>
            <span>Fax: <?= $setting['fax'] ?></span>

        </td>
    </tr>
</table>
<table style="width:100%;">
    <tr>
        <td colspan="2" style="text-align:center">
            <p>From <?= $from_date ?> To <?= $to_date ?></p><br>
        </td>
    </tr>
</table>
<table style="width:100%">
    <thead style="background:#b2e8f2">
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
            <td style="border-top: 1px solid gray;"><?= $formatter->formatCurrency($grandTotal, 'USD') ?></td>
        </tr>
    </tbody>
    <thead style="background:#b2e8f2">
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
            <td>Deposite</td>
            <td><?= $formatter->formatCurrency($depositeTotal, 'USD') ?></td>
        </tr>
        <tr>
            <td>Zelle</td>
            <td><?= $formatter->formatCurrency($zelle, 'USD') ?></td>
        </tr>
        <tr>
            <td>Cash App</td>
            <td><?= $formatter->formatCurrency($cashApp, 'USD') ?></td>
        </tr>
        <tr>
            <td>Other</td>
            <td><?= $formatter->formatCurrency($otherTotal, 'USD') ?></td>
        </tr>
        <tr>
            <td>Total Payment</td>
            <td style="border-top: 1px solid gray;"><?= $formatter->formatCurrency($totalPayment, 'USD') ?></td>
        </tr>
    </tbody>
    <thead style="background:#b2e8f2">
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