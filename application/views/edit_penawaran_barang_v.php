<script src="http://cdn.wysibb.com/js/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="http://cdn.wysibb.com/css/default/wbbtheme.css" type="text/css" />
<script>
$(function() {
$("#editor").wysibb();
})
</script>
<?PHP 
$no_transaksi = 1;
if($no_trx->NEXT != "" || $no_trx->NEXT != null ){
	$no_transaksi = $no_trx->NEXT+1;
}

$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$sess_user = $this->session->userdata('masuk_akuntansi');
$id_user = $sess_user['id'];
$user = $this->master_model_m->get_user_info($id_user);

$bulan_kas = date('m');
$bulan_kas = tgl_to_romawi($bulan_kas);
$tahun_kas = date('Y');

$no_bukti_real = str_pad($no_transaksi, 3, '0', STR_PAD_LEFT)."/SRT/MCN-PAS/".$bulan_kas."/".$tahun_kas;

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

$bukti_kas = 'BK/'.$bulan_kas.'/'.$tahun_kas;


?>

<style type="text/css">

input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
}

</style>
<input id="tr_utama_count" value="1" type="hidden"/>
<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-edit"></i>  Edit Penawaran </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Penjualan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li> Pewanaran Barang <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Edit Penawaran </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post">
<input type="hidden" name="id_penawaran" value="<?=$dt->ID;?>">
<div class="breadcrumb" style="background:#E0F7FF;">
	<div class="row-fluid">
		<div class="span4">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Kepada </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="pelanggan" name="pelanggan" readonly style="background:#FFF; width: 70%;" value="<?=$dt->PELANGGAN;?>">
						<input type="hidden" id="pelanggan_sel" name="pelanggan_sel" readonly style="background:#FFF;" value="<?=$dt->ID_PELANGGAN;?>">
						<button onclick="show_pop_pelanggan();" type="button" class="btn">Cari</button>
					</div>
				</div>
			</div>
		</div>

		<div class="span3">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> UP </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="atas_nama" name="atas_nama" style="background:#FFF; width: 90%" value="<?=$dt->UP;?>">
					</div>
				</div>
			</div>
		</div>

		<div class="span3">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Divisi </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="unit_txt" name="unit_txt" readonly style="background:#FFF; width: 90%" value="<?=$user->NAMA_UNIT;?>">
						<input type="hidden" id="unit" name="unit" value="<?=$user->UNIT;?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Alamat </b> </label>
				<div class="controls">
					<textarea rows="4" id="alamat_tagih" name="alamat_tagih" style="resize:none; height: 87px; width: 90%;"><?=$dt->ALAMAT;?></textarea>
				</div>
		</div>

	</div>


	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Tanggal </b> </label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append date">
						<input readonly="" style="width: 80%;" value="<?=$dt->TGL_TRX;?>" required name="tgl_trx" data-format="dd-MM-yyyy" type="text">
						<span class="add-on ">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. Transaksi </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="<?=$dt->NO_BUKTI;?>" name="no_trx" id="no_trx" style="font-size: 15px;">
			</div>
		</div>
	</div>


	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Perihal </b> </label>
				<div class="controls">
					<textarea rows="4" id="memo_lunas" name="memo_lunas" style="resize:none; height: 87px; width: 80%;"><?=$dt->MEMO;?></textarea>
				</div>
		</div> 
	</div>
</div>


<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Contact Person </b> </label>
				<div class="controls">
					<input type="text" class="span12" value="<?=$dt->CONTACT_PERSON;?>" name="contact_person" id="contact_person" style="font-size: 15px;">
				</div>
		</div>
	</div>

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Validasi Penawaran s/d </b> </label>
				<div class="controls">
					<div id="datetimepicker2" class="input-append date">
						<input readonly="" style="width: 80%; background:#FFF;" value="<?=$dt->VALIDASI;?>" required name="validasi_tgl" data-format="dd-MM-yyyy" type="text">
						<span class="add-on ">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
		</div>
	</div>

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Harga Include PPN </b> </label>
				<div class="controls">
					<select  data-placeholder="Pilih ..." id="include_ppn" name="include_ppn" >
						<option <?PHP if($dt->INCLUDE_PPN == "ya"){ echo "selected"; } ?> value="ya">YA</option>	
						<option <?PHP if($dt->INCLUDE_PPN == "tidak"){ echo "selected"; } ?> value="tidak">TIDAK</option>				
					</select>
				</div>
		</div>
	</div>
