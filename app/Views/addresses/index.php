<?= view('layouts/header') ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>My Addresses</h2>

        <a
            href="/addresses/create"
            class="btn btn-purple">

            Add Address

        </a>

    </div>

    <?php foreach($addresses as $address): ?>

        <div class="card mb-3">

            <div class="card-body">

                <h5>

                    <?= $address['receiver_name'] ?>

                    <?php if($address['is_default']): ?>

                        <span class="badge bg-success">

                            Default

                        </span>

                    <?php endif ?>

                </h5>

                <p>

                    <?= $address['phone'] ?>
                    <br>

                    <?= $address['address'] ?>
                    <br>

                    <?= $address['city'] ?>,
                    <?= $address['province'] ?>

                    <?= $address['postal_code'] ?>

                </p>

                <?php if(!$address['is_default']): ?>

                    <a
                        href="/addresses/default/<?= $address['id'] ?>"
                        class="btn btn-outline-primary btn-sm">

                        Set Default

                    </a>

                <?php endif ?>

                <a
                    href="/addresses/delete/<?= $address['id'] ?>"
                    class="btn btn-outline-danger btn-sm">

                    Delete

                </a>

            </div>

        </div>

    <?php endforeach ?>

</div>

<?= view('layouts/footer') ?>