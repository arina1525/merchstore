<?= view('layouts/header') ?>

<div class="auth-container">

    <div class="auth-card">

        <h2 class="text-center mb-4">
            Login
        </h2>

        <form method="post" action="/login/check">

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>

            <button
                type="submit"
                class="btn auth-btn w-100">

                Login

            </button>

        </form>

        <p class="text-center mt-3">

            Belum punya akun?

            <a href="/register">
                Daftar disini
            </a>

        </p>

    </div>

</div>

<?= view('layouts/footer') ?>