<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>Edit Variant</h2>

    <div class="form-card">

        <form
            method="post"
            action="/admin/variants/update/<?= $variant['id'] ?>">

            <div class="mb-3">

                <label>Nama Variant</label>

                <input
                    type="text"
                    name="name"
                    value="<?= $variant['name'] ?>"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Harga Tambahan</label>

                <input
                    type="number"
                    name="additional_price"
                    value="<?= $variant['additional_price'] ?>"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Stock</label>

                <input
                    type="number"
                    name="stock"
                    value="<?= $variant['stock'] ?>"
                    class="form-control">

            </div>

            <button
                type="submit"
                class="btn btn-purple">

                Update

            </button>
            <a
                href="/admin/variants/<?= $variant['id'] ?>"
                class="btn btn-outline-secondary">

                ← Back

            </a>

        </form>

    </div>

</div>

<?= view('layouts/footer') ?>