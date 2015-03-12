@extends('layouts.main3')
@extends('layouts.jumbotron')

		@section('contenido')
			@section('jumbomidle')				
				<!--Esto es para hacer dinamico el proyecto y personalizar esta ventana con la placa del carro que se ha seleccionado.-->
   				<div class="container-fluid">
   					
	   				@foreach ($id_auto as $auto)
					    <h1>{{Str::upper($auto->placa)}}</h1>
					@endforeach
						<!--@foreach($id_serv_prox as $key)
							
							{{$key->nombre." | ".$key->kilometro." | ".$key->fecha." | ".$key->status."<br>"}}
						@endforeach-->
				</div>
				<!--{{$serv_realizado}}-->
				<a href="kilometraje-actual/{{$id_carro}}"><img src="../../../../public/img/cuicacharro_preguntando.png" class="img-responsive"></a>
				<p class="lead"></p>
				<div class="row">
					<div class="col-xs-6 col-md-6 col-lg-6">	
		   				<div class="dropdown">
							<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-info btn-lg btn-block"> <b>Servicios</b>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="servicio/{{$id_carro}}" class="btn btn-block btn-default"><b>Agregar</b></a></li>
							    <li><a href="" class="btn btn-block btn-default"><b>Historial</b></a></li>
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
						<div class="table-responsive"> 
							<table class="table table-striped table-bordered">
								<tr>
									<caption>Proximos Servicios</caption>
								</tr>
								<tr>
									<th><b>Servicio</b></th>
									<th><b>Fecha</b></th>
									<th><b>Kilometraje</b></th>
								</tr>

								<?php
									echo "<h3>".Str::upper($kilometroac=$kmactual->kilometro)." Kms</h3>"; 
									$servicio;
									$kilometraje;
									$fechas;
									$status;
									$fechaac= date('Y-m-d');
									foreach ($id_serv_prox as $key) {
										
										$services=$key->nombre;
										$kilometraje = $key->kilometro;
										$fechas = $key->fecha;
										$resultfec= (strtotime($fechas) - strtotime($fechaac))/86400;
										$result = $kilometraje - $kilometroac;
										switch ($result && $resultfec) {
											case $result>=100 && $resultfec>=15:
											echo "<tr class='success'>";
											echo "<td>";
												echo $services;
											echo "</td>";
											echo "<td>";
												echo $resultfec;
											echo "</td>";
											echo "<td>";
												echo $result;
											echo "</td>";
											break;
											case $result>=15 && $result<=99 && $resultfec>=1 && $resultfec<=14:
											echo "<tr class='warning'>";
												echo "<td>";
													echo $services;
												echo "</td>";
												echo "<td>";
													echo $resultfec;
												echo "</td>";
												echo "<td>";
													echo $result;
												echo "</td>";
											break;
											case $result<15 && $resultfec:
											echo "<tr class='danger'>";
												echo "<td>";
													echo $services;
												echo "</td>";
												echo "<td>";
													echo $resultfec;
												echo "</td>";
												echo "<td>";
													echo $result;
												echo "</td>";
											break;
										}						
									}echo "<tr>";
								 ?>
							</table>
						</div>
					</div>
 				</div>
   						
			@stop
		@stop