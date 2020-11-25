</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; WPU Login Project <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<!-- <script src="<?= base_url('assets/'); ?>js/myscript.js"></script> -->

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

        const tombolHapus = $('.tombol-hapus').on('click', function(event) {
            event.preventDefault();
            text = $(this).data('text')
            href = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete this " + text + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            });

        });


        $('.tombolTambahRole').on('click', function() {
            $('#roleModalLabel').html('Add Role');
            $('#role').val('');
            $('.modal-footer button[type=submit]').html('Add');
        });

        $('.tombolUbahRole').on('click', function() {
            $('#roleModalLabel').html('Edit Role');
            $('.modal-footer button[type=submit]').html('Edit');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url() . "admin/getRoleById"; ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#role').val(data.role);
                    $('.modal-body form').attr('action', '<?= base_url() . "admin/editRole"; ?>')
                }

            });
        });

        $('.tombolTambahMenu').on('click', function() {
            $('#menuModalLabel').html('Add Menu');
            $('#menu').val('');
            $('.modal-footer button[type=submit]').html('Add')
        });

        $('.tombolUbahMenu').on('click', function() {
            $('#menuModalLabel').html('Update Menu');
            $('.modal-footer button[type=submit]').html('Update')

            const id = $(this).data('id');
            $.ajax({
                url: '<?= base_url() . "menu/getUbahMenu"; ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#menu').val(data.menu);
                    $('.modal-body form').attr('action', '<?= base_url() . "menu/ubahMenu"; ?>')
                }

            });
        });

        $('.tombolTambahSubMenu').on('click', function() {
            $('#subMenuModalLabel').html('Add Sub Menu');
            $('.modal-footer button[type=submit]').html('Add')
        });

        $('.tampilModalUbah').on('click', function() {
            $('#subMenuModalLabel').html('Update Sub Menu');
            $('.modal-footer button[type=submit]').html('Update')

            const id = $(this).data('id');
            $.ajax({
                url: '<?= base_url() . "menu/getUbahSubMenu" ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#menu_id').val(data.menu_id);
                    $('#title').val(data.title);
                    $('#url').val(data.url);
                    $('#icon').val(data.icon);
                    $('.modal-body form').attr('action', '<?= base_url('menu/ubahSubMenu'); ?>')
                }
            });
        });

        $('.form-check-input').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');
            $.ajax({
                url: '<?= base_url("admin/changeAccess"); ?>',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                method: 'post',
                success: function() {
                    document.location.href = "<?= base_url('admin/roleAccess/'); ?>" + roleId;
                }
            });
        });

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $('.tombolTambahUser').on('click', function() {
            $('#userModalLabel').html('Add New user')
            $('.modal-footer button[type=submit]').html('Add')
        });

        $('.tombolUbahUser').on('click', function() {
            $('#userModalLabel').html('Update User');
            $('.modal-footer button[type=submit]').html('Update');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url() . "admin/getUser"; ?>',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#email').attr('readonly', 'readonly');
                    $('#password').val(data.password);
                    $('#role_id').val(data.role_id);
                    $('#is_active').val(data.is_active);
                    $('.modal-body form').attr('action', '<?= base_url() . "admin/ubahUser"; ?>');
                }
            });
        });


        $('.tombolUbahSchedule').on('click', function() {

            $('#scheduleModalLabel').html('Update Schedule');
            $('.modal-footer button[type=submit]').html('Update');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url() . "schedule/getSchedule"; ?>',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#date').val(data.date);
                    $('#time_start').val(data.time_start);
                    $('#time_end').val(data.time_end);
                    $('#type').val(data.type);
                    $('#classroom').val(data.classroom);
                    $('.modal-body form').attr('action', '<?= base_url() . "schedule/updateSchedule"; ?>');
                }
            });
        });






    });
</script>

</body>

</html>