</div>


<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head orange">
				<h3> </h3>
			</div>
			<div class="widget-container">
				<!-- <button style="margin-bottom: 15px;" data-toggle='modal' data-target='#modal_add_produk' type="button" class="btn btn-danger"><i class="icon-hdd"></i> Tambah Produk </button> -->
				<table class="stat-table table table-hover">
					<thead>
						<tr>
							<th align="center" style="width: 20%;"> Produk / Item </th>
							<th align="center"> Minimal Order </th>
							<th align="center"> Satuan </th>
							<th align="center"> Harga Satuan (Rp) </th>
							<th align="center"> Aksi </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP foreach ($dt_detail as $key => $row) { ?>
						<tr id="tr_<?=$key+1;?>" class="tr_utama">
							<td style="vertical-align:middle;"> 

								<div class="control-group">
									<div class="controls">
										<div class="input-append">
											<input type="text" id="nama_produk_<?=$key+1;?>" name="nama_produk[]" readonly style="background:#FFF; width: 60%;" value="<?=$row->NAMA_PRODUK;?>">
											<input type="hidden" id="id_produk_<?=$key+1;?>" name="produk[]" readonly style="background:#FFF;" value="<?=$row->ID_PRODUK;?>">
											<input type="hidden" id="jenis_produk_<?=$key+1;?>" name="jenis_produk[]" readonly style="background:#FFF;" value="">
											<button style="width: 30%;" onclick="show_pop_produk(<?=$key+1;?>);" type="button" class="btn">Cari</button>
										</div>
									</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this); always_one(<?=$key+1;?>); hitung_total(<?=$key+1;?>);" onchange="" id="qty_<?=$key+1;?>" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="<?=$row->QTY;?>" name="qty[]">
									<input type="hidden" id="qty_max_<?=$key+1;?>" name="qty_max[]" value="">
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input style="font-size: 18px; text-align:left; width: 80%;" type="text"  value="<?=$row->SATUAN;?>" name="satuan[]" id="satuan_<?=$key+1;?>">
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input required onkeyup="FormatCurrency(this); hitung_total(<?=$key+1;?>);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="<?=$row->HARGA_SATUAN;?>" name="harga_satuan[]" id="harga_satuan_<?=$key+1;?>">
								</div>
							</td>

							<td style='background:#FFF; text-align:center; vertical-align: middle;'> 
								<button  style="width: 100%;" onclick="hapus_row(<?=$key+1;?>);" type="button" class="btn btn-danger"> Hapus </button>
							</td>
						</tr>
						<?PHP } ?>
					</tbody>
				</table>

				<button style="margin-bottom: 15px;" onclick="tambah_data();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Baris Data </button>

			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head orange">
				<h3> </h3>
			</div>

			<div class="widget-container">
				<div class="row-fluid" style="display: none;">
					<div style="margin-bottom: 15px;" class="span3">
						<h4> Sub Total :</h4> 
					</div>

					<div style="margin-bottom: 15px;" class="span4">
						<h4 id="subtotal_txt"> Rp. 0.00 </h4> 
					</div>

					<div style="margin-bottom: 15px;" class="span4">
						<div class="controls">
							<label class="checkbox" style="font-size: 16px;">
							<input type="checkbox" checked name="is_lunas" id="is_lunas" value="" onclick="cek_islunas();">
							Sudah Membayar</label>
						</div>
					</div>
				</div>

				<div class="row-fluid" style="display: none;">
					<div class="span3">
						<div class="control-group">
							<label class="control-label"> <b style="font-size: 14px;"> Pajak </b> </label>
								<div class="controls">
									<select required data-placeholder="Pilih Pajak ..." class="chzn-select" tabindex="2" style="width:150px;" name="id_pajak" onchange="hitung_pajak(this.value);">
											<option value="0" style="font-weight:bold;"> Tanpa Pajak </option>
										<?PHP foreach ($get_pajak as $key => $pajak) { ?>
											<option value="<?=$pajak->ID;?>"> <?=$pajak->NAMA_PAJAK;?> </option>
										<?PHP } ?>				
									</select>
									<input name="pajak_prosen" id="pajak_prosen" type="hidden" value="0" />
									<input name="kode_akun_pajak" id="kode_akun_pajak" type="hidden" value="" />
								</div>
						</div>
					</div>

					<div class="span4" style="margin-top: 18px;">
						<input style="font-size: 16px;" type="text" name="pajak_all" id="pajak_all" onkeyup="FormatCurrency(this); hitung_total_semua();"  placeholder="Isikan nilai pajak" />
					</div>

					<div class="span4" id="piutang_row" style="display:none;">
						<div class="control-group">
							<label class="control-label"> <b style="font-size: 14px;"> Pilih Kategori Piutang </b> </label>
							<div class="controls">
								<select class="span12" name="akun_piutang">
									<option value="1-1200"> Piutang Usaha </option>
									<option value="1-1210"> Piutang Lainnya </option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid" style="margin-top: 10px; display: none;">
					<div style="margin-bottom: 15px;" class="span3">
						<h3> Total :</h3> 
					</div>

					<div style="margin-bottom: 15px;" class="span4">
						<h3 id="total_txt" style="color:green;"> Rp. 0.00 </h3> 
					</div>
				</div>

				

				<div class="form-actions">
					<center>
					<input type="hidden" name="sub_total" id="sub_total" value="" />
					
					<input type="hidden" name="total_all" id="total_all" value="" />
					<input type="hidden" name="sts_lunas" id="sts_lunas" value="1" />

					<input type="submit" value="Simpan Penawaran" name="edit" class="btn btn-success">
					<button class="btn" onclick="window.location='<?=base_url();?>penawaran_barang_c' " type="button"> Batal dan Kembali </button>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

