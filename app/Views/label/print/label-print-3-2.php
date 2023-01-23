<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<html>

<body>
    <style>
        table,
        th,
        td {
            /* border-collapse: collapse; */
            /* padding: 4px; */
            /*margin-left: 10px;*/
            font-size: 10.5px;
            word-wrap: break-word;
            /* white-space: pre-wrap; */
            word-break: break-word;
            text-align: center;
        }

        span {
            text-align: center;
        }

        @page {
            size: 3in 2in;
            margin: 0;
        }

        .page_break {
            page-break-before: always;
        }
    </style>
    <div>
        <?php foreach ($data['iemi'] as $iemiKey => $iemi) : ?>
            <table style="width: 100%;">
                <tr>
                    <td width="100%" class="ml-15">
                        <span style=" "><?= $product['dnumber'] ?>-<?= $product['model_no'] ?> <?= $product['make'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%" class="ml-15">
                        <span style="">Make - <?= $product['make'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%" class="ml-15">
                        <span style="">Storage GB- <?= $product['storage'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%" class="ml-15">
                        <span style="">Color - <?= $product['color'] ?>, <?= $product['grade'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%" class="ml-15">
                        <span style="">Carrier - <?= $product['carrier'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%" class="ml-15">
                        <span style="">FRP/ICloud OFF - <?= $product['icloud'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td width="100%" class="ml-15">
                        <span style="">IMEI/Serial - <?= $iemi ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <img style=" width: 206px; height: 67px; margin-left: 0%;" src="<?= $data['barcode'][$iemiKey] ?>">
                        <!-- <div style="width: 206px; height: 67px;margin-left: 15%; border:1px solid red"></div> -->
                    </td>
                </tr>

            </table>
        <?php endforeach; ?>
    </div>
</body>

</html>