<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center">Multiple Inline Insert</h2>
            <div align="left">
                <button type="button" class="btn btn-primary btn-sm" name="daftar" id="daftar">Daftar</button>
                <button type="button" class="btn btn-info btn-sm" name="save" id="save">Simpan</button>
                <button type="button" class="btn btn-warning btn-sm" name="edit" id="edit">Edit</button>
                <button type="button" class="btn btn-danger btn-sm" name="delete" id="delete">Delete</button>
                <button type="button" class="btn btn-success btn-sm" name="print" id="print">Print</button>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover table-sm " id="crud_table">
                    <thead class="text-center">
                        <tr>
                            <th width="10%">Kode Obat</th>
                            <th width="30%">Nama Obat</th>
                            <th width="10%">Harga</th>
                            <th width="45%">Keterangan</th>
                            <th width="50%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td contenteditable="true" class="kode_obat text-center"></td>
                            <td contenteditable="true" class="nama_obat"></td>
                            <td contenteditable="true" class="harga_obat text-right"></td>
                            <td contenteditable="true" class="keterangan_obat"></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <!-- <div class="float-right">
                    <button type="button" class="btn btn-success btn-sm" name="add" id="add">+</button>
                </div> -->
                <div id="inserted_item_data"> </div>
            </div>
        </div>
    </div>
</div>