$('#save').click(function(){

    var error = false,
        name = $('#name').val().trim(),
        pass = $('#password').val().trim(),
        pass_conf = $('#conf-password').val().trim();

    if (name === '')
    {
        $('#name').addClass('is-invalid');
        error = true;
    } else {
        $('#name').removeClass('is-invalid');
    }

    if (pass_conf !== pass)
    {
        $('#conf-password').addClass('is-invalid');
        $('#password').addClass('is-invalid');
        error = true;
    } else {
        $('#conf-password').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
    }
    
    if (pass === '')
    {
        $('#password').addClass('is-invalid');
        error = true;
    } else {
        $('#password').removeClass('is-invalid');
    }
    

    if (!error)
    {
        save();
    }
});

function save()
{
    var name = ($('#name').val()).trim(),
        pass = ($('#password').val()).trim(),
        passconf = ($('#conf-password').val()).trim();

    $.ajax({
        url: url + "api/user/update",
        type: 'POST',
        data: {
            'name': name,
            'password': pass,
            'password-conf': passconf
        }
    }).done(function(res) {
        var data = JSON.parse(res);
        
        if (data.status === true)
        {
            swal("Sucesso!", "Usuário atualizado com sucesso.", "success");
            $('#password').val('');
            $('#conf-password').val('');
        } else {
            swal("Erro!", "Erro ao atualizar o usuário.", "error");
        }
    });
}

get();

function get()
{
    $.ajax({
        url: url + "api/user/get",
        type: 'GET'
    }).done(function(res) {
        var data = JSON.parse(res);

        if (data.status === true)
        {
            $('#email').val(data.user.email);
            $('#name').val(data.user.name);
        }
    });
}