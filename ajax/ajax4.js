$( document ).ready(function() {
$('#button3').click(function(){
	var search = $('#search').val();
	       $.ajax( {
	url: 'search_category.php',
	data: 'search='+search,
	success: function(data){

	$('#content').html(data);
	}
});
           
});
});