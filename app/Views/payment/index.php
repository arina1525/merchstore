<?= view('layouts/header') ?>

<div class="container py-5">

    <div class="card">

        <div class="card-body text-center">

            <h2>

                Payment

            </h2>

            <hr>

            <p>

                Invoice Number

            </p>

            <h4>

                <?= $order['invoice_number'] ?>

            </h4>

            <p>

                Total Payment

            </p>

            <h3>

                Rp <?= number_format(
                    $order['total_price']
                ) ?>

            </h3>

            <div class="mt-4">

                <button
                    class="btn btn-purple btn-lg">

                    Pay Now

                </button>

            </div>

        </div>

    </div>

</div>

<?= view('layouts/footer') ?>