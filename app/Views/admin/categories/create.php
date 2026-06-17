<?= view('layouts/header') ?>

<div class="container py-4">

    <div class="mb-4">

        <h2>
            Tambah Kategori
        </h2>

        <p class="text-muted">
            Tambahkan kategori baru untuk produk merch.
        </p>

    </div>

    <div class="form-card">

        <form
            method="post"
            action="/admin/categories/store">

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Contoh: Keychain"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Preview Type
                </label>

                <select
                    name="preview_type"
                    class="form-select">

                    <option value="keychain">
                        Keychain
                    </option>

                    <option value="phonestrap">
                        Phonestrap
                    </option>

                    <option value="standee">
                        Standee
                    </option>

                    <option value="sticker">
                        Sticker
                    </option>

                    <option value="print">
                        Print
                    </option>

                    <option value="pin">
                        Pin
                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control"
                    placeholder="Deskripsi kategori..."></textarea>

            </div>

            <button
                type="submit"
                class="btn btn-purple">

                Simpan Kategori

            </button>

            <a
                href="/admin/categories"
                class="btn btn-outline-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

<?= view('layouts/footer') ?>