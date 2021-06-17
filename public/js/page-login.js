$(document).ready(function(){
    $('#form-login').on('submit', function(ev){
        ev.preventDefault();
        coba_login();
    });
});
function coba_login()
{
    var form = $('#form-login');
    var data = form.serialize();

    var btn_login = $('#btn-login');
    btn_login.prop('disabled', true);
    btn_login.html('Sedang Login....');

    var err_el = $('#error-msg');

    err_el.hide();

    // console.log('form data', data);

    $.post({
        url: base_url + '/auth/login',
        method: 'post',
        data: data,
        success: function(res){
            console.log('res', res);
            // btn_login.prop('disabled', false);
            // btn_login.html('Login');
            document.location = base_url + '/dashboard';
        },
        error: function(err, err2){
            console.log('login error', err, err2);
            btn_login.prop('disabled', false);
            btn_login.html('Login');
            var res = err.responseText;
            res = JSON.parse(res);
            var errors = res.fields;

            var errmsg = '';
            for(var key in errors)
            {
                errmsg += errors[key];
            }

            var err_el = $('#error-msg');
            err_el.html(errmsg);
            err_el.show();
        }
    });
}