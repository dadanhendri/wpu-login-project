<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary tombolTambahSubMenu mb-3" data-toggle="modal" data-target="#subMenuModal">
                Add New User
            </button>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= validation_errors(); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

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
                            <td><img src="<?= base_url().'assets/img/profile/'. $us['image']; ?>" width="50px" class="img-fluid img-thumbnail" alt=""></td>
                            <td><?= $us['role']; ?></td>
                            <td><?= $us['is_active']; ?></td>
                            <td><?= date('d M Y',$us['date_created']); ?></td>
                            <td>
                                <a href="<?= base_url('admin/ubahUser/').$us['id']; ?>" class="badge badge-success">Edit</a>
                                <a href="<?= base_url('admin/hapusUser/') . $us['id']; ?>" class="badge badge-danger" onclick="return confirm('Yakin ?')">Hapus</a>
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



<!-- Modal tambah sub menu -->
<div class="modal fade" id="subMenuModal" tabindex="-1" aria-labelledby="subMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/subMenu'); ?>" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <select class="form-control" name="menu_id" id="menu_id">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $mn) : ?>
                                <option value="<?= $mn['id']; ?>"><?= $mn['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= set_value('title'); ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url" value="<?= set_value('url'); ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" value="<?= set_value('icon'); ?>">
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