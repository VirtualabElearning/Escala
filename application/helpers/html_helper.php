<?php 

if (!function_exists('input_text')) {
	function input_text ($texto,$id,$nombre,$placeholder,$valor=null,$error=null)  {
		$html = '<div class="form-group">
		<label class="col-lg-2 control-label">'.$texto.'</label>
		<div class="col-lg-5"><input type="text" name="'.$nombre.'" value="'.$valor.'" id="'.$id.'" class="form-control" placeholder="'.$placeholder.'">
			'.$error.'</div></div>';
			return $html;
		}

	}

	if (!function_exists('password')) {
		function password ($texto,$id,$nombre,$placeholder,$valor=null,$error=null)  {
			$html = '<div class="form-group">
			<label class="col-lg-2 control-label">'.$texto.'</label>
			<div class="col-lg-5"><input type="password" name="'.$nombre.'" value="'.$valor.'" id="'.$id.'" class="form-control" placeholder="'.$placeholder.'">
				'.$error.'</div></div>';
				return $html;
			}

		}



		if (!function_exists('textarea')) {
			function textarea ($texto,$id,$nombre,$placeholder,$valor=null,$error=null)  {
				$html = '<div class="form-group">
				<label class="col-lg-2 control-label">'.$texto.'</label>
				<div class="col-lg-5"><textarea name="'.$nombre.'" id="'.$id.'" class="form-control" rows="5" placeholder="'.$placeholder.'">'.trim($valor).'</textarea>
					'.$error.'</div></div>';
					return $html;
				}

			}


			if (!function_exists('checkbox')) {
				function checkbox ($texto,$opciones,$saltar=null,$valores=null)  {
					$html = '<div class="form-group">
					<label class="col-lg-2 control-label">'.$texto.'</label>
					<div class="col-lg-5">';

						foreach ($opciones as $dkey => $value) {
							$key=explode ("|",$dkey);

							$html.= '<label class="checkbox-inline"><input '; 
							if (@$key[4]=='checked')  { $html.="checked=true";  }
							$html.='type="checkbox" name="'.$key[0].'" id="'.$key[1].'" value="'.$key[2].'" '.@$key[3].'>'.$value.'</label>';

							if ($saltar==1)  {  $html.="<br>";  }
						}

						$html.='</div></div>';

						return $html;
					}

				}



				if (!function_exists('radiobutton')) {
					function radiobutton ($texto,$id,$nombre,$opciones)  {
						$html = '<div class="form-group">
						<label class="col-lg-2 control-label">'.$texto.'</label>
						<div class="col-lg-5">';
							foreach ($opciones as $key => $value) {
								$subkey=explode ("|",$key);
								$html.= '<input type="radio" name="'.$subkey[0].'" id="'.$subkey[1].'" value="'.$value.'">';
							}
							$html.='</div></div>';
							return $html;
						}
					}



					if (!function_exists('select')) {
						function select ($texto,$id,$nombre,$opciones,$valor=null)  {
							$html = '<div class="form-group">
							<label class="col-lg-2 control-label">'.$texto.'</label>
							<div class="col-lg-2">
								<select class="form-control" name="'.$nombre.'" id="'.$id.'">';
									foreach ($opciones as $key => $value) {
										$html.= '<option value="'.$key.'"';  
										if ($key==$valor) {  $html.="selected";  }
										$html.='>'.$value.'</option>';
									}
									$html.='</select></div></div>';
									return $html;
								}
							}




							if (!function_exists('select_multiple')) {
								function select_multiple ($texto,$id,$nombre,$opciones,$valor=null)  {
									$html = '<div class="form-group">
									<label class="col-lg-2 control-label">'.$texto.'</label>
									<div class="col-lg-2">
										<select multiple class="form-control" name="'.$nombre.'" id="'.$id.'">';
											foreach ($opciones as $key => $value) {
												$html.= '<option value="'.$key.'">'.$value.'</option>';
											}
											$html.='</select></div></div>';
											return $html;
										}
									}


									if (!function_exists('editor')) {
										function editor ($texto,$id,$nombre,$valor=null,$error=null)  {
											$html = ' <div class="form-group">
											<label class="col-lg-2 control-label">'.$texto.'</label>
											<div class="col-lg-6">
												<textarea class="cleditor" id="'.$id.'" name="'.$nombre.'">'.$valor.'</textarea>
												'.$error.'
											</div>
										</div> ';
										return $html;
									}

								}




								if (!function_exists('gen_preguntas')) {
									function gen_preguntas ($id_cursos,$id_modulos,$id_actividades_barra)  {
										$html = '<div class="col-lg-2"> 
										<a href="#" id="add_preguntas">
											<button type="button" class="btn btn-sm btn-info">Agregar preguntas</button>
										</a>

										<a style="display:none;" class="prettyFrame" href="actividades/root/gen_preguntas/'.$id_cursos.'/'.$id_modulos.'/'.$id_actividades_barra.'?iframe=true&width=100%&height=100%" data-target="#modal" data-toggle="modal" id="add_preguntas_click">
											<button type="button" class="btn btn-sm btn-info">Agregar preguntas</button>
										</a>



									</div>
									';
									return $html;
								}

							}