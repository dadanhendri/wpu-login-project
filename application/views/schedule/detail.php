<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div> -->

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <div class="flash-data-warning" data-flashdata="<?= $this->session->flashdata('warning'); ?>"></div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    Header
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $schedule['title']; ?></h5>
                    <p class="card-text"><?= $schedule['date']; ?></p>
                    <p class="card-text"><?= $schedule['time_start']; ?></p>
                    <p class="card-text"><?= $schedule['time_end']; ?></p>
                    <!-- <p class="card-text"><small class="text-muted">Member since <?= date('d M Y', $schedule['date_created']); ?></small></p> -->

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->