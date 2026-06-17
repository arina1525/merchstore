<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>Tambah Variant</h2>

    <p>
        Group:
        <strong>
            <?= $group['name'] ?>
        </strong>
    </p>

    <div class="form-card">

        <form
            method="post"
            action="/admin/variants/store/<?= $group['id'] ?>">

            <div class="mb-3">

                <label>Nama Variant</label>

                <input
                    type="text"
                    name="name"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Harga Tambahan</label>

                <input
                    type="number"
                    name="additional_price"
                    class="form-control"
                    value="0">

            </div>

            <div class="mb-3">

                <label>Stock</label>

                <input
                    type="number"
                    name="stock"
                    class="form-control"
                    value="0">

            </div>

            <button
                type="submit"
                class="btn btn-purple">
                Save
            </button>
            <a
                href="/admin/variants/<?= $group['id'] ?>"
                class="btn btn-outline-secondary">

                ← Back

            </a>

        </form>

    </div>

</div>

<?= view('layouts/footer') ?>