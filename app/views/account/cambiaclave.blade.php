@extends('layouts.main2')
@extends('layouts.jumbotron')
	@section('contenido')
		@section('jumbomidle')
			<div class="row col-xs-6 col-md-6 col-lg-6">
			<a href="{{URL::route('mainPanel')}}" class="btn btn-block btn-primary">Regresar</a>
				
			</div>
			<div class="row">
				<p class="lead"></p>
			</div>
			<p class="lead"></p>
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