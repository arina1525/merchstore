<?= view('layouts/header') ?>

<div class="auth-container">

    <div class="auth-card">

        <h2 class="text-center mb-4">
            Register
        </h2>

        <form method="post" action="/register/save">

            <div class="mb-3">

                <label class="form-label">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    required>

            </div>

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

            <div class="mb-3">

                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>

            <div class="form-check mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    required>

                <label class="form-check-label">

                    I agree to the
                    <a href="#">
                        Terms & Conditions
                    </a>
                    and
                    <a href="#">
                        Privacy Policy
                    </a>

                </label>

            </div>

            <button
                type="submit"
                class="btn auth-btn w-100">

                Register

            </button>

        </form>

        <p class="text-center mt-3">

            Sudah punya akun?

            <a href="/login">
                Login disini
            </a>

        </p>

    </div>

</div>

<?= view('layouts/footer') ?>