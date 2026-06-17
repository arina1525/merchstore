<?= view('layouts/header') ?>

<div class="container py-4">
    <div class="row g-4">

        <form method="get" id="filterForm">

            <div class="row mb-4">

                <div class="col-md-4">

                    <select
                        name="category"
                        id="categorySelect"
                        class="form-select">

                        <option value="">
                            All Categories
                        </option>

                        <?php foreach ($categories as $cat): ?>

                            <option
                                value="<?= $cat['id'] ?>"
                                <?= $category == $cat['id'] ? 'selected' : '' ?>>

                                <?= $cat['name'] ?>

                            </option>

                        <?php endforeach ?>

                    </select>
                </div>

                <div class="col-md-4">

                    <select
                        name="sort"
                        id="sortSelect"
                        class="form-select">

                        <option value="">
                            Newest
                        </option>

                        <option
                            value="price_asc"
                            <?= $sort == 'price_asc' ? 'selected' : '' ?>>

                            Price Low → High

                        </option>

                        <option
                            value="price_desc"
                            <?= $sort == 'price_desc' ? 'selected' : '' ?>>

                            Price High → Low

                        </option>

                    </select>

                </div>
                <div class="col-md-4">
                    <small class="text-muted">

                        <?= count($products) ?> products found

                    </small>
                </div>

            </div>

        </form>

        <?php foreach ($products as $product): ?>

            <div class="col-lg-4 col-md-6 col-6">

                <div class="product-card">

                    <?php if ($product['thumbnail']): ?>

                        <img
                            src="<?= base_url(
                                        'uploads/products/' .
                                            $product['thumbnail']
                                    ) ?>"
                            class="product-image">

                    <?php endif; ?>

                    <div class="p-3">

                        <h5>
                            <?= $product['name'] ?>
                        </h5>

                        <p class="product-price">

                            Rp <?= number_format(
                                    $product['min_price']
                                ) ?>

                            -

                            Rp <?= number_format(
                                    $product['max_price']
                                ) ?>

                        </p>

                        <a
                            href="/products/detail/<?= $product['id'] ?>"
                            class="btn btn-purple w-100">

                            Details

                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach ?>
    </div>

</div>
<button
    id="backToTop"
    class="back-to-top">

    <i class="bi bi-arrow-up"></i>

</button>
<script>
    document
        .getElementById('categorySelect')
        .addEventListener(
            'change',
            function() {

                document
                    .getElementById('filterForm')
                    .submit();

            }
        );

    document
        .getElementById('sortSelect')
        .addEventListener(
            'change',
            function() {

                document
                    .getElementById('filterForm')
                    .submit();

            }
        );
    const backToTop =
        document.getElementById(
            'backToTop'
        );

    window.addEventListener(
        'scroll',
        function() {

            if (window.scrollY > 300) {

                backToTop.classList.add(
                    'show'
                );

            } else {

                backToTop.classList.remove(
                    'show'
                );

            }

        }
    );

    backToTop.addEventListener(
        'click',
        function() {

            window.scrollTo({

                top: 0,

                behavior: 'smooth'

            });

        }
    );
</script>

<?= view('layouts/footer') ?>