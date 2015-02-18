@extends('layouts.main')
@extends('layouts.jumbotron')
@section('contenido')
	@section('jumbomidle')
	<h1>Bienvenido, {{$user=Auth::user()->usuario;}}</h1>
		<div class="row">
			
			<div class="col-xs-4 col-md-4 col-lg-4">
			  <a href="{{URL::route('crear-auto')}}" class="btn btn-primary btn-sm btn-block"><h6>Añadir <br>Auto </h6></a>  
			</div>
			<div class="col-xs-4 col-md-4 col-lg-4">
			  <a href="{{URL::route('cambio-password')}}" class="btn btn-info btn-sm btn-block"><h6>Nueva <br>Clave	</h6></a>
			</div>
			<div class="col-xs-4 col-md-4 col-lg-4">
			  <a href="{{URL::route('cerrar-sesion')}}" class="btn btn-danger btn-sm btn-block"><h6>Cerrar <br>Sesion </h6></a>
			</div>
		</div>
	<p class="lead"></p>
		<div class="table-responsive">
		  <table class="table table-striped table-bordered">
		   	<tr>
		   		<th>Placa</th>
		   	</tr>		  
			<?php 
				$cars = $auto;
					$arrlength = count($cars);

					for($x = 0; $x <  $arrlength; $x++) {
						if($x%2==0){
							echo 
							"<tr>
					   			<td>
					   			<a href='dashboard/auto/selected/{$cars[$x]['id']}' class='btn btn-primary btn-lg btn-block'>". $cars[$x]['placa'];
								     echo "</td></tr>";
								 }else{
								 	echo "<tr>
									
					   			<td>
					   			<a href='dashboard/auto/selected/{$cars[$x]['id']}' class='btn btn-success btn-lg btn-block'>" . $cars[$x]['placa'];
								     echo "</td></tr>";

					 }
					         
					}
			 ?>

		  
		  
		   <!--	<tr>
		   		<td><a href="" class="btn btn-primary btn-lg btn-block">Elemento 1</a></td>
		   	</tr>
		   	<tr>
		   		<td><a href="" class="btn btn-success btn-lg btn-block">Elemento 2</a></td>
		   	</tr>
		   	<tr>
		   		<td><a href="" class="btn btn-primary btn-lg btn-block">Elemento 3</a></td>
		   	</tr>
		  
		</div>-->
		</table>

	@stop
@stop