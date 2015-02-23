@extends('layouts.main4')
@extends('layouts.jumbotron')
	@section('contenido')
			@section('jumbomidle')
			<h3>Agrega el kilometraje actual del vehiculo</h3>
				<form role="form" method="POST" action="">
					<div class="form-group">
						<label for="kilometrade">Kilometraje</label>
						<input type="text" class="form-control" id="kilometraje" placeholder="kilometraje..." name="kilometraje" {{ (Input::old('kilometraje')) ? 'value="'. e(Input::old('kilometraje')) .'"':''}}>
						@if($errors->has('kilometraje'))
							{{$errors->first('kilometraje')}}
						@endif
					</div>
					<div class="form-group">
						<label for="fecha">Fecha:</label>
						<input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" {{ (Input::old('fecha')) ? 'value="'. e(Input::old('fecha')) .'"':''}}>
						@if($errors->has('fecha'))
							{{$errors->first('fecha')}}
						@endif
						<p class="lead"></p>
						<button type="submit" class="btn btn-info btn-md">Enviar</button>
						{{Form::token()}}
				</form>
			@stop
	@stop