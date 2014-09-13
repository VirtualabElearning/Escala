///////////////////////////// programado por Edwin Garzon: edwin.garzon@virtualab.co - contacto@webbost.net  /////////////////////////////////
$(function() {
// funcion para ordenar elementos de una tabla o lista
$("#dragx").sortable({
	helper: 'clone',
	placeholder: 'ui-state-highlight',
	start: function (e, ui) {

		var radio_checked= {};
		$('input[type="radio"]', this).each(function(){

			if($(this).is(':checked'))  {
                	//alert ( $(this).attr('id') );
                	radio_checked[$(this).attr('id')] = $(this).attr('id');
                }
                $(document).data('radio_checked', radio_checked);
            });
	}

// solo en caso que ordene y pare de ordenar, me mantiene los radio checkeados (error por defecto de la librerias)
}).bind('sortstop', function (event, ui) {
	var radio_restore = jQuery(document).data('radio_checked');
	for(radio in radio_restore){
		$('input[id="'+ radio +'"]').prop('checked', true);
		$('input[id="'+ radio +'"]').click();
	}

});


// evento guardar del boton las posibles respuestas de cualquier pregunta en especial
$('.btnguardar').click(function(event) {
	event.preventDefault();

	var tmp = $('#form_generator').serialize();

	jQuery.ajax({
		type: 'POST',
		url:'actividades/root/guardar_preguntas_coonrespuestas',
		data: 'envio=' + encodeURIComponent(tmp),

		ajaxSend:function(result){        
			console.log ("ajaxSend\n");

		},
		success:function(result){       
			console.log ("success\n");
			alert (result);
			window.parent.$.prettyPhoto.close();
		},
		complete:function(result){        
			console.log ("complete\n");
		},
		beforeSend:function(result){        
			console.log ("beforeSend\n");
		},
		ajaxStop:function(result){        
			console.log ("ajaxStop\n");
		}

	});

});

// evento para borrar una pregunta, visualmente borra los elementos para enviarlos al controlador y sepa que debe guardar
$(document).on('click', '.deleter_google-pregunta', function(event) {
	event.preventDefault();
	$(this).parent().parent().parent().remove();
});

// evento de clonar una rpegunta
$(document).on('click', '.clone_pregunta', function(event) {
	event.preventDefault();
// cambio los consecutivos que tiene la pregunta incluyendos los id's y los textos
$('.mipregunta').parent().last().append('<li class="mipregunta">'+$('#plantilla_pregunta').html()+'</li>');
$('.mipregunta').last().children().children('.custom_field').html('');
$('.mipregunta').last().children().children('h3').children('span').html( $('.mipregunta').length  );
$('.mipregunta').last().children().children('h3').children('input').val( $('.mipregunta').length  );

/// solo le agrega el boton eliminar cuando sea mayor a una pregunta (para que no borre la primera)
if (('.mipregunta').length>1)  {
	$('.mipregunta').last().children().children('h3').append('<a href="#" class="btn btn-xs btn-default deleter_google-pregunta"><i class="fa fa-times"></i></a>');
}

});

// borro pregunta 
$(document).on('click', '.deleter_google', function(event) {
	event.preventDefault();
	$(this).parent().remove();

});
// borro pregunta  (otro tipo de pregunta)
$(document).on('click', '.deleter_google-lista', function(event) {
	event.preventDefault();
	$(this).parent().remove();
});

// borro pregunta  (otro tipo de pregunta)
$(document).on('click', '.deleter_google-lista-option', function(event) {
	event.preventDefault();
	$(this).parent().remove();
});

/// clono pregunta (es una pregunta oculta para evitar clonar las existentes)
$(document).on('click', '.ghost-input', function(event) {
	event.preventDefault();

	if ($(this).parent().parent().children('.chk-inputs').length>0)  {
		$(this,' chk-inputs:eq(0)').parent().before('<div class="chk-inputs"><div style="float:left;"><label class="checkbox">'+$(this).parent().prev('.chk-inputs').children('div').children('label').html()+' </label></div><input type="text" name="txtop'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" id="txtop'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="form-control texter" placeholder="Opcion '+(Number($(this).parent().parent('.custom_field').children('.chk-inputs').length)+1)+'"> <input type="text" class="form-control retrotxtop" name="retrotxtop'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion '+(Number($(this).parent().parent('.custom_field').children('.chk-inputs').length)+1)+'"> <a href="#" class="btn btn-xs btn-default deleter_google"><i class="fa fa-times"></i></a> </div>');
	}

	else {
		$(this,' chk-inputs:eq(0)').parent().before('<div class="chk-inputs"><div style="float:left;"><label class="checkbox">'+$(this).parent().prev('label').html()+' </label></div><input type="text" name="txtop'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'" id="txtop'+Number( $(this).parent().parent().parent().children('h3').children('span').html() )+'" class="form-control texter" placeholder="">   <input type="text" class="form-control retrotxtop" name="retrotxtop'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion '+(Number($(this).parent().parent('.custom_field').children('.chk-inputs').length)+1)+'"> </div>');
	}

});

/// clono pregunta (es una pregunta oculta para evitar clonar las existentes)

$(document).on('click', '#lista-gost', function(event) {
	event.preventDefault();

	if ($(this).parent().parent().children('.lista-custom').length>0)  {
		$(this).parent().before('<div class="col-lg-7 lista-custom">  <label class="radio checklista"><input type="radio" id="inlineCheckbox1" name="oplista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="chekeador"></label>  <input type="text" name="lista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" id="lista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="form-control lista" value="Opcion '+Number(Number($(this).parent().parent().children('.lista-custom').length)+1)+'" placeholder=""> <input type="text" class="form-control retrolista" name="retrolista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion '+Number(Number($(this).parent().parent().children('.lista-custom').length)+1)+'"> <a href="#" class="btn btn-xs btn-default deleter_google-lista"><i class="fa fa-times"></i></a></div>');
	}

	else {
		$(this).parent().before('<div class="col-lg-7 lista-custom"> <label class="radio checklista"><input type="radio" id="inlineCheckbox1" name="oplista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="chekeador"></label>    <input type="text" name="lista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" id="lista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="form-control lista" value="Opcion '+Number(Number($(this).parent().parent().children('.lista-custom').length)+1)+'" placeholder=""> <input type="text" class="form-control retrolista" name="retrolista'+Number($(this).parent().parent().parent().children('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion '+Number(Number($(this).parent().parent().children('.lista-custom').length)+1)+'"> </div>');
	}

});

/// clono pregunta (es una pregunta oculta para evitar clonar las existentes)

$(document).on('click', '#lista-option-gost', function(event) {
	event.preventDefault();

	if ($(this).parent().parent().children('.radio-lista').length>0)  {
		$(this).parent().before(' <div class="radio-lista"> <div class="radio list-option-custom"><label><input type="radio" value="'+Number(Number($(this).parent().parent().children('.radio-lista').length)+1)+'" id="radios'+Number(  $(this).parent().parent().parent().children('h3').children('span').html() )+'" name="radios'+Number(  $(this).parent().parent().parent().children('h3').children('span').html() )+'[]"></label> </div><div class="col-lg-7 lista-option-custom"><input type="text" placeholder="" value="Opcion '+Number(Number($(this).parent().parent().children('.radio-lista').length)+1)+'" class="form-control lista-option" id="lista_option[]"  name="lista_option'+Number(  $(this).parent().parent().parent().children('h3').children('span').html() )+'[]">  <input type="text" class="form-control retroradios" name="retroradios'+Number(  $(this).parent().parent().parent().children('h3').children('span').html() )+'[]" class="form-control retroradios" placeholder="Retroalimentacion '+Number(Number($(this).parent().parent().children('.lista-custom').length)+1)+'"></div>    <a class="btn btn-xs btn-default deleter_google-lista-option" href="#"><i class="fa fa-times"></i></a> </div>');
	}

	else {
		$(this).parent().before('<div class="radio-lista"> <div class="radio list-option-custom"><label><input type="radio" value="'+Number(Number($(this).parent().parent().children('.radio-lista').length)+1)+'" id="radios'+Number(  $(this).parent().parent().parent().children('h3').children('span').html() )+'" name="radios'+Number($(this).parent().parent().parent().children('h3').children('span').html() )+'[]"></label> </div><div class="col-lg-7 lista-option-custom"><input type="text" placeholder="" value="Opcion '+Number(Number($(this).parent().parent().children('.radio-lista').length)+1)+'" class="form-control lista-option" id="lista_option[]"  name="lista_option'+Number(  $(this).parent().parent().parent().children('h3').children('span').html() )+'[]">  <input type="text" class="form-control retroradios" name="retroradios'+Number(  $(this).parent().parent().parent().children('h3').children('span').html() )+'[]" class="form-control retroradios" placeholder="Retroalimentacion '+Number(Number($(this).parent().parent().children('.lista-custom').length)+1)+'"> </div>  </div>');
	}


});

// funcion para los que estan checkedos agregar el valor del consecutivo a nivel de elementos, o si no borra el valor que se tenga
$(document).on('click', '.chekeador', function(event) {
	$("input[name='"+$(this).attr('name')+"']").each(function(index, el) {
		if ($(this).is(':checked')) {  $(this).val(index);  } else {  $(this).val('');   }
	});


});

// funcion para los que estan checkedos agregar el valor del consecutivo a nivel de elementos, o si no borra el valor que se tenga
$(document).on('click', ".radio > label > input[type='radio']", function(event) {
	$("input[name='"+$(this).attr('name')+"']").each(function(index, el) {
		if ($(this).is(':checked')) {  $(this).val(index);  } else {  $(this).val('');   }
	});
});


/// evento para seleccionar un tipo de pregunta, cambie en tiempo real
$(document).on('change', '.selects', function(event) {

	var thiz_select=$(this);

	if (thiz_select.val()=="")  {
		thiz_select.parent().next().next().next('.custom_field').html("");
	}

	if (thiz_select.val()==1)  {
		thiz_select.parent().next().next().next('.custom_field').html('<div class="chk-inputs"><div style="float:left;"><label class="checkbox"><input type="checkbox" class="chekeador" name="op'+Number( $(this).parent().prev().prev('h3').children('span').html()  )+'[]" id="inlineCheckbox1"></label></div><input type="text" name="txtop'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]" class="form-control texter" placeholder="Opcion '+Number(Number(thiz_select.parent().next().next().next('.custom_field').children('.chk-inputs').length)+1)+'">  <input type="text" class="form-control retrotxtop" name="retrotxtop'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion '+Number(Number(thiz_select.parent().next().next().next('.custom_field').children('.chk-inputs').length)+1)+'"> </div> <div class=""><div style="float:left;"><label class="checkbox"><input type="checkbox" class="goster_check" disabled="true" id="inlineCheckbox1"></label></div><input type="text" name="gostop" id="gostop" class="form-control ghost-input" placeholder="Clic para crear otra opción"> </div> <div class="col-lg-1 cloner_btn">       ');
	}

	if (thiz_select.val()==2)  {
		thiz_select.parent().next().next().next('.custom_field').html( '<div class="col-lg-7 lista-custom">  <label class="radio checklista"><input type="radio" class="chekeador" name="oplista'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]" id="inlineCheckbox1"></label>   <input type="text" placeholder="" value="Opcion '+Number(Number(thiz_select.parent().next().next().next('.custom_field').children('.lista').length)+1)+'" class="form-control lista" id="lista[]"  name="lista'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]">   <input type="text" class="form-control retrolista" name="retrolista'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion '+Number(Number(thiz_select.parent().next().next().next('.custom_field').children('.chk-inputs').length)+1)+'">  </div><div class="col-lg-7"><input type="text" placeholder="Clic para crear otra opción" class="form-control" id="lista-gost"  name="lista-gost[]"></div>  ' );
	}

	if (thiz_select.val()==3)  {
		thiz_select.parent().next().next().next('.custom_field').html( ' <div class="radio-lista"> <div class="radio list-option-custom"><label><input type="radio" value="1" id="radios'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]" name="radios'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]"></label> </div><div class="col-lg-7 lista-option-custom"><input type="text" placeholder="" value="Opcion '+Number(Number(thiz_select.parent().next().next().next('.custom_field').children('.lista-option').length)+1)+'" class="form-control lista-option" id="lista_option'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]"  name="lista_option'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]">  <input type="text" class="form-control retroradios" name="retroradios'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion '+Number(Number(thiz_select.parent().next().next().next('.custom_field').children('.chk-inputs').length)+1)+'"></div>  </div> <div class="col-lg-7"><input type="text" placeholder="Clic para crear otra opción" class="form-control" id="lista-option-gost"  name="lista-option-gost[]"></div>' );
	}

	if (thiz_select.val()==4)  {
		thiz_select.parent().next().next().next('.custom_field').html( '<div class="col-lg-7"><input type="text" placeholder="Texto ayuda" class="form-control" id="campo_pregunta'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]"  name="campo_pregunta'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]">     <input type="text" class="form-control retrotexto" name="retrotexto'+Number($(this).parent().prev().prev('h3').children('span').html())+'[]" class="form-control texter" placeholder="Retroalimentacion">           </div>  ' );
	}

});


});