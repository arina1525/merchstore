<?= view('layouts/header') ?>

<div class="container py-4">

    <h2 class="mb-4">

        Checkout

    </h2>

    <!-- ADDRESS -->

    <div class="card mb-4">

        <div class="card-body">

            <h5>

                Shipping Address

            </h5>

            <hr>

            <select
                class="form-select"
                id="addressSelect">

                <?php foreach ($addresses as $address): ?>

                    <option
                        value="<?= $address['id'] ?>"
                        <?= $address['id'] == $selectedAddress['id']
                            ? 'selected'
                            : '' ?>>

                        <?= $address['receiver_name'] ?>
                        -
                        <?= $address['city'] ?>
                        -
                        <?= $address['province'] ?>

                    </option>

                <?php endforeach ?>

            </select>

            <div class="mt-3">

                <strong>

                    <?= $selectedAddress['receiver_name'] ?>

                </strong>

                <br>

                <?= $selectedAddress['phone'] ?>

                <br>

                <?= $selectedAddress['address'] ?>

                <br>

                <?= $selectedAddress['city'] ?>

                -
                <?= $selectedAddress['province'] ?>

                -
                <?= $selectedAddress['postal_code'] ?>

            </div>

            <div class="mt-3">

                <a
                    href="/addresses"
                    class="btn btn-outline-primary">

                    Manage Addresses

                </a>

            </div>

        </div>

    </div>

    <!-- ITEMS -->

    <?php foreach ($items as $item): ?>

        <div class="card mb-3">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-2">

                        <img
                            src="/uploads/previews/<?= $item['preview_image'] ?>"
                            class="img-fluid rounded">

                    </div>

                    <div class="col-md-5">

                        <h5>

                            <?= $item['name'] ?>

                        </h5>

                        <?php foreach ($item['variants'] as $variant): ?>

                            <div>

                                <?= $variant['name'] ?>

                            </div>

                        <?php endforeach ?>

                    </div>

                    <div class="col-md-2">

                        Qty :
                        <?= $item['qty'] ?>

                    </div>

                    <div class="col-md-3 text-end">

                        Rp <?= number_format(
                                $item['total_price']
                            ) ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach ?>

    <!-- SUMMARY -->

    <div class="card">

        <div class="card-body">

            <div
                class="d-flex justify-content-between mb-2">

                <span>

                    Subtotal

                </span>

                <strong>

                    Rp <?= number_format(
                            $subtotal
                        ) ?>

                </strong>

            </div>

            <div
                class="d-flex justify-content-between mb-2">

                <span>

                    Shipping Cost

                </span>

                <strong>

                    Rp <?= number_format(
                            $shippingCost
                        ) ?>

                </strong>

            </div>

            <hr>

            <div
                class="d-flex justify-content-between">

                <h5>

                    Grand Total

                </h5>

                <h5>

                    Rp <?= number_format(
                            $grandTotal
                        ) ?>

                </h5>

            </div>

            <div class="text-end mt-4">

                <form
                    action="/checkout/process"
                    method="post">

                    <input
                        type="hidden"
                        name="address_id"
                        value="<?= $selectedAddress['id'] ?>">

                    <button
                        type="submit"
                        class="btn btn-purple btn-lg">

                        Proceed To Payment

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
<script>
    document
        .getElementById(
            'addressSelect'
        )
        .addEventListener(
            'change',
            function() {

                window.location =
                    '/checkout?address_id=' +
                    this.value;

            }
        );
</script>
<?= view('layouts/footer') ?>