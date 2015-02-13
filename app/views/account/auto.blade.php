 
@extends('layouts.main')
@extends('layouts.jumbotron')

		@section('contenido')
				<script type="text/javascript">
					$( document ).ready(function() {
						$('#marca').on('change', function (e) {
						    $.ajax({
								url: "{{URL::route('seleccione-modelo')}}",
								data: {marca: this.value}
							}).success(function(modelos) {
								//console.log("listo ", modelos);
								var modelos_cadena = "";
								for (i=0; i<modelos.length;i++){ 
									modelos_cadena+= "<option value= "+ modelos[i]['id'] +">"+
									modelos[i]['nombre']+"</option>";
								} 
								$('#modelo').html(modelos_cadena);
							});
						});
					});
				</script>
			@section('jumbomidle')
				<form role="form" method="POST" action=''>
					<div class="form-group">
						<label for="nick">Placa:</label>
						<input type="text" class="form-control" id="placa" placeholder="Placa..." name="placa" {{ (Input::old('placa')) ? 'value="'. e(Input::old('placa')) .'"':''}}>
						@if($errors->has('placa'))
							{{$errors->first('placa')}}
						@endif
						</div>
						<div class="form-group">
							<label for="marca">Marca:</label>
							

							<select class="form-control" id="marca" name="marca" placeholder="Selecciona marca"{{ (Input::old('marca')) ? 'value="'. e(Input::old('marca')) .'"':''}}>
								@if($errors->has('marca'))
									{{$errors->first('marca')}}
								@endif
								
   							<?php 
   								echo "<option>Seleccione una opción...</option>";
								foreach ($marcas as $key => $marca) {
									echo "<option value =".$marca['id'].">".$marca['nombre']."</option>";
								}
							?>
		
							</select>
						</div>
						<div class="form-group">
							<label for="modelo">Modelo:</label>
							<select class="form-control" id="modelo" name="modelo" placeholder="Selecciona modelo"{{ (Input::old('modelo')) ? 'value="'. e(Input::old('modelo')) .'"':''}}>
								@if($errors->has('modelo'))
									{{$errors->first('modelo')}}
								@endif
							  <option>Seleccione una opción...</option>
							</select>
						</div>
						<div class="form-group">
						<label for="kilometraje">Kilometraje:</label>
							<input type="text" class="form-control" id="kilometraje" name="kilometraje" placeholder="Kilometraje...">
							@if($errors->has('kilometraje'))
								{{$errors->first('kilometraje')}}
							@endif
						</div>

						<button type="submit" class="btn btn-info btn-md">Enviar</button>
						{{Form::token()}}
				</form>
			@stop

		@stop


		
		
