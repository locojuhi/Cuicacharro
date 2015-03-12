@extends('layouts.main2')
@extends('layouts.jumbotron')
	@section('contenido')
		@section('jumbomidle')

		<div class="row">
			<div class="col-xs-offset-1 col-md-offset-1 col-md-offset-1">
				<form role="form" method="post" action="{{URL::route('usuario-recuperar-password-post')}}">
					<div class="form-group">
					<label for="ejemplo_email_1">Email:</label>
						<input type="email" class="form-control" id="email" placeholder="Introduce tu email..." name="email" {{ (Input::old('email')) ? 'value="'. e(Input::old('email')) .'"':''}}>
						@if($errors->has('email'))
							{{$errors->first('email')}}
						@endif
					</div>
					<div class="col-xs-12 col-md-12 col-md-offset-12"></div>
						<button type="submit" class="btn btn-primary btn-sm">Enviar</button>
					{{Form::token()}}
				</form>
			</div>
		</div>
		@stop
	
	
	@stop