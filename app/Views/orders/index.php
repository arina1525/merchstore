<?= view('layouts/header') ?>

<div class="container py-4">

    <h2 class="mb-4">
        My Orders
    </h2>

    <?php if(empty($orders)): ?>

        <div class="alert alert-info">

            You don't have any orders yet.

        </div>

    <?php else: ?>

        <?php foreach($orders as $order): ?>

            <div class="card mb-3">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-3">

                            <strong>
                                <?= $order['invoice_number'] ?>
                            </strong>

                            <br>

                            <small class="text-muted">

                                <?= date(
                                    'd M Y H:i',
                                    strtotime(
                                        $order['created_at']
                                    )
                                ) ?>

                            </small>

                        </div>

                        <div class="col-md-2">

                            Rp <?= number_format(
                                $order['total_price']
                            ) ?>

                        </div>

                        <div class="col-md-2">

                            <?php

                            $paymentClass =
                                $order['payment_status'] == 'paid'
                                ? 'success'
                                : 'warning';

                            ?>

                            <span class="badge bg-<?= $paymentClass ?>">

                                <?= ucfirst(
                                    $order['payment_status']
                                ) ?>

                            </span>

                        </div>

                        <div class="col-md-2">

                            <?php

                            switch($order['order_status']) {

                                case 'processing':
                                    $statusClass = 'primary';
                                    break;

                                case 'shipped':
                                    $statusClass = 'info';
                                    break;

                                case 'completed':
                                    $statusClass = 'success';
                                    break;

                                case 'cancelled':
                                    $statusClass = 'danger';
                                    break;

                                case 'refund_requested':
                                    $statusClass = 'warning';
                                    break;

                                case 'refunded':
                                    $statusClass = 'secondary';
                                    break;

                                default:
                                    $statusClass = 'dark';
                            }

                            ?>

                            <span class="badge bg-<?= $statusClass ?>">

                                <?= ucfirst(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $order['order_status']
                                    )
                                ) ?>

                            </span>

                        </div>

                        <div class="col-md-3 text-end">

                            <a
                                href="/orders/<?= $order['id'] ?>"
                                class="btn btn-purple">

                                View Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach ?>

    <?php endif ?>

</div>

<?= view('layouts/footer') ?>