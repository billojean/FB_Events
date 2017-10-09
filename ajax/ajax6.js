$( document ).ready(function() {
$('#button4').click(function(){
	var search = $('#startdate').val();
	var search2 = $('#untildate').val();
	
	       $.ajax( {
	url: 'search_date.php',
	data: {startdate:search,untildate:search2},
	success: function(data){

	$('#content').html(data);
	}
});
           
});
});