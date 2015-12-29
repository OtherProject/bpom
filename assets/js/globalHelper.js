
$(document).ready(function() {

    // $(".cd-popup-trigger").trigger('click');
    var loginoptions = {
            dataType:  'json',  
            beforeSubmit: function(data) { 
                
                var loading = "<img src='"+basedomain+"assets/images/loading.gif' width='40%'/>";
                 // loading += "<p>Please Wait ...</p>";
                // $('#imgupload').css('height','100%');
                $('.popuptext').html(loading);
                $(".cd-popup-trigger").trigger('click');
                
            },
            success : function(data) {

                if(data.status==true){
                    if (data.flag==true){
                        redirect(basedomain+"account/pelaporan");
                    }else{
                        redirect(basedomain+"account");
                    }
                              
                } else {
                    $('.popuptext').html("Username atau Password salah");
                    
                }
                         
            }
        };  

    $("#loginForm").ajaxForm(loginoptions);

    var resetoptions = {
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
                    $('.popuptext').html("Silahkan verifikasi email anda untuk melanjutkan");            
                } else {
                    $('.popuptext').html("Email tidak terdaftar");
                    
                }
                         
            }
        };  

    $("#resetakun").ajaxForm(resetoptions);

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

function readURLpose(input, target) {
    console.log(input);
    if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#'+target).attr('src', e.target.result);
            $('#'+target).attr('width', '100px');
            // $('#'+target).attr('height', '200px');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

/* account pelaporan kemasan */

$(document).on('change', '#lokasipabrik', function(){


      var id = $(this).val();

      $.post(basedomain+'account/ajaxPabrik',{kode_wilayah:id}, function(data){

        var html = "";

        if (data.status==true){
          
          var hasil = data.res;
          $('.noNPPBKC').val(hasil.pabrik.noNPPBKC);
          $('.namaJalan').val(hasil.pabrik.namaJalan);
          $('.kecamatan').val(hasil.pabrik.kecamatan);
          $('.noFax').val(hasil.ind.noFax);
          $('.namaPimpinan').val(hasil.ind.namaPimpinan);
          $('.industriID').val(hasil.ind.id);
          $('.pabrikID').val(hasil.pabrik.id);
          
        }else{
          $('.noNPPBKC').val('');
          $('.namaJalan').val('');
          $('.kecamatan').val('');
          $('.noFax').val('');
          $('.namaPimpinan').val('');
          $('.industriID').val('');
          $('.pabrikID').val('');
        } 
        
      }, "JSON")  

    })

    $(document).on('click', '.tambah_data_kemasan', function(){
      
        $('#info_produsen').css('display','block');
        $('#info_produk').css('display','block');
        
    }) 
    $(document).on('click', '.cancel_kemasan', function(){
        $('#info_produsen').css('display','none');
          $('#info_produk').css('display','none');
    }) 

$(document).ready(function(){
  $("#search-box").keyup(function(){
    $.ajax({
    type: "POST",
    url: basedomain+"account/ajax_getMerek",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
      $("#suggesstion-box").show();
      $("#suggesstion-box").html(data);
      $("#search-box").css("background","#FFF");
    }
    });
  });
});

function selectProduct(data, val, jenis) {

  if (jenis == "SKM") $(".jenis").val(1);
  if (jenis == "SKT") $(".jenis").val(2);
  if (jenis == "SPM") $(".jenis").val(3);
  if (jenis == "CRT") $(".jenis").val(4);
  if (jenis == "TIS") $(".jenis").val(5);
  if (jenis == "KLM") $(".jenis").val(6);
  
  $("#hiddendata").val(val);
  $("#search-box").val(data);
  $("#suggesstion-box").hide();
}

$(document).on('change', '#fotoDepan', function(){
    readURLpose(this, "previewDepan");
});
$(document).on('change', '#fotoBelakang', function(){
    readURLpose(this, "previewBelakang");
});
$(document).on('change', '#fotoKanan', function(){
    readURLpose(this, "previewKanan");
});
$(document).on('change', '#fotoKiri', function(){
    readURLpose(this, "previewKiri");
});
$(document).on('change', '#fotoAtas', function(){
    readURLpose(this, "previewAtas");
});
$(document).on('change', '#fotoBawah', function(){
    readURLpose(this, "previewBawah");
});
$(document).on('change', '#suratPengantar', function(){
    readURLpose(this, "previewPengantar");
});

/* account pelaporan nikotin */

$(document).on('change', '#lab', function(){


      var id = $(this).val();

      $.post(basedomain+'account/ajaxLab',{kode_wilayah:id}, function(data){

        var html = "";

        if (data.status==true){
          
          var hasil = data.res;
          $('.alamat').val(hasil.alamat);
          $('.penanggungjawab').val(hasil.penanggungjawab);
          
          
          
        }else{
          $('.alamat').val('');
          $('.penanggungjawab').val('');
          
        } 
        
      }, "JSON")  

    })

    $(document).on('click', '.tambah_data_kemasan', function(){
      
        $('#info_produsen').css('display','block');
        $('#info_lab').css('display','block');
        $('#info_sample').css('display','block');
        $('#info_pengujian').css('display','block');
        
        
    }) 
    $(document).on('click', '.cancel_nikotin', function(){
      $('#info_produsen').css('display','none');
      $('#info_lab').css('display','none');
      $('#info_sample').css('display','none');
      $('#info_pengujian').css('display','none');
    }) 

$(document).on('click', '.tambah_lab', function(){
  
  var html = "";
  html += "<div class=''>";
  html += "   <div class='form-group'>";
  html += "      <label for='text-input'>Nama Lab</label>";
  html += "      <input type='text' name='nama' class='nama_lab_baru' value='' data-required='true' />";
  html += "   </div>";
  html += "</div>";
  html += "<div class=''>";
  html += "   <div class='form-group'>";
  html += "      <label for='text-input'>Alamat Lab</label>";
  html += "      <input type='text' name='alamat' class='alamat_lab_baru' value='' data-required='true' />";
  html += "   </div>";
  html += "</div>";
  html += "<div class=''>";
  html += "   <div class='form-group'>";
  html += "      <label for='text-input'>Penanggung Jawab Lab</label>";
  html += "      <input type='text' name='penanggungjawab' class='penanggungjawab_lab_baru' value='' data-required='true' />";
  html += "      <input type='button' name='submit' value='Simpan' class='btn btn-save simpan_lab_baru'/>";
  html += "   </div>";
  html += "</div>";

  $('.popupcontent').html(html);
  $(".cd-popup-trigger").trigger('click'); 
  
})

$(document).on('click', '.simpan_lab_baru', function(){
  
  var nama = $('.nama_lab_baru').val();
  var alamat = $('.alamat_lab_baru').val();
  var pj = $('.penanggungjawab_lab_baru').val();
  $.post(basedomain+'account/ajaxLab',{param:1, nama:nama, alamat:alamat, penanggungjawab:pj}, function(data){

        var html = "";

        if (data.status==true){
          $('.popuptext').html("Data lab sudah ditambahkan");
        }else{
          $('.popuptext').html("Gagal menyimpan data");
        }
        setTimeout(function(){ redirect(basedomain + "account/pelaporan_nikotin"); }, 2000); 
        
      }, "JSON")  
  
})