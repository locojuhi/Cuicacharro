@extends('layouts.main4')
@extends('layouts.jumbotron')
	@section('contenido')
			@section('jumbomidle')
			<h3>Agrega el kilometraje actual del vehiculo</h3>
			<div class="row col-xs-6 col-md-6 col-lg-6">
					<a href="{{'../../../../dashboard/auto/selected/'.$id_auto}}" class="btn btn-block btn-primary">Regresa</a>
				</div>
				<div class="row"><p class="lead"></p></div>
				<p class="lead"></p>
				<form role="form" method="POST" action="{{URL::route('agregar-kilometraje-actual-post')}}">
					<div class="form-group">
						<label for="kilometrade">Kilometraje</label>
						<input type="hidden" name="id_auto" value="{{$id_auto}}">
						<input type="text" class="form-control" id="kilometraje" placeholder="kilometraje..." name="kilometraje" {{ (Input::old('kilometraje')) ? 'value="'. e(Input::old('kilometraje')) .'"':''}}>
						@if($errors->has('kilometraje'))
							{{$errors->first('kilometraje')}}
						@endif
					</div>
						<p class="lead"></p>
						<button type="submit" class="btn btn-info btn-md">Enviar</button>
						{{Form::token()}}
				</form>
			@stop
	@stop