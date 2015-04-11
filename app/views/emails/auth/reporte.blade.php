@extends('layouts.main2')
@extends('layouts.jumbotron')
	@section('contenido')
		@section('jumbomidle')

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
					<?php 
						print_r($reporte);
					 ?>
					<tr>
					
						
					</tr>
				</table>
			</div>
		@stop
		@stop