</form>

<!-- COPY ELEMENT -->
<div style="display:none;" id="copy_ag">
	<td align="center" style="vertical-align:middle;"> 
		<div class="control-group">
			<div class="controls">
				<select  required data-placeholder="Pilih ..." class="cek_select" tabindex="2"  name="kode_akun[]" style="width: 100%;">
					<option value="">Pilih ...</option>
					<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
					<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
					<?PHP } ?>				
				</select>
			</div>
		</div>
	</td>
</div>
<!-- END COPY ELEMENT -->

<!-- Modal Add produk -->
<div class="modal fade" id="modal_add_produk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Tambah Produk </h4>
      </div>
      <div class="modal-body">
        

		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Kode Produk </b> </label>
					<div class="controls">
						<input type="text" class="span12" value="" name="kode_produk_add" id="kode_produk_add">
					</div>
				</div>

				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Nama Produk </b> </label>
					<div class="controls">
						<input type="text" class="span12" value="" name="nama_produk_add" id="nama_produk_add">
					</div>
				</div>

				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Satuan </b> </label>
					<div class="controls">
						<input type="text" class="span12" value="" name="satuan_add" id="satuan_add">
					</div>
				</div>

				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;">Harga Satuan </b> </label>
					<div class="controls">
						<input type="text" onkeyup="FormatCurrency(this);" class="span12" value="" name="harga_satuan_add" id="harga_satuan_add">
					</div>
				</div>

				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Deskripsi </b> </label>
						<div class="controls">
							<textarea rows="3" id="deskripsi_add" name="deskripsi_add" style="resize:none; height: 60px; width: 400px;"></textarea>
						</div>
				</div> 
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button id="tutup_add_produk" type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-success" onclick="simpan_add_produk();"> Simpan Produk </button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

function hapus_row_pertama(){
	$('#nama_produk_1').val('');
	$('#id_produk_1').val('');
	$('#qty_1').val('');
	$('#satuan_1').val('');
	$('#harga_satuan_1').val('');
	$('#jumlah_1').val('');

	hitung_total_semua();
}

function simpan_add_produk(){
	var kode_produk = $('#kode_produk_add').val();
	var nama_produk = $('#nama_produk_add').val();
	var satuan 		= $('#satuan_add').val();
	var deskripsi   = $('#deskripsi_add').val();
	var harga       = $('#harga_satuan_add').val();

	if(kode_produk == ""){
		alert("Kode Produk Harus di isi.");
	} else if(nama_produk == ""){
		alert("Nama Produk Harus di isi.");
	} else if(satuan == ""){
		alert("Satuan Produk Harus di isi.");
	} else if(harga == ""){
		alert("Harga Produk Harus di isi.");
	} else {
		$.ajax({
			url : '<?php echo base_url(); ?>transaksi_penjualan_c/simpan_add_produk',
			data : {
				kode_produk:kode_produk,
				nama_produk:nama_produk,
				satuan:satuan,
				deskripsi:deskripsi,
				harga:harga,
			},
			type : "POST",
			dataType : "json",
			success : function(result){
				$('#tutup_add_produk').click();
				$.gritter.add({
		            title: 'Notifikasi',
		            position: 'bottom-right',
		            text: 'Data Produk berhasil terimpan.'
		        });
		        return false;
			}
		});
	}

}

