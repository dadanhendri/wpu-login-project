<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo base_url() . 'assets/js/popper.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/all.js' ?>"></script>
<!-- <script src="<?php echo base_url() . 'assets/js/my_script.js' ?>"></script> -->
<script>
    loadData();

    function loadData() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "home/ambilData" ?>',
            dataType: 'json',
            success: function(data) {
                console.log(data);
            }
        });
    }
    $('#daftar').click(function() {
        $('.kode_obat').focus();
    });

    var count = 1;
    $(document).on('keyup', '.keterangan_obat', function(e) {
        if (e.which === 13) {
            count = count + 1;
            let html_code = "<tr id='row" + count + "'>";
            html_code += "<td contenteditable='true' class='kode_obat text-center'></td>";
            html_code += "<td contenteditable='true' class='nama_obat'></td>";
            html_code += "<td contenteditable='true' class='harga_obat text-right '></td>";
            html_code += "<td contenteditable='true' class='keterangan_obat'></td>";
            html_code += "<td align='center'><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-sm remove'> - </button></td>";
            html_code += "</tr>";
            $('#crud_table').append(html_code);
            $('.kode_obat').focus();
        }
    });

    $(document).on('keyup', '.kode_obat', function(e) {
        if (e.which === 39) {
            $('.nama_obat').focus();
        }
    });

    $(document).on('keyup', '.nama_obat', function(e) {
        if (e.which === 39) {
            $('.harga_obat').focus();
        } else if (e.which === 37) {
            $('.kode_obat').focus();
        }
    });

    $(document).on('keyup', '.harga_obat', function(e) {
        if (e.which === 39) {
            $('.keterangan_obat').focus();
        } else if (e.which === 37) {
            $('.nama_obat').focus();
        }
    });

    $(document).on('keyup', '.keterangan_obat', function(e) {
        if (e.which === 37) {
            $('.harga_obat').focus();
        }
    });

    $('#save').click(function() {
        let kode_obat = [];
        let nama_obat = [];
        let harga_obat = [];
        let keterangan_obat = [];

        $('.kode_obat').each(function() {
            kode_obat.push($(this).text());
        });

        $('.nama_obat').each(function() {
            nama_obat.push($(this).text());
        });

        $('.harga_obat').each(function() {
            harga_obat.push($(this).text());
        });

        $('.keterangan_obat').each(function() {
            keterangan_obat.push($(this).text());
        });

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('home/tambah'); ?>",
            data: {
                kode_obat: kode_obat,
                nama_obat: nama_obat,
                harga_obat: harga_obat,
                keterangan_obat: keterangan_obat
            },
            success: function(data) {
                alert(data);
                $("td[contenteditable='true']").text('');
                for (var i = 2; i <= count; i++) {
                    $('tr#row' + i + '').remove();
                }
                loadData();
            }
        });

    });

    $(document).on('click', '.remove', function() {
        let delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });
</script>

</body>

</html>