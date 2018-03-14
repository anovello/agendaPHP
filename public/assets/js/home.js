var total = 0,
    search = '',
    page = 1,
    nextPage = 0;

$('#phone').mask('(00) 00000-0000');

get();

$('#add').click(function(){
    $('.modal-title').html('Cadastro'); 
    $('#modalCadastro').modal('toggle');
    clear();
});

$('#save').click(function()
{
    if(valid())
    {
        var data = {
            email: $('#email').val().trim()
        };

        if (parseInt($('#id').val()) !==  0)
        {
            data.id = parseInt($('#id').val());
        }
        
        $.ajax({
            url: url + "api/contact/getMail",
            type: 'GET',
            data:data
        }).done(function(res) {
            var data = JSON.parse(res);
            
            if (data.status === true)
            {
                if (data.email === false){
                    $('.email-cad').css('display', 'none');
                    save();
                }else {
                    $('.email-cad').css('display', 'block');
                }
            }
        });
    }
});

$('#search').keyup(function(e) {
    if (e.keyCode === 13){
        getSearch();
    }
});

$('.page-item').click(function(e){
    e.preventDefault();
    var type = $(this).data('ty');
    
    if (!$( this ).hasClass( "disabled" ))
    {
        if (type === 'next')
        {
            page = nextPage;
            get();
        } else {
            page = page - 1;
            get();
        }
        
    }
});

function del(param)
{
    swal({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Cancelar',
      }).then((result) => {

        if (result.value) {

            $.ajax({
                url: url + "api/contact/delete",
                type: 'POST',
                data:{
                    id: param
                }
            }).done(function(res) {
                var data = JSON.parse(res);
                
                if (data.status === true)
                {
                    swal(
                        'Deletado!',
                        'Contato excluído com sucesso.',
                        'success'
                    );
                    get();
                } else {
                    swal("Erro!", "Erro ao excluír o contato!", "error");
                }
            });
          
        }
      })
      
}

function visible(param)
{
    $.ajax({
        url: url + "api/contact/get",
        type: 'GET',
        data:{
            id: param
        }
    }).done(function(res) {
        var data = JSON.parse(res);
        
        if (data.status === true)
        {
            swal({
                title: '<u>Contato</u>',
                html:
                    '<br/>'+
                    '<b>Nome: </b> '+data.contact.name+'<br/>' +
                    '<b>E-mail: </b> '+data.contact.email+'<br/>' +
                    '<b>Telefone: </b> '+data.contact.phone+'<br/>' ,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> OK!',
            });
        } else {
            swal("Erro!", "Contato não encontrado!", "error");
        }
    });

    swal({
        title: '<u>Contato</u>',
        html:
            '<br/>'+
            '<b>Nome: </b> Angelo<br/>' +
            '<b>E-mail: </b> Angelo@hotmail.com<br/>' +
            '<b>Telefone: </b> (14) 99700-7732<br/>' ,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText:
            '<i class="fa fa-thumbs-up"></i> OK!',
    })
}
  
function getSearch(){
    search = $('#search').val().trim();
    page = 1;
    get();
}

function edit(id){
   $('.modal-title').html('Edição'); 
   clear();

   $.ajax({
        url: url + "api/contact/get",
        type: 'GET',
        data:{
            id: id
        }
    }).done(function(res) {
        var data = JSON.parse(res);
        
        if (data.status === true)
        {
            $('#name').val(data.contact.name);
            $('#email').val(data.contact.email);
            $('#phone').val(data.contact.phone);
            $('#id').val(data.contact.id);
        } else {
            swal("Erro!", "Contato não encontrado!", "error");
        }
    });
   $('#modalCadastro').modal('toggle');
};

function save()
{
    var name = ($('#name').val()).trim(),
        email = ($('#email').val()).trim(),
        phone = ($('#phone').val()).trim(),
        id = parseInt($('#id').val()),
        data = {
            'email': email,
            'name': name,
            'phone': phone
        };

    if (id !== 0)
    {
        data.id = id;
    }
    
    $.ajax({
        url: url + "api/contact/"+ (id === 0? 'create': 'update'),
        type: 'POST',
        data:data
    }).done(function(res) {
        var data = JSON.parse(res);

        if (data.status === true)
        {
            $('#modalCadastro').modal('toggle');
            var text = id === 0 ? "cadastrado": "alterado";
            swal("Sucesso!", "Contato "+text+" com sucesso.", "success");
            get();
        } else {
            swal("Erro!", "Ocorreu algo inesperado, tente novamente mais tarde!", "error");
        }
    });
}

function valid()
{
    var email = ($('#email').val()).trim(),
        name = $('#name').val().trim(),
        phone = $('#phone').val().trim(),
        error = false;

    if (name === '')
    {
        $('#name').addClass('is-invalid');
        error = true;
    } else {
        $('#name').removeClass('is-invalid');
    }

    if (email === '')
    {
        $('#email').addClass('is-invalid');
        error = true;
    } else {

        if(validateEmail(email))
        {
            $('#email').removeClass('is-invalid');
        } else {
            $('#email').addClass('is-invalid');
            error = true;
        }
    }

    if (phone === '')
    {
        $('#phone').addClass('is-invalid');
        error = true;
    } else {
        var pattern = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        
        if(pattern.test(phone))
        {
            $('#phone').removeClass('is-invalid');
        } else {
            $('#phone').addClass('is-invalid');
            error = true;
        }
    }

    return !error;
}

function get()
{
    var data = {},
        html = '';

    if (page !== 1)
    {
        data.page = page;
    }

    if (page !== '')
    {
        data.search = search;
    }

    $.ajax({
        url: url + "api/contact/getAll",
        type: 'GET',
        data: data
    }).done(function(res) {
        var data = JSON.parse(res);
        nextPage = data.next_page;
        page = data.page;
        
        data.contacts.forEach(element => {
            html += '<tr>';
            html += '<td>'+element.id+'</td><td>'+element.name+'</td><td>'+element.email+'</td><td>'+element.phone+'</td>';
            html += '<td><button type="button" class="btn btn-outline-success" onclick="edit('+element.id+')"><i class="fa fa-edit"></i></button>&nbsp;';
            html += '<button type="button" class="btn btn-outline-primary" onclick="visible('+element.id+')"><i class="fa fa-eye"></i></button></button>&nbsp;';
            html += '<button type="button" class="btn btn-outline-danger" onclick="del('+element.id+')"><i class="fa fa-trash"></i></button></button></td>';
            html += '</tr>';
        });

        $('.tbody').empty();
        $('.tbody').prepend(html);
        
        if (page === 1)
        {
            $('.prev').addClass('disabled');
        } else {
            $('.prev').removeClass('disabled');
        }

        if (nextPage === page)
        {
            $('.next').addClass('disabled');
        } else {
            $('.next').removeClass('disabled');
        }
        
    });
}

function clear()
{
    $('#name').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#id').val(0);

    $('#name').removeClass('is-invalid');
    $('#email').removeClass('is-invalid');
    $('#phone').removeClass('is-invalid');
    $('.email-cad').css('display', 'none');
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}