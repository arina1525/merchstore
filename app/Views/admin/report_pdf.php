<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <style>

        body{
            font-family: Arial, sans-serif;
            font-size:12px;
        }

        .title{
            text-align:center;
            margin-bottom:30px;
        }

        .summary{
            margin-bottom:30px;
        }

        .summary-box{
            border:1px solid #ddd;
            padding:10px;
            margin-bottom:10px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid #ddd;
            padding:8px;
        }

        table th{
            background:#f2f2f2;
        }

    </style>

</head>

<body>

    <div class="title">

        <h1>

            MERCHSTORE SALES REPORT

        </h1>

        <p>

            Generated :
            <?= date('d F Y H:i') ?>

        </p>

    </div>

    <div class="summary">

        <div class="summary-box">

            <strong>

                Total Revenue

            </strong>

            <br>

            Rp <?= number_format($revenue) ?>

        </div>

        <div class="summary-box">

            <strong>

                Total Orders

            </strong>

            <br>

            <?= $totalOrders ?>

        </div>

        <div class="summary-box">

            <strong>

                Total Customers

            </strong>

            <br>

            <?= $totalUsers ?>

        </div>

        <div class="summary-box">

            <strong>

                Top Selling Product

            </strong>

            <br>

            <?= $topProduct ?>

            (<?= $topProductSold ?> sold)

        </div>

    </div>

    <h2>

        Order List

    </h2>

    <table>

        <thead>

            <tr>

                <th>

                    Invoice

                </th>

                <th>

                    Total

                </th>

                <th>

                    Payment

                </th>

                <th>

                    Order Status

                </th>

            </tr>

        </thead>

        <tbody>

            <?php foreach($orders as $order): ?>

                <tr>

                    <td>

                        <?= $order['invoice_number'] ?>

                    </td>

                    <td>

                        Rp <?= number_format(
                            $order['total_price']
                        ) ?>

                    </td>

                    <td>

                        <?= ucfirst(
                            $order['payment_status']
                        ) ?>

                    </td>

                    <td>

                        <?= ucfirst(
                            str_replace(
                                '_',
                                ' ',
                                $order['order_status']
                            )
                        ) ?>

                    </td>

                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</body>

</html>