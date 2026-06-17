<?= view('layouts/header') ?>

<div class="container py-4">

    <a
        href="/admin/users"
        class="btn btn-outline-secondary mb-3">

        Back

    </a>

    <h2>

        Customer Detail

    </h2>

    <div class="card mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <strong>

                        Name

                    </strong>

                    <br>

                    <?= $user['name'] ?>

                </div>

                <div class="col-md-6">

                    <strong>

                        Email

                    </strong>

                    <br>

                    <?= $user['email'] ?>

                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-6">

                    <strong>

                        Phone

                    </strong>

                    <br>

                    <?= $user['phone'] ?: '-' ?>

                </div>

                <div class="col-md-6">

                    <strong>

                        Joined

                    </strong>

                    <br>

                    <?= date(
                        'd M Y',
                        strtotime(
                            $user['created_at']
                        )
                    ) ?>

                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-6">

                    <strong>

                        Total Orders

                    </strong>

                    <br>

                    <?= count($orders) ?>

                </div>

                <div class="col-md-6">

                    <strong>

                        Total Spending

                    </strong>

                    <br>

                    Rp <?= number_format(
                        $totalSpent
                    ) ?>

                </div>

            </div>

        </div>

    </div>

    <div class="card mb-4">

        <div class="card-header">

            Shipping Addresses

        </div>

        <div class="card-body">

            <?php if(empty($addresses)): ?>

                <div class="text-muted">

                    No address found

                </div>

            <?php else: ?>

                <?php foreach($addresses as $address): ?>

                    <div class="border rounded p-3 mb-3">

                        <strong>

                            <?= $address['receiver_name'] ?>

                        </strong>

                        <br>

                        <?= $address['phone'] ?>

                        <br>

                        <?= $address['address'] ?>

                        <br>

                        <?= $address['city'] ?>,
                        <?= $address['province'] ?>

                        <br>

                        <?= $address['postal_code'] ?>

                        <?php if($address['is_default']): ?>

                            <div class="mt-2">

                                <span class="badge bg-success">

                                    Default Address

                                </span>

                            </div>

                        <?php endif ?>

                    </div>

                <?php endforeach ?>

            <?php endif ?>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            Order History

        </div>

        <div class="card-body">

            <?php if(empty($orders)): ?>

                <div class="text-muted">

                    No orders found

                </div>

            <?php else: ?>

                <table class="table">

                    <thead>

                        <tr>

                            <th>Invoice</th>

                            <th>Total</th>

                            <th>Payment</th>

                            <th>Status</th>

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

            <?php endif ?>

        </div>

    </div>

</div>

<?= view('layouts/footer') ?>