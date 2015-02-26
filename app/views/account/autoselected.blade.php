@extends('layouts.main3')
@extends('layouts.jumbotron')

		@section('contenido')
			@section('jumbomidle')
				id kilometro:{{$id_km}} <br>
				id servicio : {{$id_servicio}}<br>
				id auto:{{$id_carro}}
				
				
				
				<!--Esto es para hacer dinamico el proyecto y personalizar esta ventana con la placa del carro que se ha seleccionado.-->
   				@foreach ($id_auto as $auto)
				    <h1>{{Str::upper($auto->placa)}}</h1>
				@endforeach
				<div class="row">
					<div class="col-xs-6 col-md-6 col-lg-6">	
		   				<div class="dropdown">
							<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-info btn-lg btn-block"> <b>Servicios</b>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							
								<li><a href="/dashboard/auto/selected/{{$id_carro}}/servicio">Agregar</a></li>
							    <li><a href="">Historial</a></li>
							</ul>
						</div>
					</div>
					<div class="col-xs-6 col-md-6 col-lg-6">
					<form method="post" action="{{URL::route('eliminar_auto')}}">
					<input type="hidden" value="{{$id_carro}}" name="id_auto">
			 		<button type="submit" class="btn btn-danger btn-lg btn-block"><b>Eliminar</b></button>
			 		 {{Form::token()}}
			 		 </form>  
					</div>
				</div>
				<p class="lead"></p> 
				<div class="container-fluid">
					<div class="row">	
						<div class=""> 
							<table class="table table-striped table-bordered">
								<tr>
									<th><b>Servicio</b></th>
									<th><b>Fecha</b></th>
									<th><b>Kilometraje</b></th>
								</tr>
								<tr>
									<td>elemento 3</td>
									<td>fecha 3</td>
									<td>kilometraje 3</td>
								</tr>
							</table>
						</div>
					</div>
 				</div>
   						<a href="{{URL::route('agregar-kilometraje')}}"><img src="../../../../public/img/cuicacharro_preguntando.png" class="img-responsive"></a>
			@stop
		@stop