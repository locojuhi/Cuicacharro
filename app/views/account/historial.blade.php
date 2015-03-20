@extends('layouts.main5')
@extends('layouts.jumbotron')
	@section('contenido')
		@section('jumbomidle')
			<div class="row col-xs-6 col-md-6 col-lg-6">
				<a href="{{'../../../../dashboard/auto/selected/'.$id_auto}}" class="btn btn-block btn-primary">Regresa</a>
			</div>
			<div class="row"><p class="lead"></p></div>
			<p class="lead"></p>
			<div class="row col-xs-12 col-md-12 col-lg-12 table-responsive">
				<table class="table table-stripped">
					<tr>
						<th>
							Fecha
						</th>
						<th>
							Servicio
						</th>
						<th>
							kilometraje
						</th>
					</tr>
					<tr>
						<td>
							Elemento 
						</td>
						<td>
							Elemento 2
						</td>
						<td>
							Elemento 3
						</td>
					</tr>
				</table>
			</div>
		@stop
	@stop