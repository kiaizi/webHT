$(document).ready(function(){ 

		$('#btn_export_excel').click(function(e){	
	   			e.preventDefault();
				 window.location.href = "module/export_office_excel/list/index.php";
				
				
				
	});
	$('#btn_export_excel2').click(function(e){	
	   			e.preventDefault();
				 window.location.href = "module/export_office_excel/list/index.php";
				
				
				
	});
	$('#btn_export_excel3').click(function(e){	
	   			e.preventDefault();
				 window.location.href = "module/export_office_excel/list/index.php";
				
				
				
	});

$('#btn_import_office_data_csv').click(function(e){	
	   			e.preventDefault();
				$('#upload_office_data_csv').val('');
				var file_import_office_data_excel = $('.file_import_office_data_excel').val();
				
				if(file_import_office_data_excel == '' || getFileExtension(file_import_office_data_excel) != 'xls'){
					 openDialog($('#DIALOG_TITLE').val(),"請上載 .xls ");
				}else{
					$('#upload_office_data_csv').val('1');
					start_loading();
					document.frm_this_page.submit();
					
					
				}
				
				
				
	});
	
	
	
	
	
	

}); 


function getFileExtension(file) {
    var extension = file.substr( (file.lastIndexOf('.') +1) );
	return extension.toLowerCase();
	/*
	
    switch(extension) {
        case 'jpg':
        case 'png':
        case 'gif':
            alert('was jpg png gif');  // There's was a typo in the example where
        break;                         // the alert ended with pdf instead of gif.
        case 'zip':
        case 'rar':
            alert('was zip rar');
        break;
        case 'pdf':
            alert('was pdf');
        break;
        default:
            alert('who knows');
    }
	*/
};


