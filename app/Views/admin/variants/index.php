<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>
        Kelola Variasi
    </h2>

    <p>
        Produk:
        <strong>
            <?= $product['name'] ?>
        </strong>
    </p>

    <hr>

    <a
        href="/admin/products/variants/create/<?= $product['id'] ?>"
        class="btn btn-purple mb-3">

        + Tambah Group

    </a>

    <table class="table">

        <thead>

            <tr>
                <th>ID</th>
                <th>Group Name</th>
                <th>Action</th>
                <th>Manage</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach($groups as $group): ?>

            <tr>

                <td>
                    <?= $group['id'] ?>
                </td>

                <td>
                    <?= $group['name'] ?>
                </td>
                <td>
                    <a
                        href="/admin/products/variants/edit/<?= $group['id'] ?>"
                        class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <a
                        href="/admin/products/variants/delete/<?= $group['id'] ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus group?')">

                        Delete

                    </a>

                </td>
                <td>
                    <a
                    href="/admin/variants/<?= $group['id'] ?>"
                    class="btn btn-success btn-sm">

                    Variants

                    </a>
                </td>

            </tr>

            <?php endforeach ?>

        </tbody>

    </table>
    <a
        href="/admin/products"
        class="btn btn-outline-secondary">
        back
    </a>

</div>

<?= view('layouts/footer') ?>