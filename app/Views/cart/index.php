<?= view('layouts/header') ?>

<div class="container py-4">

    <h4>Shopping Cart</h4>

    <?php foreach ($items as $item): ?>

        <div class="cart-card">

            <div class="cart-title">

                <?= $item['name'] ?>

            </div>

            <div class="cart-content">

                <div class="cart-preview">

                    <img
                        src="/uploads/previews/<?= $item['preview_image'] ?>"
                        alt="<?= $item['name'] ?>">

                </div>

                <div class="cart-variant">

                    <strong>Variant</strong>

                    <?php foreach ($item['variants'] as $variant): ?>

                        <div>
                            <?= $variant['name'] ?>
                        </div>

                    <?php endforeach ?>

                </div>

                <div class="cart-qty">

                    <strong>Qty</strong>

                    <div>
                        <?= $item['qty'] ?>
                    </div>

                </div>

                <div class="cart-price">

                    <strong>Total</strong>

                    <div>
                        Rp <?= number_format($item['total_price']) ?>
                    </div>

                </div>

                <div class="cart-remove">

                    <a
                        href="/cart/remove/<?= $item['id'] ?>"
                        onclick="return confirm('Hapus item ini?')">

                        <i class="bi bi-trash"></i>

                    </a>

                </div>

            </div>

        </div>

    <?php endforeach ?>
    <div class="text-end mt-4">

        <a href="/checkout"
            class="btn btn-purple btn-lg">

            Checkout

        </a>

    </div>

</div>

<?= view('layouts/footer') ?>