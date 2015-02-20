@extends('layouts.main3')
@extends('layouts.jumbotron')

		@section('contenido')
			@section('jumbomidle')
				{{$servicios}} <br>
				{{$id}}<br>
				{{$km}}<br>
				{{$fecha}}<br>
				{{$tiempos}}<br>
				
				
				<!--Esto es para hacer dinamico el proyecto y personalizar esta ventana con la placa del carro que se ha seleccionado.-->
   				@foreach ($id_auto as $auto)
				    <h1>{{Str::upper($auto->placa)}}</h1>
				@endforeach
   				<div class="dropdown">
					<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-info btn-lg"> <b>Servicios</b>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li><a href="{{URL::route('agregar-servicio')}}">Agregar</a></li>
					    <li><a href="">Historial</a></li>
					</ul>
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
   						<a href=""><img src="../../../../public/img/cuicacharro_preguntando.png" class="img-responsive"></a>
			@stop
		@stop