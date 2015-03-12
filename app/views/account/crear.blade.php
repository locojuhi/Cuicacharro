@extends('layouts.main2')
@extends('layouts.jumbotron')
@section('contenido')
	@section('jumbomidle')

		<form role="form" method="POST" action='{{URL::route('usuario-crear-post')}}'>
			<div class="form-group">
				<label for="nick">Nick:</label>
				<input type="text" class="form-control" id="usuario" placeholder="Usuario..." name="usuario" {{ (Input::old('usuario')) ? 'value="'. e(Input::old('usuario')) .'"':''}}>
				@if($errors->has('usuario'))
					{{$errors->first('usuario')}}
				@endif
				</div>
				<div class="form-group">
				<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu email..." {{ (Input::old('email')) ? 'value="'. e(Input::old('email')) .'"':''}}>
					@if($errors->has('email'))
						{{$errors->first('email')}}
					@endif
				</div>
				<div class="form-group">
				<label for="password">Contraseña:</label>
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