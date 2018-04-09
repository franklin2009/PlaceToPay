$(document).ready(function() {
	$('#btn-form-pse').on('click', function(e) {
		e.preventDefault();
		if (!$('#form-pse').smkValidate()) {
				$.smkAlert({
						text : ' Debe Seleccionar los campos ...!',
						type : 'danger',
						position : 'top-center',
						time : 6
					});
			} else{
				$('#form-pse').submit();
			}
	});
	
	
});