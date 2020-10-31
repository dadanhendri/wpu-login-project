<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary tombolTambahUser mb-3" data-toggle="modal" data-target="#userModal">
                Add New User
            </button>
            <!-- <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= validation_errors(); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?> -->
            <!-- <?= $this->session->flashdata('message'); ?> -->

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Role Id</th>
                        <th scope="col">Is_active</th>
                        <th scope="col">Created</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($users as $us) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $us['name']; ?></td>
                            <td><?= $us['email']; ?></td>
                            <td><img src="<?= base_url() . 'assets/img/profile/' . $us['image']; ?>" width="50px" class="img-fluid img-thumbnail" alt=""></td>
                            <td><?= $us['role']; ?></td>
                            <td><?= $us['is_active']; ?></td>
                            <td><?= date('d M Y', $us['date_created']); ?></td>
                            <td>
                                <a href="<?= base_url('admin/ubahUser/') . $us['id']; ?>" class="badge badge-success tombolUbahUser" data-id="<?= $us['id']; ?>" data-toggle="modal" data-target="#userModal">Edit</a>
                                <a href="<?= base_url('admin/hapusUser/') . $us['id']; ?>" class="badge badge-danger tombol-hapus" data-text="User">Hapus</a>
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
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/user'); ?>" method="POST">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="password">
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat password">
                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="role_id" id="role_id">
                            <option value="">Role</option>
                            <?php foreach ($role as $rl) : ?>
                                <?php if ($rl['id'] != 1) : ?>
                                    <option value="<?= $rl['id']; ?>"><?= $rl['role']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" checked>
                            Active?
                        </label>
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