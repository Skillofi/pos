<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<html>

<body>
    <style>
        h1 {
            font-size: 26px;
            font-weight: 600;
            justify-content: center;
            text-align: center;
            margin-bottom: 35px;


        }

        table,
        th,
        td {
            border-collapse: collapse;
            padding: 4px;
            font-size: 18px;
            text-align: center;
        }

        span {
            text-align: center;
        }

        @page {
            size: 4in 6in;
            margin: 0;
        }

        .page_break {
            page-break-before: always;
        }
    </style>
    <div>
        <?php foreach ($data['iemi'] as $iemiKey => $iemi) : ?>
            <table>

                <tr>
                    <td width="100%">
                        <h1 style="word-wrap: break-word;white-space: pre-wrap;word-break: break-word;text-decoration-line: underline; font-size: 40px;"><u><?= $product['dnumber'] ?>-<?= $product['model_no'] ?> <?= $product['make'] ?></u> </h1>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span style="">Make - <?= $product['make'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span style="">Storage GB- <?= $product['storage'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span style="">Color - <?= $product['color'] ?>, <?= $product['grade'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span style="">Carrier - <?= $product['carrier'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span style="">FRP/ICloud OFF - <?= $product['icloud'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span style="">IMEI/Serial - <?= $iemi ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <span style="font-size:14px">IMEI/Serial</span>
                    </td>
                </tr>
                <tr>
                    <td width="100%; text-align: center; margin-top:10px">
                        <img style="margin-top: 25px; width: 365px; height: 150px;" src="<?= $data['barcode'][$iemiKey] ?>">
                        <!-- <div style="margin-top: 25px; width: 365px; height: 150px; border:1px solid red"></div> -->
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>
    </div>
</body>

</html>