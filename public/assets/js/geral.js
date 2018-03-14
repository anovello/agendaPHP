$('#end').click(function(){
    $.ajax({
        url: url + "api/user/logout",
        type: 'GET'
    }).done(function(res) {
        var data = JSON.parse(res);
        
        if (data.status === true)
        {
            window.location = url;
        }
    });
});