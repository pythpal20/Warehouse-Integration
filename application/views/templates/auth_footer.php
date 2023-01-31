<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- sweet alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

<script>
    function change() {
        var x = document.getElementById('password').type;
        if (x == 'password') {
            document.getElementById('password').type = 'text';
            document.getElementById('mybutton').innerHTML = `<i class="fas fa-fw fa-eye-slash"></i>`;
        } else {
            document.getElementById('password').type = 'password';
            document.getElementById('mybutton').innerHTML = `<i class="fas fa-fw fa-eye"></i>`;
        }
    }
</script>
<script>
    $(document).ready(function() {
        <?= $this->session->flashdata('message'); ?>
    });
</script>
<script>
    var browserName = (function(agent) {
        switch (true) {
            case agent.indexOf("edge") > -1:
                return "MS Edge";
            case agent.indexOf("edg/") > -1:
                return "Edge ( chromium based)";
            case agent.indexOf("opr") > -1 && !!window.opr:
                return "Opera";
            case agent.indexOf("chrome") > -1 && !!window.chrome:
                return "Chrome";
            case agent.indexOf("trident") > -1:
                return "MS IE";
            case agent.indexOf("firefox") > -1:
                return "Mozilla Firefox";
            case agent.indexOf("safari") > -1:
                return "Safari";
            default:
                return "other";
        }
    })(window.navigator.userAgent.toLowerCase());

    if((browserName == 'Chrome') || (browserName == 'Mozilla Firefox') || (browserName == 'MS Edge')) {
        console.log(browserName);
        // swal.fire({
        //     title: 'Selamat datang di Aplikasi Sistem Integrasi',
        //     icon: 'warning'
        // });
    } else {
        swal.fire({
            title: "This browser is not Support",
            text: 'Use Updated version of Google Chrome Or Mozilla Firefox for this site',
            icon: 'warning',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false
        })
    }
</script>
</body>

</html>