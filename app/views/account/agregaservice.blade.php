@extends('layouts.main4')
@extends('layouts.jumbotron')

		@section('contenido')
			@section('jumbomidle')
				<form role="form" method="POST" action="">
			<div class="form-group">
				<label for="nick">Servicio</label>
				<input type="text" class="form-control" id="servicio" placeholder="servicio..." name="servicio" {{ (Input::old('servicio')) ? 'value="'. e(Input::old('servicio')) .'"':''}}>
				@if($errors->has('servicio'))
					{{$errors->first('servicio')}}
				@endif
			</div>
			<div class="form-group">
				<label for="fecha">Fecha:</label>
				<input type="fecha" class="form-control" id="fecha" name="fecha" placeholder="Introduce tu fecha..." {{ (Input::old('fecha')) ? 'value="'. e(Input::old('fecha')) .'"':''}}>
				@if($errors->has('fecha'))
					{{$errors->first('fecha')}}
				@endif
			</div>
				<div class="form-group">
				<label for="kilometraje">Kilometraje:</label>
					<input type="kilometraje" class="form-control" id="kilometraje" name="kilometraje" placeholder="Contraseña...">
					@if($errors->has('kilometraje'))
						{{$errors->first('kilometraje')}}
					@endif
			</div>
				

				<button type="submit" class="btn btn-info btn-md">Enviar</button>
				{{Form::token()}}
		</form>
			@stop
		@stop