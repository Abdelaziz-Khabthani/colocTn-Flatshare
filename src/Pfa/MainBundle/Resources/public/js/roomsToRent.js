$(document).ready(function() {
	var n = parseInt(($('#pfa_mainbundle_room_numberOfTotalRooms').val()));
	
	for (var i = n+1; i <=10; i++) {
		$('#pfa_mainbundle_room_numberOfRoomsToRent option[value="' + i + '"]').remove();
	};

	$('#pfa_mainbundle_room_numberOfRoomsToRent').selectpicker('refresh');
	$('#pfa_mainbundle_room_numberOfRoomsToRent').selectpicker('render');


	$('#pfa_mainbundle_room_numberOfTotalRooms').change(function(){
		$('#pfa_mainbundle_room_numberOfRoomsToRent').empty();

		var total = parseInt(($('#pfa_mainbundle_room_numberOfTotalRooms').val()));

		for (var i = 1; i <=total; i++) {
			$('#pfa_mainbundle_room_numberOfRoomsToRent').append('<option value="'+ i +'">'+ i +'</option>')
		};

		$('#pfa_mainbundle_room_numberOfRoomsToRent').selectpicker('refresh');
		$('#pfa_mainbundle_room_numberOfRoomsToRent').selectpicker('render');
	});

});