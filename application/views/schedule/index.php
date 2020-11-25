<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary tombolTambahSchedule mb-3" data-toggle="modal" data-target="#scheduleModal">
                Add New Schedule
            </button>

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time Start</th>
                        <th scope="col">Time End</th>
                        <th scope="col">Type</th>
                        <th scope="col">Stages</th>
                        <!-- <th scope="col">Classroom</th> -->
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($schedule as $sc) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $sc['event']; ?></td>
                            <td><?= $sc['title']; ?></td>
                            <td><?= $sc['date']; ?></td>
                            <td><?= $sc['time_start']; ?></td>
                            <td><?= $sc['time_end']; ?></td>
                            <td><?= $sc['type']; ?></td>
                            <td><?= $sc['stages']; ?></td>
                            <!-- <td><?= $sc['classroom']; ?></td> -->
                            <td>
                                <a href="<?= base_url('schedule/scheduleDetail/') . $sc['id']; ?>" class="badge badge-primary" data-id="<?= $sc['id']; ?>">Detail</a>
                                <a href="<?= base_url('schedule/ubahJadwal/') . $sc['id']; ?>" class="badge badge-success tombolUbahSchedule" data-id="<?= $sc['id']; ?>" data-toggle="modal" data-target="#scheduleModal">Edit</a>
                                <a href="<?= base_url('admin/hapusJadwal/') . $sc['id']; ?>" class="badge badge-danger tombol-hapus" data-text="Shedule">Hapus</a>
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
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Add New schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('schedule'); ?>" method="POST">
                    <input type="hidden" class="form-control" id="id" name="id">

                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= set_value('title'); ?>">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?= set_value('date'); ?>">
                        <?= form_error('date', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="time" class="form-control" id="time_start" name="time_start" placeholder="Time start" value="<?= set_value('time_start'); ?>">
                        <?= form_error('time_start', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="time" class="form-control" id="time_end" name="time_end" placeholder="Time end" value="<?= set_value('time_end'); ?>">
                        <?= form_error('time_end', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="type" id="type">
                            <option>Type</option>
                            <option>Default</option>
                            <option>Stages</option>
                            <option>Classroom</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="classroom" name="classroom" placeholder="Classroom">
                        <?= form_error('classroom', '<small class="text-danger pl-3">', '</small>'); ?>
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