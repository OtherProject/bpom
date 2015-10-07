
$(document).ready(function() {


    var uploadoptions = {
            dataType:  'json',  
            beforeSubmit: function(data) { 
                
                var loading = "<img src='"+basedomain+"assets/images/loading.gif' width='50%'/>";
                 loading += "<p>Please Wait ...</p>";
                // $('#imgupload').css('height','100%');
                $('.popuptext').html(loading);
                $(".cd-popup-trigger").trigger('click');
                
            },
            success : function(data) {

                if(data.status==true){
                    redirect(basedomain);            
                } else {
                    $('.popuptext').html("Username atau Password salah");
                    
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