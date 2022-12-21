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
        <tr style="border-bottom:10x solid black">
            <td width="30%">
                <img style="width:90%" src="<?=base_url('public/uploads/'. $systemSetting['logo'])  ?>">
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
            <td>
                <h4>Order no: #RF-<?= $sale['reference_no'] ?></h4>
            </td>
            <td>
                <h4>Date: <?= date('M d, Y', strtotime($sale['date_time'])) ?></h4>
            </td>

        </tr>
        <tr>
            <td>Buyer: </td>
            <td>Seller: </td>

        </tr>
        <tr>
            <td>Name : <?= ucwords($sale['name']) ?></td>
            <td>name: Cellphone World USA</td>

        </tr>
        <tr>
            <td>Phone : <?= ucwords($sale['phone']) ?></td>
            <td>Phone : <?= ucwords($setting['phone']) ?></td>

        </tr>
        <tr>
            <td>Email : <?= strtolower($sale['email']) ?></td>
            <td>Email : <?= strtolower($setting['email']) ?></td>

        </tr>
        <tr>
            <td>Address: <?= ucwords($sale['address']) ?> <br> <?= ucwords($sale['city']) ?> <?= ucwords($sale['state']) ?> <?= ucwords($sale['country']) ?></td>
            <td>Address: <?= ucwords($setting['address']) ?></td>

        </tr>
    </table>
    <!--product details-->


    <table style="width:100%">
        <tr>
            <td><strong>Sr.No</strong></td>
            <td><strong>Product</strong></td>
            <td><strong>Qty($)</strong></td>
            <td><strong>Price($)</strong></td>
            <td><strong>Amount($)</strong></td>
        </tr>
        <?php $grandTotal = 0; ?>
        <?php foreach ($salesDetails as $key => $value) : ?>
            <?php $productTotal = (floatval($value['price']) * floatval($value['qty'])); ?>
            <?php $grandTotal += $productTotal; ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= ucwords($value['name']) ?></td>
                <td><?= ($value['qty']) ?></td>
                <td> <?= $formatter->formatCurrency($value['price'], 'USD') ?></td>
                <td> <?= $formatter->formatCurrency($productTotal, 'USD') ?></td>

            </tr>
        <?php endforeach; ?>
        <tr style="border-top: 1px solid black;">
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td> <?= $formatter->formatCurrency(floatval($grandTotal), 'USD') ?></td>
        </tr>
        <?php $grandTotal -= floatval($sale['discount']); ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Discount</td>
            <td> <?= $formatter->formatCurrency(floatval($sale['discount']), 'USD') ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Tax(<?= $sale['tax'] ?>%)</td>
            <?php $taxCalc = (floatval($grandTotal) * floatval($sale['tax'])) / 100 ?>
            <td> <?= $formatter->formatCurrency($taxCalc, 'USD') ?></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th style="border-top: 1px solid black;">Grand Total</th>
            <td style="border-top: 1px solid black;"> <?= $formatter->formatCurrency(floatval($sale['grand_total']), 'USD') ?></td>
        </tr>
    </table>


    <!--Order Note-->
    <table style="width:100%">
        <tr>
            <td style="width:50%">
                <h3>Order Note:</h3>
                <p><?= $sale['sale_note'] ?></p>


            </td>

            <td style="width:50%">
                <h3>Seller Note:</h3>
                <p><?= $sale['staff_note'] ?></p>
            </td>

        </tr>

    </table>


    <!--terms-->


    <table style="width:100%">
        <tr>
            <td>
                <h2>Terms & Conditions</h2>
                <p><?= $setting['terms'] ?></p>
            </td>


        </tr>

    </table>
    <!--signature-->
    <table style="width:100%">
        <tr>
            <td style="text-align:center">
                <h4>Buyer Name</h4>
                <h4><?= ucwords($sale['name']) ?></h4>
            </td>
            <td style="text-align:center">
                <h4>Seller Name</h4>
                <h4>Georgia Phone Case</h4>
            </td>
        </tr>

        <tr>
            <td style="text-align:center"><br><br><br><span>Signature</span></td>
            <td style="text-align:center"><br><br><br><span>Signature</span></td>
        </tr>

    </table>
</body>

</html>