<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
}

.table th, .table td {
    /*padding: 1px !important;*/
	font-size: 12px !important;
	padding-left: 5px !important;
	padding-right: 5px !important;
	padding-top: 4px !important;
	padding-bottom: 4px !important;

}
</style>


<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-random"></i> Delivery Order </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Pembelian</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Delivery Order  </li>
		</ul>
	</div>
</div>

<div class="row-fluid ">
	<div class="span6">
		<form method="post" action="<?=base_url();?>delivery_order_c">
		<div class="control-group">
			<label class="control-label" style="font-weight: bold; font-size: 13px;">Tampilkan berdasarkan tanggal :</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
					<input required type="text" name="tgl" id="reservation" value="<?=$tgl_full;?>"/>
					<input type="submit" name="cari" style="margin-top: 1px; height: 33px;" class="btn btn-warning" value="Cari"/>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>



<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover" id="data-table">
					<thead>
						<tr>
							<th align="center"> Aksi </th>
							<th align="center"> No. Transaksi </th>
							<th align="center"> No. Delivery Order </th>
							<th align="center"> Tanggal </th>
							<th align="center"> Customer </th>
							<th align="center"> Tujuan </th>
							<th align="center"> Alat Angkut </th>
							<th align="center"> No. Pol </th>
							<th align="center"> Sopir </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP  foreach ($dt as $key => $row) { ?>
							<tr>
								<td align="center">
									<a target="blank" href="<?=base_url();?>delivery_order_beli_c/cetak/<?=$row->ID;?>" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>						
									<a class="btn btn-warning" href="<?=base_url();?>purchase_order_c/ubah_data/<?=$row->ID;?>" style="font-size: 15px; padding-right: 8px;"><i class="icon-edit"></i></a>			
									<button onclick="detail_transaksi(<?=$row->ID;?>);" data-toggle="modal" data-target="#modal_detail" class="btn btn-primary" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-eye-open"></i></button>			
								</td>
								<td style="font-size:14px; text-align:center; vertical-align:middle;">   <?=$row->NO_BUKTI;?> </td>
								<td style="font-size:14px; text-align:center; vertical-align:middle;"> 
									<?=$row->NO_DO;?>
								 </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->TGL_DO;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->PELANGGAN;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->ALAMAT_TUJUAN;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->ALAT_ANGKUT;?> </td>								
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->NO_POL;?> </td>								
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->SOPIR;?> </td>								
							</tr>
						<?PHP }	?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Delivery Order</h4>
      </div>
      <form method="post" action="<?=base_url().$post_url;?>">
      <div class="modal-body">
		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<address>
					<strong> Tanggal Delivery Order </strong><br>
					<div id="datetimepicker1" class="input-append date ">
						<input readonly style="width: 80%;" value="" required name="tgl" id="tgl" data-format="dd-MM-yyyy" type="text">
						<span class="add-on ">
							<i class="icon-calendar"></i>
						</span>
					</div>
					<input class="span12" type="hidden" name="id_lapor" id="id_lapor" value="">
				</address>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-info" name="edit" value="Simpan Pengubahan">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Detail -->
<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Penjualan</h4>
      </div>
      <div class="modal-body">
        

		<div class="row-fluid">
			<div class="span6" style="font-size: 15px;">
				<address>
					<strong> No. Transaksi </strong><br>
					<font id="det_no_transaksi"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Nama Customer </strong><br>
					<font id="det_nama_pelanggan"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Alamat </strong><br>
					<font id="det_alamat_tujuan"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Kota Tujuan</strong><br>
					<font id="det_kota"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> No Polisi </strong><br>
					<font id="det_nopol"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Sopir </strong><br>
					<font id="det_sopir"> Dr. Aristo Jason </font> 
				</address>
			</div>
			<div class="span6" style="font-size: 15px;">
				<address style="margin-top: 18px;">
					<strong> Nama Produk </strong><br>
					<font id="det_nama_produk"> Dr. Aristo Jason </font> 
				</address>

				<address>
					<strong> No. Segel Atas </strong><br>
					<font id="det_segel_atas"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> No. Segel Bawah </strong><br>
					<font id="det_segel_bawah"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Kuantitas </strong><br>
					<font id="det_qty"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Harga Satuan </strong><br>
					<font id="det_modal"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Jumlah </strong><br>
					<font id="det_hinv"> Dr. Aristo Jason </font> 
				</address>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>





