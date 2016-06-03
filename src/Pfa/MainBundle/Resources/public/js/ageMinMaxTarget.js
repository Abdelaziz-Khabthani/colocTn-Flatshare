$(document).ready(function() {
	if (('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax]')){
	
	var n = parseInt(($('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMin]').val()));
	
	for (var i = 1; i <n; i++) {
		$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax] option[value="' + i + '"]').remove();
	};

	$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax]').selectpicker('refresh');
	$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax]').selectpicker('render');

	$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMin]').change(function(){
		$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax]').empty();

		var total = parseInt(($('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMin]').val()));
		for (var i = total; i <=40; i++) {
			$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax]').append('<option value="'+ i +'">'+ i +'</option>')
		};

		$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax]').selectpicker('refresh');
		$('[id ^=pfa_mainbundle_][id $=_targetPreference_ageMax]').selectpicker('render');
	});
	}
});