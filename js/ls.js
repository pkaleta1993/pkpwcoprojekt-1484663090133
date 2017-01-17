$(document).ready(function(e){
	
	var htmlcp = $(".kt").html();
	
	$("#lsearch").keyup(function()
	{
		
		$("#addlshere").show();
		
		var x = $("#lsearch").val();
		
		if (x.length > 2)
		{
			
			$.ajax(
			{
				type:'GET',
				url:'livesrch.php',
				data:'q='+x,
				success:function(data)
				{
					$("#addlshere").html(data);
				},
			
			});
		} else {
			
			
			
			$('#kt').load(document.URL +  ' #kt');
			$('.modal').load(document.URL +  ' .modal');
		
		}
	});
});