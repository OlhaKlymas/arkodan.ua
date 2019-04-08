/* Article FructCode.com */
$( document ).ready(function() {
	$("#btn").click(
		function(){
			sendAjaxForm('result_form', 'ajax_form', 'order.php');
			return false; 
		}
		);
	$("#btnEnd").click(
		function(){
			sendAjaxForm('result_form_end', 'ajax_form_end', 'order.php');
			return false; 
		}
		);
});

function sendAjaxForm(result_form, ajax_form, url) {
	$('#ajax_form_end').hide(500);
	$('#ajax_form').hide(500);
	$.ajax({
		url:     'order.php', //url страницы (action_ajax_form.php)
		type:     "POST", //метод отправки
		dataType: "html", //формат данных
		data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
		success: function() { //Данные отправлены успешно
			$('#result_form').html('Отлично!<br>Ваша заявка принята<br><input type="button" id="btnOk" value="Ок" onclick="PopUpHideOffer()" />').show(500);
			$('#result_form_end').html('Отлично!<br>Ваша заявка принята').show(500);
		},
		error: function() { // Данные не отправлены
			$('#result_form_end').html('Ошибка. Данные не отправлены.<br><input type="button" id="btnOk" value="Повторить"  onclick="PopUpShowForm()" />').show(500);
			$('#result_form').html('Ошибка. Данные не отправлены.<br><input type="button" id="btnOk" value="Повторить"  onclick="PopUpShowForm()" />').show(500);
		}
	});
}

	function PopUpShowForm(){
		$("#ajax_form_end").show(500);
		$("#result_form_end").hide(500);
		$("#ajax_form").show(500);
		$("#result_form").hide(500);
	}