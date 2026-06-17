<?= view('layouts/header') ?>

<div class="container py-4">

    <a
        href="/orders"
        class="btn btn-outline-secondary mb-3">

        Back

    </a>

    <h2>

        Order Detail

    </h2>

    <div class="card mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <strong>
                        Invoice
                    </strong>

                    <br>

                    <?= $order['invoice_number'] ?>

                </div>

                <div class="col-md-6">

                    <strong>
                        Total
                    </strong>

                    <br>

                    Rp <?= number_format(
                            $order['total_price']
                        ) ?>

                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-6">

                    <strong>
                        Payment Status
                    </strong>

                    <br>

                    <?= ucfirst(
                        $order['payment_status']
                    ) ?>

                </div>

                <div class="col-md-6">

                    <strong>
                        Order Status
                    </strong>

                    <br>

                    <?= ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            $order['order_status']
                        )
                    ) ?>

                </div>

            </div>

        </div>

    </div>

    <h4 class="mb-3">

        Ordered Items

    </h4>

    <?php foreach ($items as $item): ?>

        <div class="card mb-3">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">

                        <?php if ($item['preview_file']): ?>

                            <img
                                src="/uploads/previews/<?= $item['preview_file'] ?>"
                                class="img-fluid border">

                        <?php endif ?>

                    </div>

                    <div class="col-md-9">

                        <h5>

                            <?= $item['name'] ?>

                        </h5>

                        <p>

                            Qty :
                            <?= $item['quantity'] ?>

                        </p>

                        <p>

                            Price :
                            Rp <?= number_format(
                                    $item['price']
                                ) ?>

                        </p>

                        <p>

                            Subtotal :
                            Rp <?= number_format(
                                    $item['subtotal']
                                ) ?>

                        </p>

                        <?php if ($item['design_file']): ?>

                            <a
                                href="/uploads/designs/<?= $item['design_file'] ?>"
                                target="_blank"
                                class="btn btn-outline-primary btn-sm">

                                Design File

                            </a>

                        <?php endif ?>

                        <?php if ($item['svg_file']): ?>

                            <a
                                href="/uploads/svg/<?= $item['svg_file'] ?>"
                                target="_blank"
                                class="btn btn-outline-secondary btn-sm">

                                SVG Cutline

                            </a>

                        <?php endif ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach ?>

    <?php if (
        $order['payment_status'] == 'paid'
        &&
        $order['order_status'] == 'pending'
    ): ?>

        <a
            href="/orders/request-refund/<?= $order['id'] ?>"
            class="btn btn-danger"
            onclick="return confirm('Request refund for this order?')">

            Request Refund

        </a>

    <?php endif ?>

</div>

<?= view('layouts/footer') ?>