<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<html>

<body>
    <style>
        * {
            border: none;
            box-sizing: content-box;
            /* margin: 6px; */
            /* padding: 9px; */
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
            padding: 10px;
            margin-left: 10px;
        }
    </style>

    <table style="width:100%">
        <tr>
            <td width="50%">Logo</td>
            <td width="50%">
                <strong>Georgia Phone Case</strong><br>
                <span>Email: <?= $setting['email'] ?></span><br>
                <span><?= $setting['address'] ?></span><br>
                <span>Tel: <?= $setting['phone'] ?></span><br>
                <span>Fax: <?= $setting['fax'] ?></span>

            </td>
        </tr>
    </table>



    <table style="width:100%">
        <tr>
            <td></td>
            <td>
                <!-- <img src="data:image/png;base64,<?= $logo ?>"> -->
            </td>
        </tr>
        <tr>
            <td>
                <h4>Order no: #<?= $sale['id'] ?></h4>
            </td>
            <td></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td>Name : <?= ucwords($sale['customer']) ?></td>
            <td>Date: <?= date('M d, Y', strtotime($sale['date'])) ?></td>

        </tr>
        <tr>
            <td>Phone : <?= $sale['phone'] ?></td>
            <td>Order Date: <?= date('M d, Y', strtotime($sale['date'])) ?></td>

        </tr>
        <tr>
            <td>Email : <?= strtolower($sale['email']) ?></td>
            <td>Time: <?= date('H:i:s', strtotime($sale['date'])) ?></td>


        </tr>
        <tr>
            <td>Address: <?= ucwords($sale['c_address']) ?> <br> <?= ucwords($sale['c_address2']) ?><br> <?= ucwords($sale['city']) ?> <?= ucwords($sale['state']) ?> <?= ucwords($sale['country']) ?> <?= $sale['postcode'] ?></td>
            <td>Payment Method : <?= ucwords($sale['paymentmethod']) ?></td>
        </tr>
    </table>
    <!--product details-->
    <table style="width:100%">
        <tr>
            <td>
                Note:
                <p><?= $sale['note'] ?></p>

            </td>
        </tr>
    </table>
    <!--signature-->

    <table style="width:100%">
        <tr>
            <td><strong>Sr.No</strong></td>
            <td><strong>Product</strong></td>
            <td><strong>Qty($)</strong></td>
            <td><strong>Price($)</strong></td>
            <td><strong>Tax($)</strong></td>
            <td><strong>Amount($)</strong></td>
        </tr>
        <?php foreach ($sale['line_items'] as $key => $value) : ?>
            <tr>
                <td><small><?= $value['sno'] ?></td>
                <td><small><?= ucwords($value['name']) ?></small></td>
                <td><small><?= ($value['quantity']) ?></small></td>
                <td><small> <?= $formatter->formatCurrency($value['price'], 'USD') ?></small></td>
                <td><small> <?= $formatter->formatCurrency($value['subtotal_tax'], 'USD') ?></small></td>
                <td><small> <?= $formatter->formatCurrency($value['subtotal'], 'USD') ?></small></td>
            </tr>
        <?php endforeach; ?>
        <tr style="border-top: 1px solid black;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Subtotal</td>
            <td> <?= $formatter->formatCurrency($sale['subtotal'], 'USD') ?></td>
        </tr>
        <tr style="border-top: 1px solid black;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Discount</td>
            <td> <?= $formatter->formatCurrency($sale['discount'], 'USD') ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Shipping</td>
            <td> <?= $formatter->formatCurrency($sale['shipping'], 'USD') ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Fee</td>
            <td> <?= $formatter->formatCurrency($sale['fee'], 'USD') ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Tax(6%)</td>
            <td> <?= $formatter->formatCurrency($sale['total_tax'], 'USD') ?></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th style="border-top: 1px solid black;">Grand Total</th>
            <td style="border-top: 1px solid black;"> <?= $formatter->formatCurrency(floatval($sale['gtotal']), 'USD') ?></td>
        </tr>
    </table>

    <table style="width:70%">
        <tr>
            <td>
                <h2>Terms & Conditions</h2>
                <pre style="font-size:9px"><?= $setting['terms'] ?></pre>
            </td>
        </tr>
    </table>
    <!--signature-->
</body>

</html>