<?= view('layouts/header') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-body p-4">

                    <h2 class="mb-4">

                        Add Address

                    </h2>

                    <form
                        action="/addresses/store"
                        method="post">

                        <div class="mb-3">

                            <label class="form-label">

                                Receiver Name

                            </label>

                            <input
                                type="text"
                                name="receiver_name"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Phone Number

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Province

                            </label>

                            <select
                                name="province"
                                class="form-select"
                                required>

                                <option value="">

                                    Select Province

                                </option>

                                <option value="DKI Jakarta">

                                    DKI Jakarta

                                </option>

                                <option value="Jawa Barat">

                                    Jawa Barat

                                </option>

                                <option value="Jawa Tengah">

                                    Jawa Tengah

                                </option>

                                <option value="Jawa Timur">

                                    Jawa Timur

                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                City

                            </label>

                            <input
                                type="text"
                                name="city"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Postal Code

                            </label>

                            <input
                                type="text"
                                name="postal_code"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Full Address

                            </label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="4"
                                required></textarea>

                        </div>

                        <div class="form-check mb-4">

                            <input
                                type="checkbox"
                                name="is_default"
                                class="form-check-input"
                                id="defaultAddress">

                            <label
                                class="form-check-label"
                                for="defaultAddress">

                                Set as default address

                            </label>

                        </div>

                        <div class="d-flex gap-2">

                            <a
                                href="/addresses"
                                class="btn btn-outline-secondary">

                                Cancel

                            </a>

                            <button
                                type="submit"
                                class="btn btn-purple">

                                Save Address

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= view('layouts/footer') ?>