<?= view('layouts/header') ?>

<div class="container py-4">

    <!-- HERO -->

    <div
        id="heroCarousel"
        class="carousel slide hero-banner mb-5"
        data-bs-ride="carousel">

        <div class="carousel-inner">

            <div class="carousel-item active">

                <img
                    src="<?= base_url('assets/images/banner1.png') ?>"
                    class="d-block w-100">

            </div>

            <div class="carousel-item">

                <img
                    src="<?= base_url('assets/images/banner2.png') ?>"
                    class="d-block w-100">

            </div>

            <div class="carousel-item">

                <img
                    src="<?= base_url('assets/images/banner3.png') ?>"
                    class="d-block w-100">

            </div>

        </div>

    </div>


    <!-- HOTTEST PRODUCT -->

    <h2 class="section-title">

        🔥 Hottest Products

    </h2>

    <div class="row g-4 mb-5">

        <?php foreach ($hottestProducts as $product): ?>

            <div class="col-md-3">

                <div class="card hottest-card">

                    <img
                        src="<?= $product['image']
                                    ? '/uploads/products/' . $product['image']
                                    : '/assets/images/no-image.png' ?>"
                        class="card-img-top">

                    <div class="card-body">

                        <h5>

                            <?= $product['name'] ?>

                        </h5>

                        <p class="text-muted">

                            Sold :
                            <?= $product['sold'] ?>

                        </p>

                        <h6>

                            Rp <?= number_format($product['price']) ?>

                        </h6>

                        <a
                            href="/products/detail/<?= $product['id'] ?>"
                            class="btn btn-purple w-100">

                            View Product

                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach ?>

    </div>


    <!-- WHY US -->

    <h2 class="section-title">

        Why Choose MerchStore?

    </h2>

    <div class="row g-4 mb-5">

        <div class="col-md-4">

            <div class="card step-card">

                <i class="bi bi-palette step-icon"></i>

                <h5 class="mt-3">

                    Custom Design

                </h5>

                <p>

                    Upload desain sendiri dan buat merchandise sesuai keinginan.

                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card step-card">

                <i class="bi bi-lightning-charge step-icon"></i>

                <h5 class="mt-3">

                    Fast Production

                </h5>

                <p>

                    Proses pemesanan mudah dan produksi cepat.

                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card step-card">

                <i class="bi bi-box-seam step-icon"></i>

                <h5 class="mt-3">

                    Safe Packaging

                </h5>

                <p>

                    Produk dikemas dengan aman hingga sampai ke pelanggan.

                </p>

            </div>

        </div>

    </div>


    <!-- HOW TO ORDER -->

    <h2 class="section-title">

        How To Order

    </h2>

    <div class="row g-4 mb-5">

        <div class="col-md-3">

            <div class="card step-card">

                <i class="bi bi-bag step-icon"></i>

                <h5>

                    Choose Product

                </h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card step-card">

                <i class="bi bi-upload step-icon"></i>

                <h5>

                    Upload Design

                </h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card step-card">

                <i class="bi bi-credit-card step-icon"></i>

                <h5>

                    Checkout & Payment

                </h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card step-card">

                <i class="bi bi-truck step-icon"></i>

                <h5>

                    Production & Shipping

                </h5>

            </div>

        </div>

    </div>


    <!-- CATEGORY -->

    <h2 class="section-title">

        Product Categories

    </h2>

    <div class="row g-4 mb-5">

        <?php foreach ($categories as $category): ?>

            <div class="col-md-3">

                <a
                    href="/products?category=<?= $category['id'] ?>"
                    class="category-card shadow-sm">

                    <div class="category-icon">

                        <i class="bi bi-grid"></i>

                    </div>

                    <h5 class="mt-3">

                        <?= $category['name'] ?>

                    </h5>

                </a>

            </div>

        <?php endforeach ?>

    </div>


    <!-- CTA -->

    <div class="cta-section text-center">

        <h2>

            Ready To Create Your Own Merchandise?

        </h2>

        <p class="mt-3">

            Upload desainmu dan buat merchandise unik sekarang juga.

        </p>

        <a
            href="/products"
            class="btn btn-light btn-lg mt-3">

            Start Ordering

        </a>

    </div>

</div>
<script>
    const hero =
        document.querySelector(
            '#heroCarousel'
        );

    const carousel =
        new bootstrap.Carousel(
            hero, {
                interval: 1000,
                ride: 'carousel'
            }
        );
</script>

<?= view('layouts/footer') ?>