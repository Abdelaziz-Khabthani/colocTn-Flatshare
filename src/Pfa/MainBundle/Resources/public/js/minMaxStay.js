$(document).ready(function() {
	if (('[id ^=pfa_mainbundle_][id $=_maximumStay]')){
	
	var n = parseInt(($('[id ^=pfa_mainbundle_][id $=_minimumStay]').val()));
	
	for (var i = 1; i <n; i++) {
		$('[id ^=pfa_mainbundle_][id $=_maximumStay] option[value="' + i + '"]').remove();
	};

	$('[id ^=pfa_mainbundle_][id $=_maximumStay]').selectpicker('refresh');
	$('[id ^=pfa_mainbundle_][id $=_maximumStay]').selectpicker('render');


	$('[id ^=pfa_mainbundle_][id $=_minimumStay]').change(function(){
		$('[id ^=pfa_mainbundle_][id $=_maximumStay]').empty();

		var total = parseInt(($('[id ^=pfa_mainbundle_][id $=_minimumStay]').val()));
		for (var i = total; i <=12; i++) {
			$('[id ^=pfa_mainbundle_][id $=_maximumStay]').append('<option value="'+ i +'">'+ i +'</option>')
		};
		$('[id ^=pfa_mainbundle_][id $=_maximumStay]').append('<option value="0">Le maximum possible</option>');

		$('[id ^=pfa_mainbundle_][id $=_maximumStay]').selectpicker('refresh');
		$('[id ^=pfa_mainbundle_][id $=_maximumStay]').selectpicker('render');
	});
	}
});