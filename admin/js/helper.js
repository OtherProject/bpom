function autoLocation(name,dest){  
            //get the id  
            var idLocation = $('#'+name).val();  
			if(idLocation==''){
				$('#'+dest)
					.find('option')
					.remove()
					.end()
				;
			}
            //use ajax to run the check
			if(idLocation != 0)
			{
				$.post(basedomain+"home/ajax", { idLocation: idLocation},  
					function(data){
					var locType = $('#'+dest);
					$('#'+dest)
						.find('option')
						.remove()
						.end()
					;
					locType.append("<option value=''>--</option>")
					var selected="";
					for(i=0;i<data.length;i++){
						locType.append("<option value='" + data[i].kode_wilayah+ "_"+ data[i].nama_wilayah +"' "+selected+">" + data[i].nama_wilayah + "</option>")
					}
				}, "JSON");
			}
    }

$(document).on('click', '.deleteImageArticle', function(){

	var iddata = $(this).attr('data-value');

	$.post(
		basedomain+'article/updateImage',
		{param:1, id:iddata}, 
		function(data){

			if (data.status==true){
				alert('Sukses update data');
			} else {
				alert('Gagal update data');
			}
			location.reload();
	},"JSON")
})