<?PHP 
function tgl_to_romawi($var){
	if($var == "01"){
	 	$var = "I";
	 } else if($var == "02"){
	 	$var = "II";
	 } else if($var == "03"){
	 	$var = "III";
	 } else if($var == "04"){
	 	$var = "IV";
	 } else if($var == "05"){
	 	$var = "V";
	 } else if($var == "06"){
	 	$var = "VI";
	 } else if($var == "07"){
	 	$var = "VII";
	 } else if($var == "08"){
	 	$var = "VIII";
	 } else if($var == "09"){
	 	$var = "IX";
	 } else if($var == "10"){
	 	$var = "X";
	 } else if($var == "11"){
	 	$var = "XI";
	 } else if($var == "12"){
	 	$var = "XII";
	 }

	 return $var;
}
?>

<script type="text/javascript">

function hapus_trx(id){
	$('#id_hapus').val(id);
	var sts = $('#sts_pembukuan_'+id).val();

	if(sts == ""){
		$('#hapus_txt').html('Apakah anda yakin ingin menghapus data ini?');
	} else {
		$('#hapus_txt').html('Transaksi ini telah dibukukan. Jika anda menghapus data ini, maka semua data pembukuan terkait transaksi ini akan dihapuskan. <br> Apakah anda yakin untuk menghapus data ini ?');
	}

	$('#dialog-btn').click(); 
}

function get_kode_akun(val){

	var last_kode_kas = $('#last_kode_kas').val(); 
	var last_kode_cc = $('#last_kode_cc').val();

	if(val == "Kas & Bank"){
		$('#kode_akun').val(last_kode_kas);
	} else if(val == "Credit Card"){
		$('#kode_akun').val(last_kode_cc);
	}
} 

function cari_kas_bank(keyword) {
	$.ajax({
		url : '<?php echo base_url(); ?>kas_bank_c/cari_kas_bank',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		success : function(result){
			$isi = "";
			if(result.length == 0){
				$isi = "<tr><td colspan='3' style='text-align:center;'> <b> Tidak ada kode akun yang dapat ditampilkan </b> </td></tr>";
			} else {
				$.each(result, function(i, field){
				$isi += 
					"<tr>"+
						"<td style='text-align:center;'> <b> "+field.KODE_AKUN+" </b> </td>"+
						"<td style='text-align:left;'> <b> "+field.NAMA_AKUN+" </b> </td>"+
						"<td style='text-align:right;'> <b> 0 </b> </td>"+
					"</tr>";
				});
			}

			$('#tes').html($isi);
		}
	});
}

function ubah_data_produk(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>kas_bank_c/cari_produk_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_produk').val(result.ID);
			$('#kode_produk_ed').val(result.KODE_PRODUK);
			$('#nama_produk_ed').val(result.NAMA_PRODUK);
			$('#satuan_ed').val(result.SATUAN);
			$('#deskripsi_ed').val(result.DESKRIPSI);



	        //$("#kategori_ed").chosen("destroy");

	        $('#view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}

function detail_transaksi(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>purchase_order_c/detail_transaksi',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){
			var res = result['dt'];
			var res_det = result['dt_detail'];

			$('#det_no_transaksi').html(res.NO_BUKTI);
			$('#det_nama_pelanggan').html(res.PELANGGAN);
			$('#det_alamat_tujuan').html(res.ALAMAT_TUJUAN);
			$('#det_kota').html(res.KOTA);
			$('#det_nopol').html(res.NO_POL);
			$('#det_sopir').html(res.SOPIR);
			$('#det_po').html(res.NO_PO);
			$('#det_do').html(res.NO_DO);
			$('#det_segel_atas').html(res.SEGEL_ATAS);
			$('#det_segel_bawah').html(res.SEGEL_BAWAH);
			
			$('#det_nama_produk').html(res_det.NAMA_PRODUK);
			$('#det_qty').html(res_det.QTY+' liter');
			$('#det_modal').html('Rp '+res_det.MODAL);
			$('#det_hjual').html('Rp '+res_det.HARGA_JUAL);
			$('#det_hinv').html('Rp '+res_det.HARGA_INVOICE);

			$('#popup_load').hide();


		}
	});
}

function tambah_klik(){
	$('.opt_btn').hide();
	$('#view_data').hide();
	$('#add_data').fadeIn('slow');
}

function batal_klik(){
	$('#add_data').hide();
	$('.opt_btn').show();
	$('#view_data').fadeIn('slow');
}

function batal_edit_klik(){
	$('#edit_data').hide();
	$('#view_data').fadeIn('slow');
}

function hapus_klik(id){
	$('#dialog-btn').click(); 
	$('#id_hapus').val(id);
}
</script>