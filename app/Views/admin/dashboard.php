<?= view('layouts/header') ?>

<div class="container py-4">

    <div class="row g-4 mb-5">
        <div class="mb-4">

            <a
                href="/admin/export-pdf"
                class="btn btn-danger">

                Export PDF

            </a>

            <a
                href="/admin/export-csv"
                class="btn btn-success">

                Export CSV

            </a>

        </div>

        <div class="col-md-3">

            <div class="card text-center">

                <div class="card-body">

                    <h6>

                        Total Products

                    </h6>

                    <h2>

                        <?= $totalProducts ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card text-center">

                <div class="card-body">

                    <h6>

                        Total Customers

                    </h6>

                    <h2>

                        <?= $totalUsers ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card text-center">

                <div class="card-body">

                    <h6>

                        Total Orders

                    </h6>

                    <h2>

                        <?= $totalOrders ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card text-center">

                <div class="card-body">

                    <h6>

                        Revenue

                    </h6>

                    <h2>

                        Rp <?= number_format(
                                $revenue
                            ) ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>
    <div class="row g-4 mb-5">

        <div class="col-md-4">

            <div class="card text-center">

                <div class="card-body">

                    <h6>

                        Pending Orders

                    </h6>

                    <h2>

                        <?= $pendingOrders ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card text-center">

                <div class="card-body">

                    <h6>

                        Processing Orders

                    </h6>

                    <h2>

                        <?= $processingOrders ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card text-center">

                <div class="card-body">

                    <h6>

                        Refund Requests

                    </h6>

                    <h2>

                        <?= $refundRequests ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>
    <div class="card mb-5">

        <div class="card-body">

            <h4>

                Sales Trend

            </h4>

            <canvas
                id="salesChart">

            </canvas>

        </div>

    </div>
    <div class="card mb-5">

        <div class="card-body">

            <h4>

                Top Selling Products

            </h4>

            <table class="table">

                <thead>

                    <tr>

                        <th>

                            Product

                        </th>

                        <th>

                            Sold

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($topProducts as $product): ?>

                        <tr>

                            <td>

                                <?= $product['name'] ?>

                            </td>

                            <td>

                                <?= $product['sold'] ?>

                            </td>

                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>

        </div>

    </div>

    <h4>Recent Orders</h4>

    <div class="table-card">

        <div class="card-body">
            <div class="table-responsive">

                <table class="table custom-table mb-0">

                    <thead>

                        <tr>

                            <th>Invoice</th>

                            <th>Total</th>

                            <th>Payment</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($recentOrders as $order): ?>

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
            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesData =
        <?= json_encode(
            $salesChart
        ) ?>;

    new Chart(

        document.getElementById(
            'salesChart'
        ),

        {

            type: 'line',

            data: {

                labels: salesData.map(
                    item =>
                    item.sales_date
                ),

                datasets: [{

                    label: 'Orders',

                    data: salesData.map(
                        item =>
                        item.total
                    )

                }]
            }

        }

    );
</script>
<?= view('layouts/footer') ?>