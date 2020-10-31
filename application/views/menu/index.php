<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary tombolTambahMenu mb-3" data-toggle="modal" data-target="#menuModal">
                Add New Menu
            </button>

            <!-- <?php echo $this->session->flashdata('message'); ?> -->

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $mn) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $mn['menu']; ?></td>
                            <td>
                                <a href="" class="badge badge-success tombolUbahMenu" data-toggle="modal" data-target="#menuModal" data-id="<?= $mn['id']; ?>">Edit</a>
                                <a href="<?= base_url('menu/hapusMenu/') . $mn['id']; ?>" class="badge badge-danger tombol-hapus" data-text="Menu">Hapus</a>
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
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu'); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="New menu">
                        <?= form_error('menu', '<small class="text-danger pl-3">', '<?small>'); ?>
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