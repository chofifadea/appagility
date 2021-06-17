$(document).ready(function(){

    var modal = $('#modal-form1');
    var form_modal = modal.find('#form-input');
    var btn_add = $('#btn-add');
    var btn_close_modal = modal.find('#btn-close');
    var btn_cancel_modal = modal.find('#btn-cancel');
    var btn_save_modal = modal.find('#btn-save');
    var err_msg_modal = modal.find('#err-msg');
    var mytable = $('#table-dt');

    var crud_submit_form = function()
    {
        var data = form_modal.serialize();
        var url = form_modal.attr('action');
        // var is_new = form_modal.attr('is-new');
        btn_cancel_modal.prop('disabled', true);
        btn_save_modal.prop('disabled', true);
        btn_close_modal.prop('disabled', true);
        
        btn_save_modal.html('Menyimpan....');

        err_msg_modal.hide();

        $.ajax({
            method: 'post',
            url: url,
            data: data,
            success: function(resp)
            {
                document.location.reload();
            },
            error: function(err)
            {
                console.log('err submit form', err);

                btn_cancel_modal.prop('disabled', false);
                btn_save_modal.prop('disabled', false);
                btn_close_modal.prop('disabled', false);

                btn_save_modal.html('Simpan');

                var err_msg = err.responseText;
                if(err_msg == '')
                {
                    err_msg = err.statusText;
                }

                err_msg_modal.html(err_msg);
                err_msg_modal.show();
            }
        });
    }

    var show_form_tambah = function()
    {
        console.log('open modal');
        // var modal = $('#modal-form1');
        modal.modal('show');
        err_msg_modal.hide();
        // form_modal.attr('is-new', '0');
        form_modal.attr('action', form_modal.attr('create-action'));
        
        setTimeout(function(){
            modal.find('#nama').focus();
        }, 500);
    }

    var dialog_edit = function(btn)
    {
        show_form_tambah();
        form_modal.trigger('reset');
        // form_modal.attr('is-new', '1');
        form_modal.attr('action', form_modal.attr('update-action'));

        btn = $(btn);
        var tr = btn.closest('tr');
        var tds = tr.children();
        $.each(tds, function(index, td){
            td = $(td);
            var col_name = td.attr('col-name');
            
            if(col_name !== undefined)
            {
                var content = td.html();
                form_modal.find('#' + col_name).val(content);
            }
        });
        var data_id = btn.attr('data-id');
        form_modal.find('#id').val(data_id);
    }

    form_modal.on('submit', function(ev){
        ev.preventDefault();
        crud_submit_form();
    });

    btn_add.on('click', show_form_tambah);
    btn_close_modal.on('click', function(){
        modal.modal('hide');
    });
    btn_cancel_modal.on('click', function(){
        modal.modal('hide');
    });
    btn_save_modal.on('click', crud_submit_form);

    var list_btn_edit = mytable.find('.btn-edit');
    // console.log('btn edit', list_btn_edit);
    // list_btn_edit.forEach(function(btn_edit){
    //     dialog_edit(btn_edit);
    // });
    $.each(list_btn_edit, function(index, btn_edit){
        $(btn_edit).on('click', function(){
            dialog_edit(btn_edit);
        });
    });

    var list_btn_hapus = mytable.find('.btn-hapus');
    // list_btn_hapus.forEach(function(btn_hapus){
    //     dialog_hapus(btn_hapus);
    // });
});

