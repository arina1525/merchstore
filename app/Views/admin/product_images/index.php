<?= view('layouts/header') ?>

<div class="container py-4">

    <h2>

        Images

        <?= $product['name'] ?>

    </h2>
    <form
        method="post"
        enctype="multipart/form-data"
        action="/admin/products/images/store/<?= $product['id'] ?>">

        <input
            type="file"
            name="image">

        <button
            class="btn btn-purple">

            Upload

        </button>

    </form>
    <div class="row mt-4">

        <?php foreach($images as $image): ?>

            <div class="col-md-3 mb-3">

                <img
                    src="<?= base_url(
                        'uploads/products/' .
                        $image['image']
                    ) ?>"
                    class="img-fluid rounded">
                <a
                    href="/admin/products/images/delete/<?= $image['id'] ?>"
                    class="btn btn-danger btn-sm mt-2"
                    onclick="return confirm('Hapus gambar?')">

                    Delete

                </a>    

            </div>

        <?php endforeach ?>

    </div>

</div>

<?= view('layouts/footer') ?>