$(document).ready(function(){

    var dialog_approve = function(btn)
    {
        swal({
            icon: 'warning',
            title: 'Approve Pallet Masuk',
            text: 'Anda akan menyetujui pallet masuk?',
            buttons: {
                ya:{
                    text: 'Ya',
                    value: 1,
                    className: 'btn btn-primary'
                },
                tidak: {
                    text: 'Batal',
                    value: 0,
                    className: 'btn btn-secondary'
                }
            }
        })
        .then(function(val){
            if(val == 1)
            {
                swal({icon: 'info', title: 'Memproses...', buttons: false});

                var id = btn.attr('data-id');

                $.ajax({
                    method:'post',
                    url: base_url + '/inbox/approve',
                    data: {id: id},
                    success: function(resp)
                    {
                        swal({icon:'success', title:'Data berhasil di-approve'})
                            .then(function(){
                                btn.closest('div.inbox-col').remove();
                            });
                    },
                    error: function(err)
                    {
                        swal({icon: 'error', title: 'Terjadi kesalahan'});
                    }
                });
            }
        });
    }

    var dialog_reject = function(btn)
    {

    }

    var list_btn_approve = $('.btn-approve');
    var list_btn_reject = $('.btn-reject');

    $.each(list_btn_approve, function(index, btn){
        btn = $(btn);
        btn.on('click', function(){
            dialog_approve(btn);
        });
    });
    $.each(list_btn_reject, function(index, btn){
        btn = $(btn);
        btn.on('click', function(){
            dialog_reject(btn);
        });
    });
});