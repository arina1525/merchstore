<?= view('layouts/header') ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            Daftar Kategori
        </h2>

        <a href="/admin/categories/create"
           class="btn btn-purple">

            + Tambah Kategori

        </a>

    </div>

    <div class="table-card">

        <div class="table-responsive">

            <table class="table custom-table mb-0">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Preview Type</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($categories as $category): ?>

                        <tr>

                            <td><?= $category['id'] ?></td>

                            <td><?= $category['name'] ?></td>

                            <td>

                                <span class="preview-badge">

                                    <?= $category['preview_type'] ?>

                                </span>

                            </td>

                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= view('layouts/footer') ?>