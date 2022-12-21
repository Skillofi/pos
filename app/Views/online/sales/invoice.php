<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<html>

<body>
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



    <table style="width:100%">
        <tr>
            <td><strong>Order no:</strong></td>
            <td>#<?= $sale['id'] ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td>Name :</td>
            <td><?= ucwords($sale['customer']) ?></td>
            <td>Date: </td>
            <td><?= date('d-M-Y', strtotime($sale['date'])) ?></td>

        </tr>
        <tr>
            <td>Phone :</td>
            <td><?= $sale['phone'] ?></td>
            <td>Order Date:</td>
            <td><?= date('d-M-Y', strtotime($sale['date'])) ?></td>

        </tr>
        <tr>
            <td>Email :</td>
            <td><?= strtolower($sale['email']) ?></td>
            <td>Time:</td>
            <td><?= date('H:i:s', strtotime($sale['date'])) ?></td>


        </tr>
        <tr>
            <td>Address:</td>
            <td><?= ucwords($sale['c_address']) ?> <br> <?= ucwords($sale['c_address2']) ?><br> <?= ucwords($sale['city']) ?> <?= ucwords($sale['state']) ?> <?= ucwords($sale['country']) ?> <?= $sale['postcode'] ?></td>
            <td>Payment Method :</td>
            <td><?= ucwords($sale['paymentmethod']) ?></td>
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
        <tr style="border-bottom: 2px solid black;">
            <td><strong>Sr.No</strong></td>
            <td><strong>Product</strong></td>
            <td><strong>Qty</strong></td>
            <td><strong>Price($)</strong></td>
            <td><strong>Tax($)</strong></td>
            <td><strong>Amount($)</strong></td>
        </tr>
        <?php foreach ($sale['line_items'] as $key => $value) : ?>
            <tr style="border-top: 1px solid gray;">
                <td><small><?= $value['sno'] ?></td>
                <td><small><?= ucwords($value['name']) ?></small></td>
                <td><small><?= ($value['quantity']) ?></small></td>
                <td><small> <?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($value['price']))), 'USD') ?></small></td>
                <td><small> <?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($value['subtotal_tax']))), 'USD') ?></small></td>
                <td><small> <?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($value['subtotal']))), 'USD') ?></small></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th colspan="2" style="border-top: 1px solid black; text-align:left;">Subtotal</th>
            <td style="border-top: 1px solid black;"><?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($sale['subtotal']))), 'USD') ?></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th colspan="2" style="border-top: 1px solid black;text-align:left;">Shipping</th>
            <td style="border-top: 1px solid black;"><?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($sale['shipping']))), 'USD') ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th colspan="2" style="border-top: 1px solid black;text-align:left;">Fee</th>
            <td style="border-top: 1px solid black;"><?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($sale['fee']))), 'USD') ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th colspan="2" style="border-top: 1px solid black;text-align:left;">Tax(6%)</th>
            <td style="border-top: 1px solid black;"><?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($sale['total_tax']))), 'USD') ?></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th colspan="2" style="border-top: 1px solid black;text-align:left;">Grand Total</th>
            <td style="border-top: 1px solid black;"><?= $formatter->formatCurrency(floatval(preg_replace("/[^-0-9\.]/", "", ($sale['gtotal']))), 'USD') ?></td>
        </tr>
    </table>

    <table style="width:100%">
        <tr>
            <td>
                <h2>Terms & Conditions</h2>
                <?= $setting['terms'] ?>
            </td>
        </tr>
    </table>
    <!--signature-->
</body>

</html>