<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>

        Order Management

    </h2>
    <?php
    renderOrderSection(
        'Pending Orders',
        $pendingOrders
    );

    renderOrderSection(
        'Processing Orders',
        $processingOrders
    );

    renderOrderSection(
        'Shipped Orders',
        $shippedOrders
    );

    renderOrderSection(
        'Completed Orders',
        $completedOrders
    );

    renderOrderSection(
        'Refund Requests',
        $refundOrders
    );

    renderOrderSection(
        'Refunded Orders',
        $refundedOrders
    );

    renderOrderSection(
        'Cancelled Orders',
        $cancelledOrders
    );
    ?>

    <?php

    function renderOrderSection(
        $title,
        $orders
    ) {
    ?>

        <h4 class="mt-5">

            <?= $title ?>
            (<?= count($orders) ?>)

        </h4>

        <?php if (empty($orders)): ?>

            <div class="alert alert-light">

                No Orders

            </div>

        <?php else: ?>

            <?php foreach ($orders as $order): ?>

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="row align-items-center">

                            <div class="col-md-3">
                                <?= $order['invoice_number'] ?>
                            </div>

                            <div class="col-md-3">
                                Rp <?= number_format($order['total_price']) ?>
                            </div>

                            <div class="col-md-2">
                                <?= ucfirst($order['payment_status']) ?>
                            </div>

                            <div class="col-md-2">
                                <?= ucfirst(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $order['order_status']
                                    )
                                ) ?>
                            </div>

                            <div class="col-md-2 text-end">

                                <a
                                    href="/admin/orders/<?= $order['id'] ?>"
                                    class="btn btn-primary">

                                    Detail

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach ?>

        <?php endif ?>

    <?php
    }
    ?>

</div>

<?= view('layouts/footer') ?>