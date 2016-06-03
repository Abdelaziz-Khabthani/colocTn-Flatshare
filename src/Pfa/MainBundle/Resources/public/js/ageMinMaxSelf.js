$(document).ready(function() {
	if (('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax]')){
	
	var n = parseInt(($('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMin]').val()));
	
	for (var i = 1; i <n; i++) {
		$('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax] option[value="' + i + '"]').remove();
	};

	$('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax]').selectpicker('refresh');
	$('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax]').selectpicker('render');
}

	$(document).on('change', '[id ^=pfa_mainbundle_][id $=_selfPreference_ageMin]', function() {
		$('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax]').empty();

		var total = parseInt(($('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMin]').val()));
		for (var i = total; i <=40; i++) {
			$('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax]').append('<option value="'+ i +'">'+ i +'</option>')
		};

		$('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax]').selectpicker('refresh');
		$('[id ^=pfa_mainbundle_][id $=_selfPreference_ageMax]').selectpicker('render');
	});
});