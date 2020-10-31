<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary tombolTambahRole mb-3" data-toggle="modal" data-target="#roleModal">
                Add New Role
            </button>

            <!-- <?php echo $this->session->flashdata('message'); ?> -->

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $rl) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $rl['role']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/roleAccess/') . $rl['id']; ?>" class="badge badge-warning" data-id="<?= $rl['id']; ?>">Access</a>
                                <a href="" class="badge badge-success tombolUbahRole" data-toggle="modal" data-target="#roleModal" data-id="<?= $rl['id']; ?>">Edit</a>
                                <a href="<?= base_url('admin/deleteRole/') . $rl['id']; ?>" class="badge badge-danger tombol-hapus" data-text="Role">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



</div>
<!-- /.container-fluid -->



<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/role'); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" id="role" name="role" placeholder="New Role">
                        <?= form_error('role', '<small class="text-danger pl-3">', '<?small>'); ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>