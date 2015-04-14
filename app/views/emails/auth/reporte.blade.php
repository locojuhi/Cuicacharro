<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="bootstrap2/css/bootstrap.css">
	<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="bootstrap2/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
	@if(Session::has('global'))

		
		
		<div class="alert alert-success" role="alert">
			{{Session::get('global')}}
		</div>

	@endif
	<p class="lead"></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">

       				<div class="jumbotron">
						<p class="lead"></p> 
						<div class="container-fluid">
							<div class="row">
								
								<div class="col-xs-12 col-md-12 col-lg-12"> 

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
												foreach ($reporte as $key) {
													echo "<tr>";
													echo "<td>".$key->fecha."</td>";
													echo "<td>".$key->nombre."</td>";
													echo "<td>".$key->kilometro."</td>";
													echo "</tr>";
												}
											 ?>
										</table>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
	
</html>

			
