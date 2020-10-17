$(function(){
    $('.tombolTambahSubMenu').on('click', function(){
        $('#subMenuModalLabel').html('Add Sub Menu');
        $('.modal-footer button[type=submit]').html('Add')
    });
    
    $('.tampilModalUbah').on('click', function(){
        $('#subMenuModalLabel').html('Update Sub Menu');
        $('.modal-footer button[type=submit]').html('Update')

        const id = $(this).data('id');
        $.ajax({
            url:'<?= base_url()."menu/getUbahSubMenu" ?>',
            data:{id : id},
            method:'post',
            // dataType:'json',
            success: function(data){
                console.log(data);
            }
        });
    });
});