function show_pop_produk(no){
	get_popup_produk();
    ajax_produk(no);
}

function show_pop_pelanggan(id){
    get_popup_pelanggan();
    ajax_pelanggan();
}

function get_popup_produk(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Produk...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th> KODE PRODUK </th>'+
                '                        <th style="white-space:nowrap;"> NAMA PRODUK </th>'+
                '                        <th> HARGA </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
        $('#popup_koang').remove();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_produk(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_produk_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;
                nama_pel = res.STOK+" "+res.SATUAN;
                if(res.TIPE == "JASA"){
                	nama_pel = "UNLIMITED";
                }



                isine += '<tr onclick="get_produk_detail(\'' +res.ID+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.KODE_PRODUK+'</td>'+
                            '<td align="left">'+res.NAMA_PRODUK+'</td>'+
                             '<td align="center">Rp '+NumberToMoney(res.HARGA).split('.00').join('')+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='5' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_produk(id_form);
            });
        }
    });
}

function get_popup_pelanggan(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Pelanggan...">'+
                '    <div class="table-responsive" style="max-height: 500px; overflow-y: scroll;">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap;"> NAMA PELANGGAN / PERUSAHAAN </th>'+
                '                        <th> ALAMAT </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
        $('#popup_koang').remove();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_pelanggan(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_pelanggan_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;
                nama_pel = res.NAMA_PELANGGAN;
                if(res.TIPE == "Perusahaan"){
                	nama_pel = res.NAMA_PELANGGAN+" <b> ("+res.NAMA_USAHA+")</b>";
                }

                isine += '<tr onclick="get_pelanggan_det('+res.ID+');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+nama_pel+'</td>'+
                            '<td align="center">'+res.ALAMAT_TAGIH+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='5' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_pelanggan();
            });
        }
    });
}


function cek_islunas(){
	if($("#is_lunas").is(':checked')){
	    $('#piutang_row').hide(); 
	    $('#sts_lunas').val(1); 
	} else {
	    $('#piutang_row').show(); 
	    $('#sts_lunas').val(0); 
	}
}

function hitung_total(id){

	var qty = $('#qty_'+id).val();
	qty = qty.split(',').join('');
	
	var harga_satuan = $('#harga_satuan_'+id).val();
	harga_satuan = harga_satuan.split(',').join('');

	if(harga_satuan == "" || harga_satuan == null){
		harga_satuan = 0;
	}

	var total = parseFloat(qty) * parseFloat(harga_satuan);

	var pajak = $('#tax_'+id).val();
	pajak = (total * parseFloat(pajak)) / 100;
	pajak = Math.round(pajak);

	total = total + pajak;

	$('#jumlah_'+id).val(total);

	hitung_total_semua();
}

function get_produk_detail(id, no_form){
    var id_produk = id;
    $.ajax({
		url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_produk_detail',
		data : {id_produk:id_produk},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#qty_'+no_form).val(1);
			$('#id_produk_'+no_form).val(id_produk);
			$('#qty_max_'+no_form).val(result.STOK);
			$('#qty_'+no_form).val('');
			$('#satuan_'+no_form).val(result.SATUAN);
			$('#jenis_produk_'+no_form).val(result.TIPE);
			$('#nama_produk_'+no_form).val(result.NAMA_PRODUK);
			$('#harga_satuan_'+no_form).val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
			$('#jumlah_'+no_form).val(NumberToMoney(result.HARGA_JUAL*result.STOK).split('.00').join(''));

			var isi =   '<option value="0">None</option>'+
						'<option value="'+result.PPH+'">PPH</option>'+
						'<option value="'+result.PPN+'">PPN</option>'+
						'<option value="'+result.SERVICE+'">SERVICE</option>';

			$('#tax_'+no_form).html(isi);

			$('#harga_satuan_'+no_form).focus();

			hitung_total(no_form);

			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();
		}
	});
}

