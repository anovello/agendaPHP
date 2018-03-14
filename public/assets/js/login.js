$('#entrar').click(function(){
    var email = ($('#inputEmail').val()).trim(),
        password = ($('#inputPassword').val()).trim(),
        error = false;

    if (email === '')
    {
        $('#inputEmail').addClass('is-invalid');
        error = true;
    } else {
        $('#inputEmail').removeClass('is-invalid');
    }

    if (password === '')
    {
        $('#inputPassword').addClass('is-invalid');
        error = true;
    } else {
        $('#inputPassword').removeClass('is-invalid');
    }

    if (!error)
    {
        $.ajax({
            url: url + "api/user/login",
            type: 'GET',
            data:{
                'email': email,
                'password': password
            }
        }).done(function(res) {
            var data = JSON.parse(res);
            
            if (data.status === true)
            {
                window.location = url+'home';
            } else {
                swal("Hum!", "Login ou senha inválidos!", "error");
            }
        });
    }
    
});

$('#create').click(function(){
    limpar();
});

function limpar()
{
    $('.modal-create').val('');
    $('.name-cad-req').css('display', 'none');
    $('.email-cad-req').css('display', 'none');
    $('.email-cad-inv').css('display', 'none');
    $('.email-cad-cad').css('display', 'none');

    $('.password-cad-req').css('display', 'none');

    $('.pass-conf-req').css('display', 'none');
    $('.pass-conf-dif').css('display', 'none');
}

$('#save').click(function(){
    var email = ($('#email-create').val()).trim();
    
    if (validate())
    {
        $.ajax({
            url: url + "api/user/getMail",
            type: 'GET',
            data:{
                email: email
            }
        }).done(function(res) {
            var data = JSON.parse(res);
                        
            if (data.status === true)
            {
                if (data.email === false){
                    $('.email-cad-cad').css('display', 'none');
                    save();
                }else {
                    $('.email-cad-cad').css('display', 'block');
                }
            }
        });
    }

});

function validate()
{
    var error = false,
        name = ($('#name-create').val()).trim(),
        email = ($('#email-create').val()).trim(),
        pass = ($('#password-create').val()).trim(),
        conf = ($('#conf-senha').val()).trim();
    
    if (email === '')
    {
        $('.email-cad-req').css('display', 'block');
        error = true;
    } else {

        $('.email-cad-req').css('display', 'none');

        if(validateEmail(email))
        {
            $('.email-cad-inv').css('display', 'none');
        } else {
            $('.email-cad-inv').css('display', 'block');
            error = true;
        }
    }

    if (name === '')
    {
        $('.name-cad-req').css('display', 'block');
        error = true;
    } else {
        $('.name-cad-req').css('display', 'none');
    }

    if (pass === '')
    {
        $('.password-cad-req').css('display', 'block');
        error = true;
    } else {
        $('.password-cad-req').css('display', 'none');
    }

    if (conf === '')
    {
        $('.pass-conf-req').css('display', 'block');
        error = true;
    } else {

        $('.pass-conf-req').css('display', 'none');
        if (conf !== pass)
        {
            $('.pass-conf-dif').css('display', 'block');
            error = true;
        } else {
            $('.pass-conf-dif').css('display', 'none');
        }
    }

    return !error;
}

function save()
{
    var name = ($('#name-create').val()).trim(),
        email = ($('#email-create').val()).trim(),
        pass = ($('#password-create').val()).trim(),
        conf = ($('#conf-senha').val()).trim();
        
    $.ajax({
        url: url + "api/user/create",
        type: 'POST',
        data:{
            'email': email,
            'name': name,
            'password': pass,
            'password-conf': conf
        }
    }).done(function(res) {
        var data = JSON.parse(res);

        if (data.status === true)
        {
            $('#modalCadastro').modal('toggle');
            swal("Usuário criado com sucesso!", "Utilize o login e senha.", "success");
        } else {
            swal("Erro!", "Ocorreu algo inesperado, tente novamente mais tarde!", "error");
        }
    });
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}
