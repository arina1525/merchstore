<?= view('layouts/header') ?>

<div class="container py-4">

    <h2 class="mb-4">

        My Profile

    </h2>

    <?php if(session()->getFlashdata('success')): ?>

        <div class="alert alert-success">

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif ?>

    <div class="card">

        <div class="card-body">

            <form
                action="/profile/update"
                method="post">

                <div class="mb-3">

                    <label class="form-label">

                        Name

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= $user['name'] ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Email

                    </label>

                    <input
                        type="email"
                        class="form-control"
                        value="<?= $user['email'] ?>"
                        readonly>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Phone

                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="<?= $user['phone'] ?? '' ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Role

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= ucfirst($user['role']) ?>"
                        readonly>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Joined

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= date(
                            'd M Y',
                            strtotime(
                                $user['created_at']
                            )
                        ) ?>"
                        readonly>

                </div>

                <button
                    type="submit"
                    class="btn btn-purple">

                    Save Changes

                </button>

            </form>

        </div>

    </div>

</div>

<?= view('layouts/footer') ?>