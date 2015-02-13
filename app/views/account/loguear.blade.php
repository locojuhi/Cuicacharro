<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2"> <img src="img/cuicacharro.png" class="img-responsive" alt="Image"></div>
	
</div>
<div class="row">
	<div class="col-xs-offset-1 col-md-offset-1 col-md-offset-1">
		<form role="form" method="post" action={{URL::route('login-post')}}>
			<div class="form-group">
			<label for="ejemplo_email_1">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="Introduce tu email..." name="email" {{ (Input::old('email')) ? 'value="'. e(Input::old('email')) .'"':''}}>
				@if($errors->has('email'))
					{{$errors->first('email')}}
				@endif
			</div>
			<div class="form-group">
				<label for="ejemplo_password_1">Contraseña:</label>
				<input type="password" class="form-control" id="password" placeholder="Contraseña..." name="password">
				@if($errors->has('password'))
					{{$errors->first('password')}}
				@endif
				<span class="help-block"><a href="{{URL::route('usuario-recuperar-password')}}">Recuperar contraseña</a></span>
			</div>
			<div class="col-xs-12 col-md-12 col-md-offset-12"></div>
				<button type="submit" class="btn btn-primary btn-sm">Enviar</button>
				<a href="{{ URL::route('usuario-crear') }}" class="btn btn-success btn-sm">Registar</a>
			{{Form::token()}}
		</form>
	</div>
</div>