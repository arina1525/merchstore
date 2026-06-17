<nav class="navbar navbar-expand-lg custom-navbar sticky-top">

    <div class="container-fluid px-4">

        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="<?= base_url('assets/images/logo.svg') ?>"
                alt="Logo"
                height="45">
        </a>

        <!-- Burger -->
        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
            id="mainNavbar">

            <?php if (session()->get('role') == 'admin'): ?>

                <!-- ADMIN MENU -->

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/categories">
                            Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/products">
                            Products
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/orders">
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/users">
                            Users
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/logout">
                            Logout
                        </a>
                    </li>

                </ul>

            <?php else: ?>

                <!-- GUEST & CUSTOMER -->

                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/products">
                            Products
                        </a>
                    </li>

                </ul>

                <!-- SEARCH -->
                <form class="d-flex flex-grow-1 mx-4"
                    action="/products"
                    method="get">

                    <input
                        class="form-control"
                        type="search"
                        name="search"
                        placeholder="Search product...">

                </form>

                <!-- RIGHT MENU -->
                <ul class="navbar-nav ms-auto">

                    <?php if (!session()->get('user_id')): ?>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="/login">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="/register">
                                Register
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="/cart">

                                <i class="bi bi-cart3"></i>
                                <span class="d-lg-none">
                                    Cart
                                </span>

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="/orders">

                                <i class="bi bi-bag-check"></i>
                                <span class="d-lg-none">
                                    My Order
                                </span>

                            </a>
                        </li>
                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="/addresses">

                                <i class="bi bi-geo-alt"></i>

                                <span class="d-lg-none">

                                    Address

                                </span>

                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="/profile">

                                <i class="bi bi-person-circle"></i>
                                <span class="d-lg-none">
                                    Profile
                                </span>

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="/logout">

                                <i class="bi bi-box-arrow-right"></i>
                                <span class="d-lg-none">
                                    Logout
                                </span>

                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            <?php endif; ?>

        </div>

    </div>

</nav>