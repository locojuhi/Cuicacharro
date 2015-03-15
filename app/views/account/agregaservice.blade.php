@extends('layouts.main4')
@extends('layouts.jumbotron')

		@section('contenido')
			@section('jumbomidle')
				<h3>Agrega el servicio realizado al auto</h3>
				<div class="row col-xs-6 col-md-6 col-lg-6">
					<a href="{{'../../../../dashboard/auto/selected/'.$id_auto}}" class="btn btn-block btn-primary">Regresa</a>
				</div>
				<div class="row"><p class="lead"></p></div>
				<p class="lead"></p>
				<form role="form" method="POST" action="{{URL::route('agregar-servicio-post')}}">
					<div class="form-group">
						<label for="nick">Servicio</label>
						<input type ="hidden" name="id_auto" value="{{$id_auto}}">
						<select class="form-control" id="servicio" name="id" placeholder="Selecciona servicio"{{ (Input::old('servicio')) ? 'value="'. e(Input::old('servicio')) .'"':''}}>
								@if($errors->has('servicio'))
									{{$errors->first('servicio')}}
								@endif
						<?php 
   								echo "<option>Seleccione una opción...</option>";
								foreach ($servicios as $key => $servicio) {
									echo "<option value =".$servicio.">".$key."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="fecha">Fecha:</label>
						<input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" {{ (Input::old('fecha')) ? 'value="'. e(Input::old('fecha')) .'"':''}}>
						@if($errors->has('fecha'))
							{{$errors->first('fecha')}}
						@endif
					</div>
						<div class="form-group">
						<label for="kilometraje">Kilometraje:</label>
							<input type="kilometraje" class="form-control" id="kilometraje" name="kilometraje" placeholder="Kilometraje">
							@if($errors->has('kilometraje'))
								{{$errors->first('kilometraje')}}
							@endif
					</div>
						<button type="submit" class="btn btn-info btn-md">Enviar</button>
						{{Form::token()}}
				</form>
			@stop
		@stop