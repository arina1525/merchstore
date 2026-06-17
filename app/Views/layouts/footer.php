</main>

<footer class="custom-footer">

    <div class="container py-4">

        <div class="row">

            <!-- Logo -->

            <div class="col-md-4 mb-3">

                <img
                    src="<?= base_url('assets/images/logo.svg') ?>"
                    alt="Logo"
                    class="footer-logo">

            </div>

            <!-- Alamat -->

            <div class="col-md-4 mb-3">

                <h5>Address</h5>

                <p>
                    Jl. wkwkkwkwkwwkwkwkk No. 123<br>
                    Jawa Utara, Amerika, Mars
                </p>

            </div>

            <!-- Contact -->

            <div class="col-md-4 mb-3">

                <h5>Contact Us</h5>

                <p>
                    Email: admin@merchstore.com<br>
                    WA: 08xxxxxxxxxx
                </p>

            </div>

        </div>

        <hr>

        <div class="text-center">

            <b>© <?= date('Y') ?> MerchStore </b><br>
            All Artwork by:
            Arina Al Haq

        </div>

    </div>

</footer>
<button
    id="backToTop"
    class="back-to-top">

    <i class="bi bi-arrow-up"></i>

</button>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>

const backToTop =
    document.getElementById(
        'backToTop'
    );

window.addEventListener(
    'scroll',
    function(){

        if(window.scrollY > 300){

            backToTop.classList.add(
                'show'
            );

        }else{

            backToTop.classList.remove(
                'show'
            );

        }

    }
);

backToTop.addEventListener(
    'click',
    function(){

        window.scrollTo({

            top:0,

            behavior:'smooth'

        });

    }
);

</script>

</body>
</html>