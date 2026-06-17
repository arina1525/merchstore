<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>
        Tambah Variant Group
    </h2>

    <p>
        Produk:
        <strong>
            <?= $product['name'] ?>
        </strong>
    </p>

    <div class="form-card">

        <form
            method="post"
            action="/admin/products/variants/store/<?= $product['id'] ?>">

            <div class="mb-3">

                <label class="form-label">
                    Nama Group
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Contoh: Ukuran">

            </div>

            <button
                type="submit"
                class="btn btn-purple">
                Save
            </button>
            <a
                href="/admin/products/variants/<?= $product['id'] ?>"
                class="btn btn-outline-secondary">
                Back
            </a>

        </form>

    </div>

</div>

<?= view('layouts/footer') ?>