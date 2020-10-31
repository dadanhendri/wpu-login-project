<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- sweet alert -->
<script src="<?= base_url('assets/'); ?>js/sweetalert/sweetalert2.all.min.js"></script>


<script>
    $(function() {
        const flashdata = $('.flash-data').data('flashdata');
        if (flashdata) {
            Swal.fire({
                title: 'Success',
                text: flashdata,
                icon: 'success'
            });
        }

        const flashdata_warning = $('.flash-data-warning').data('flashdata');
        if (flashdata_warning) {
            Swal.fire({
                title: 'Ooops....',
                text: flashdata_warning,
                icon: 'error'
            });
        }

    });
</script>

</body>

</html>