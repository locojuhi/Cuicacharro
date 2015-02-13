@extends('layouts.main')
@extends('layouts.jumbotron')
	@section('contenido')
		@section('jumbomidle')
			
			<form role="form" method="POST" action="{{URL::route('cambio-password-post')}}">
				<div class="form-group">
				<label for="passwordactual">Contraseña Actual:</label>
					<input type="password" class="form-control" id="passwordactual" name="passwordactual" placeholder="Introduce tu Contraseña actual..." {{ (Input::old('passwordactual')) ? 'value="'. e(Input::old('passwordactual')) .'"':''}}>
					@if($errors->has('passwordactual'))
						{{$errors->first('passwordactual')}}
					@endif
				</div>
				<div class="form-group">
				<label for="password">Nueva Contraseña:</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña...">
					@if($errors->has('password'))
						{{$errors->first('password')}}
					@endif
				</div>
				<div class="form-group">
				<label for="password2">Re-Contraseña:</label>
					<input type="password" class="form-control" id="password2" name="password2" placeholder="Repetir contraseña...">
					@if($errors->has('password2'))
						{{$errors->first('password2')}}
					@endif
					<span class="help-block">Deben coincidir ambas contraseñas</span>
				</div>

				<button type="submit" class="btn btn-info btn-md">Enviar</button>
				{{Form::token()}}
		</form>

		@stop
		@stop