<?= view('layouts/header') ?>

<div class="container py-4">

    <h2 class="mb-4">

        Customer Management

    </h2>

    <div class="table-card">

        <div class="card-body">
            <div class="table-responsive">

            <table class="table custom-table mb-0">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Total Orders</th>

                        <th></th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($users as $user): ?>

                        <tr>

                            <td>

                                <?= $user['id'] ?>

                            </td>

                            <td>

                                <?= $user['name'] ?>

                            </td>

                            <td>

                                <?= $user['email'] ?>

                            </td>

                            <td>

                                <?= $user['phone'] ?? '-' ?>

                            </td>

                            <td>

                                <?= $user['total_orders'] ?>

                            </td>

                            <td class="text-end">

                                <a
                                    href="/admin/users/<?= $user['id'] ?>"
                                    class="btn btn-sm btn-purple">

                                    Detail

                                </a>

                            </td>

                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>
            </div>

        </div>

    </div>

</div>

<?= view('layouts/footer') ?>