@extends('layouts.main5')
@extends('layouts.jumbotron')
	@section('contenido')
		@section('jumbomidle')
		<div class="row col-xs-12 col-md-12 col-lg-12">
			<div class="container-flow col-xs-6 col-md-6 col-lg-6">
				<a href="{{'../../../../dashboard/auto/selected/'.$id_auto}}" class="btn btn-block btn-primary">Regresa</a>
			</div>
			<div class="container-flow col-xs-6 col-md-6 col-lg-6">
				<a href="pdf/{{$id_auto}}" class="btn btn-block btn-info">Guardar</a>
			</div>
		</div>
			<p class="lead"></p>
			<div class="row col-xs-12 col-md-12 col-lg-12 table-responsive">
				<table class="table table-stripped">
					<tr>
						<th>
							Fecha de realizacion
						</th>
						<th>
							Servicio realizado
						</th>
						<th>
							kilometraje
						</th>
					</tr>
					<tr>
					<?php 
						foreach ($reporte as $key) {
							echo "<tr>";
							echo "<td>".$key->fecha."</td>";
							echo "<td>".$key->nombre."</td>";
							echo "<td>".$key->kilometro."</td>";
							echo "</tr>";
						}
					 ?>
						
					</tr>
				</table>
			</div>
		@stop
	@stop