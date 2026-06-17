<?= view('layouts/header') ?>

<div class="container py-4">

    <a
        href="/admin/orders"
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

                    <span class="badge bg-success">

                        <?= ucfirst(
                            $order['payment_status']
                        ) ?>

                    </span>

                </div>

                <div class="col-md-6">

                    <strong>
                        Order Status
                    </strong>

                    <br>

                    <span class="badge bg-primary">

                        <?= ucfirst(
                            str_replace(
                                '_',
                                ' ',
                                $order['order_status']
                            )
                        ) ?>

                    </span>

                </div>

            </div>

        </div>

    </div>

    <h4 class="mb-3">

        Ordered Items

    </h4>

    <?php foreach($items as $item): ?>

        <div class="card mb-3">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">

                        <?php if($item['preview_file']): ?>

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

                        <?php if($item['design_file']): ?>

                            <a
                                href="/uploads/designs/<?= $item['design_file'] ?>"
                                target="_blank"
                                class="btn btn-outline-primary btn-sm">

                                Design File

                            </a>

                        <?php endif ?>

                        <?php if($item['svg_file']): ?>

                            <a
                                href="/uploads/svg/<?= $item['svg_file'] ?>"
                                target="_blank"
                                class="btn btn-outline-secondary btn-sm">

                                SVG File

                            </a>

                        <?php endif ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach ?>

    <div class="card">

        <div class="card-body">

            <h5>

                Update Order Status

            </h5>

            <hr>

            <?php if(
                $order['payment_status'] == 'paid'
                &&
                $order['order_status'] == 'pending'
            ): ?>

                <form
                    action="/admin/orders/update-status"
                    method="post"
                    class="d-inline">

                    <input
                        type="hidden"
                        name="order_id"
                        value="<?= $order['id'] ?>">

                    <input
                        type="hidden"
                        name="status"
                        value="processing">

                    <button
                        class="btn btn-primary">

                        Start Processing

                    </button>

                </form>

                <form
                    action="/admin/orders/update-status"
                    method="post"
                    class="d-inline">

                    <input
                        type="hidden"
                        name="order_id"
                        value="<?= $order['id'] ?>">

                    <input
                        type="hidden"
                        name="status"
                        value="cancelled">

                    <button
                        class="btn btn-danger">

                        Cancel Order

                    </button>

                </form>

            <?php endif ?>

            <?php if(
                $order['order_status']
                == 'processing'
            ): ?>

                <form
                    action="/admin/orders/update-status"
                    method="post">

                    <input
                        type="hidden"
                        name="order_id"
                        value="<?= $order['id'] ?>">

                    <input
                        type="hidden"
                        name="status"
                        value="shipped">

                    <button
                        class="btn btn-info">

                        Mark As Shipped

                    </button>

                </form>

            <?php endif ?>

            <?php if(
                $order['order_status']
                == 'shipped'
            ): ?>

                <form
                    action="/admin/orders/update-status"
                    method="post">

                    <input
                        type="hidden"
                        name="order_id"
                        value="<?= $order['id'] ?>">

                    <input
                        type="hidden"
                        name="status"
                        value="completed">

                    <button
                        class="btn btn-success">

                        Complete Order

                    </button>

                </form>

            <?php endif ?>

            <?php if(
                $order['order_status']
                == 'refund_requested'
            ): ?>

                <form
                    action="/admin/orders/update-status"
                    method="post"
                    class="d-inline">

                    <input
                        type="hidden"
                        name="order_id"
                        value="<?= $order['id'] ?>">

                    <input
                        type="hidden"
                        name="status"
                        value="refunded">

                    <button
                        class="btn btn-warning">

                        Approve Refund

                    </button>

                </form>

                <form
                    action="/admin/orders/update-status"
                    method="post"
                    class="d-inline">

                    <input
                        type="hidden"
                        name="order_id"
                        value="<?= $order['id'] ?>">

                    <input
                        type="hidden"
                        name="status"
                        value="pending">

                    <button
                        class="btn btn-secondary">

                        Reject Refund

                    </button>

                </form>

            <?php endif ?>

        </div>

    </div>

</div>

<?= view('layouts/footer') ?>