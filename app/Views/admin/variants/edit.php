<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>Edit Variant Group</h2>

    <div class="form-card">

        <form
            method="post"
            action="/admin/products/variants/update/<?= $group['id'] ?>">

            <div class="mb-3">

                <label>
                    Nama Group
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= $group['name'] ?>">

            </div>

            <button
                type="submit"
                class="btn btn-purple">

                Update

            </button>
            <a
                href="/admin/products/variants/<?= $group['product_id'] ?>"
                class="btn btn-outline-secondary">
                back

            </a>

        </form>

    </div>

</div>

<?= view('layouts/footer') ?>