function always_one(id){
	var a = $('#qty_'+id).val();
	if(a <= 0){
		$('#qty_'+id).val(1);
	}

	// var max = parseInt($('#qty_max_'+id).val());
	// if(a > max){
	// 	$('#qty_'+id).val(max);
	// }
}

function tambah_data() {
	var value =$('#copy_select').html();
	var jml_tr = $('#tr_utama_count').val();
	var i = parseInt(jml_tr) + 1;

	var coa = $('#copy_ag').html();

	$isi_1 = 
	'<tr id="tr_'+i+'" class="tr_utama">'+
		'<td class="center" style="vertical-align:middle;" id="td_chos_'+i+'">'+
			'<div class="control-group">'+
				'<div class="controls">'+
					'<div class="input-append">'+
						'<input type="text" id="nama_produk_'+i+'" name="nama_produk[]" readonly style="background:#FFF; width: 60%">'+
						'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;">'+
						'<input type="hidden" id="jenis_produk_'+i+'" name="jenis_produk[]" readonly style="background:#FFF;" value="">'+
						'<button style="width: 30%" onclick="show_pop_produk('+i+');" type="button" class="btn">Cari</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</td>'+
		'<td class="center" align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); always_one('+i+'); hitung_total('+i+');" onchange="" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="qty[]" id="qty_'+i+'">'+
				'<input type="hidden" id="qty_max_'+i+'" name="qty_max[]" value="">'+
			'</div>'+
		'</td>'+

		'<td class="center" align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input style="font-size: 18px; text-align:left; width: 80%;" type="text"  value="" name="satuan[]" id="satuan_'+i+'">'+
			'</div>'+
		'</td>'+

		'<td class="center" align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input required onkeyup="FormatCurrency(this); hitung_total('+i+');" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_satuan[]" id="harga_satuan_'+i+'">'+
			'</div>'+
		'</td>'+


		'<td class="center" style="background:#FFF; text-align:center;">'+
			'<button style="width: 100%;" onclick="hapus_row('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
		'</td>'+
	'</tr>';

	$('#tes').append($isi_1);
	$('#tr_'+i).find('.cek_select').attr('class', 'cek_select_'+i);
	$('#tr_utama_count').val(i);
	$(".cek_select_"+i).chosen();

}


function get_pelanggan_det(id_pel){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_pelanggan_detail',
		data : {id_pel:id_pel},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();

			$('#alamat_tagih').val(result.ALAMAT_TAGIH);
			$('#pelanggan').val(result.NAMA_PELANGGAN);
			$('#pelanggan_sel').val(id_pel);
		}
	});
}

function hitung_total_semua(){
	var sum = 0;
	var pajak_prosen = $('#pajak_prosen').val();
	console.log(pajak_prosen);
	$("input[name='jumlah[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });

	var pajak = $('#pajak_all').val().split(',').join('');
	if(pajak == ""){
		pajak = 0;
	}
	
	var total_all = parseFloat(sum) + parseFloat(pajak) ;

    $('#sub_total').val(sum);
    //$('#pajak_all').val(pajak);
    $('#total_all').val(total_all);

    $('#pajak_txt').html('Rp. '+NumberToMoney(pajak));
    $('#subtotal_txt').html('Rp. '+acc_format(sum, ""));
    $('#total_txt').html('Rp. '+acc_format(total_all, ""));
}

function hitung_pajak(id_pajak){
	$('#popup_load').show();
	if(id_pajak > 0){
		$.ajax({
			url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_pajak_prosen',
			data : {id_pajak:id_pajak},
			type : "GET",
			dataType : "json",
			success : function(result){
				$('#pajak_prosen').val(result.PROSEN);
				$('#kode_akun_pajak').val(result.PAJAK_PENJUALAN);
				hitung_total_semua();
				$('#popup_load').hide();
			}
		});
	} else {
		$('#pajak_prosen').val(0);
		$('#kode_akun_pajak').val('');
		hitung_total_semua();
		$('#popup_load').hide();
	}

	
}

function hapus_row (id) {
	$('#tr_'+id).remove();
	hitung_total_semua();
}

function acc_format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
</script>