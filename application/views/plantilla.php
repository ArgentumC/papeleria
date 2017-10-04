<!DOCTYPE html>
<html lang="es">
	<?php ini_set("mysql.trace_mode", "0") ?>
	<head>
		<title>Papeleria POS</title>
		
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>" ></script>
		<script src="<?php echo base_url('assets/js/bootstrap.js') ?>" ></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
  <style>

    .product-button {
      float:left;
      width:25%;
      height:25%;
      border:1px solid #3BD17C
    }
  </style>		
	</head>
	<body>
		<header>

		</header>
		<div class="container-fluid">
			<div class="col-md-12">
				<!-- Contenido de las vistas -->
				<?php $this->load->view($contenido); ?>
			</div>
		</div>
		<footer>
		</footer>
	</body>
</html>