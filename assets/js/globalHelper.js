
$(document).ready(function() {

    var uploadoptions = {
            dataType:  'json',  
            beforeSubmit: function(data) { 
                
                var loading = "<img src='"+basedomain+"assets/images/loading.gif' width='50px'/>";
                // $('#imgupload').css('height','100%');
                // $('#imgupload').html(loading);
                
            },
            success : function(data) {      

                if(data.status==true){
                    redirect(basedomain);                
                } else {
                    $(".loginStatus").html("Username atau Password salah");
                }
                         
            }
        };  

    $("#loginForm").ajaxForm(uploadoptions);

    
});

function submit_confirm(txt)
{
    var txt;
    if (txt) txt = txt;
    else txt = "Simpan data ?";
    var r = confirm(txt);
    if (r == true) {
        // do something
    } else {
        return false;
    }
}

function clog(data)
{
    console.log(data);
}

function redirect(data)
{
    window.location.href=data;
}