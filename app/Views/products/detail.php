<?= view('layouts/header') ?>

<div class="container py-4">

    <a
        href="/products"
        class="btn btn-outline-secondary mb-4">

        <i class="bi bi-arrow-left"></i>
        Back

    </a>

    <div class="row g-4">

        <!-- Gallery -->

        <div class="col-lg-6">

            <div
                id="productCarousel"
                class="carousel slide">

                <div class="carousel-inner">

                    <?php
                    $first = true;
                    foreach($images as $image):
                    ?>

                        <div
                            class="carousel-item <?= $first ? 'active' : '' ?>">

                            <img
                                src="<?= base_url(
                                    'uploads/products/' .
                                    $image['image']
                                ) ?>"
                                class="d-block w-100 product-detail-image">

                        </div>

                    <?php
                    $first = false;
                    endforeach;
                    ?>

                </div>

                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#productCarousel"
                    data-bs-slide="prev">

                    <span
                        class="carousel-control-prev-icon">
                    </span>

                </button>

                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#productCarousel"
                    data-bs-slide="next">

                    <span
                        class="carousel-control-next-icon">
                    </span>

                </button>

            </div>

        </div>

        <!-- Info -->

        <div class="col-lg-6">

            <h2>
                <?= $product['name'] ?>
            </h2>

            <h4 class="price-purple">

                Rp <?= number_format(
                    $product['price']
                ) ?>

            </h4>

            <hr>

            <h5>
                Deskripsi Produk
            </h5>

            <p>
                <?= nl2br(
                    $product['description']
                ) ?>
            </p>

        </div>

    </div>

    <div class="variant-section mt-5">

        <h4 class="mb-4">
            Variants & Additional Price
        </h4>

        <?php foreach($groups as $group): ?>

            <div class="variant-card mb-4">

                <h5>
                    <?= $group['name'] ?>
                </h5>

                <table class="table">

                    <thead>

                        <tr>

                            <th>Variants</th>
                            <th>Additional Price</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach($group['variants'] as $variant): ?>

                            <tr>

                                <td>
                                    <?= $variant['name'] ?>
                                </td>

                                <td>

                                    + Rp <?= number_format(
                                        $variant['additional_price']
                                    ) ?>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        <?php endforeach ?>

    </div>

    <div class="text-center mt-5">

        <a
            href="/products/custom/<?= $product['id'] ?>"
            class="btn btn-purple btn-lg">

            Custom Yours Now!

        </a>

    </div>

</div>

<?= view('layouts/footer') ?>