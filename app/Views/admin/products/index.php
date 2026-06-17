<?= view('layouts/header') ?>

<div class="container py-4">

    <div class="d-flex
                justify-content-between
                align-items-center
                mb-4">

        <h2>
            Daftar Produk
        </h2>

        <a
            href="/admin/products/create"
            class="btn btn-purple">

            + Tambah Produk

        </a>

    </div>

    <div class="table-card">

        <div class="table-responsive">

        <table class="table custom-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Manage</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach($products as $product): ?>

                <tr>

                    <td><?= $product['id'] ?></td>

                    <td><?= $product['name'] ?></td>

                    <td><?= $product['category_name'] ?></td>

                    <td>
                        Rp <?= number_format($product['price']) ?>
                    </td>
                    <td>
                        <?= $product['stock_total'] ?>
                    </td>

                    <td>
                        <?= $product['status'] ?>
                    </td>
                    <td>
                        <a href="/admin/products/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <a href="/admin/products/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm" 
                        onclick="return confirm('Hapus produk?')">
                        Delete
                        </a>
                    </td>
                    <td>
                        <a href="/admin/products/images/<?= $product['id'] ?>"
                        class="btn btn-info btn-sm">
                        Images
                        </a>

                        <a href="/admin/products/variants/<?= $product['id'] ?>"
                        class="btn btn-success btn-sm">
                        Variants
                        </a>
                    </td>

                </tr>

                <?php endforeach ?>

            </tbody>

        </table>
        </div>

    </div>

</div>

<?= view('layouts/footer') ?>