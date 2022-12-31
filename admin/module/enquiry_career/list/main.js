$(document).ready(function(){ 

	$('#btn_export_excel').click(function(e){	
	   			e.preventDefault();
				
				var other_var = '';
				
				other_var+='&search_create_date_from='+$('#search_create_date_from').val();
				other_var+='&search_create_date_to='+$('#search_create_date_to').val();
				other_var+='&search_by='+$('#search_by').val();
				other_var+='&search='+$('#search').val();
				
				
				 window.location.href = "module/export_enquiry_career_excel/list/index.php?c="+other_var;
				
				
				
	});
	
}); 


