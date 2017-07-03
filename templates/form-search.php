<form class="form-inline" id="form_process" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
	
	<div class="form-group">
		<label for="exampleInputName2">Tanggal Awal</label>
		<input type="text" class="form-control" name="tgl-mulai" id="tgl-mulai" value="<?=$_POST['tgl-mulai']?>" >
	</div>
	
	<div class="form-group">
		<label for="exampleInputEmail2">Tanggal Akhir</label>
		<input type="text" class="form-control" name="tgl-akhir" id="tgl-akhir" value="<?=$_POST['tgl-akhir']?>" >
	</div>
	<button type="button" class="btn btn-default" id="cari">Cari</button>
	<?php foreach ( $items as $item ) { ?>
	 	<input type="hidden" class="id_hotel" value="<?=$item->ID;?>" >
	<?php } ?>
</form>

<?=$data_hotel;?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css.map" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.js"></script>
