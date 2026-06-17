<?= view('layouts/header') ?>

<div class="container py-4">

    <h2 class="mb-4">
        Edit Produk
    </h2>

    <div class="form-card">

        <form
            method="post"
            action="/admin/products/update/<?= $product['id'] ?>">

            <div class="mb-3">

                <label>
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= $product['name'] ?>">

            </div>

            <div class="mb-3">

                <label>
                    Kategori
                </label>

                <select
                    name="category_id"
                    class="form-select">

                    <?php foreach($categories as $category): ?>

                        <option
                            value="<?= $category['id'] ?>"
                            <?= $category['id'] == $product['category_id']
                                ? 'selected'
                                : '' ?>
                            >

                            <?= $category['name'] ?>

                        </option>

                    <?php endforeach ?>

                </select>

            </div>

            <div class="mb-3">

                <label>
                    Harga Dasar
                </label>

                <input
                    type="number"
                    name="price"
                    class="form-control"
                    value="<?= $product['price'] ?>">

            </div>


            <div class="mb-3">

                <label>
                    Status
                </label>

                <select
                    name="status"
                    class="form-select">

                    <option value="active" <?= $product['status'] == 'active' ? 'selected' : '' ?>>
                        Active
                    </option>

                    <option value="inactive" <?= $product['status'] == 'inactive' ? 'selected' : '' ?>>
                        Inactive
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label>
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="form-control"><?= $product['description'] ?></textarea>

            </div>

            <button
                type="submit"
                class="btn btn-purple">

                Simpan Produk

            </button>

        </form>

    </div>

</div>

<?= view('layouts/footer') ?>