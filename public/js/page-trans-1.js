$(document).ready(function(){
    var form = $('#form-1');
    var btn_save = form.find('btn-save');

    var submit_form = function(){
        var data = form.serialize();
        var url = form.attr('action');

        btn_save.prop('disabled', true);
        btn_save.html('Saving Data ...');

        $.ajax({
            method: 'post',
            url: url,
            data: data,
            success: function(resp)
            {
                swal({
                    title: 'Berhasil',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                })
                .then(function(){
                    document.location.reload();
                });
            },
            error: function(err)
            {
                var err_body = err.responseText;
                console.log(err);
            }
        });
    };

    form.on('submit', function(ev){
        ev.preventDefault();

        submit_form();
    });
});