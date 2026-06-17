<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>
        Variants
    </h2>

    <p>

        Group :

        <strong>
            <?= $group['name'] ?>
        </strong>

    </p>

    <a
        href="/admin/variants/create/<?= $group['id'] ?>"
        class="btn btn-purple mb-3">

        + Tambah Variant

    </a>

    <table class="table">

        <thead>

            <tr>

                <th>ID</th>
                <th>Name</th>
                <th>Additional Price</th>
                <th>Stock</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach($variants as $variant): ?>

            <tr>

                <td><?= $variant['id'] ?></td>

                <td><?= $variant['name'] ?></td>

                <td>
                    Rp <?= number_format(
                        $variant['additional_price']
                    ) ?>
                </td>

                <td>
                    <?= $variant['stock'] ?>
                </td>
                <td>
                    <a
                        href="/admin/variants/edit/<?= $variant['id'] ?>"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <a
                        href="/admin/variants/delete/<?= $variant['id'] ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus variant?')">
                        Delete
                    </a>

                </td>
            </tr>

            <?php endforeach ?>

        </tbody>

    </table>
    <a
        href="/admin/products/variants/<?= $group['product_id'] ?>"
        class="btn btn-outline-secondary">
        back
    </a>

</div>

<?= view('layouts/footer') ?>