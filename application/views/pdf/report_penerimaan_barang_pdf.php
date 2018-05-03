<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<style>
.gridth {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 20px;
}
.gridtd {
    background: #FFFFF0;
    vertical-align: middle;
    font-size: 14px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    background: #FAEBD7;
    border-collapse: collapse;
}

.grid td, table th {
  border: 1px solid black;
}

.kolom_header{
    height: 20px;
}

</style>

<?php 
$bulan_kas = date("m",strtotime($dt->TGL_TRX));

		if($bulan_kas == "01"){
	    $var = "I";
	   } else if($bulan_kas == "02"){
	    $var = "II";
	   } else if($bulan_kas == "03"){
	    $var = "III";
	   } else if($bulan_kas == "04"){
	    $var = "IV";
	   } else if($bulan_kas == "05"){
	    $var = "V";
	   } else if($bulan_kas == "06"){
	    $var = "VI";
	   } else if($bulan_kas == "07"){
	    $var = "VII";
	   } else if($bulan_kas == "08"){
	    $var = "VIII";
	   } else if($bulan_kas == "09"){
	    $var = "IX";
	   } else if($bulan_kas == "10"){
	    $var = "X";
	   } else if($bulan_kas == "11"){
	    $var = "XI";
	   } else if($bulan_kas == "12"){
	    $var = "XII";
	   }

$tahun_kas = date("Y",strtotime($dt->TGL_TRX));
?>

<br>
<table align="center">
    <tr>
        <td align="center">
            <h3 style="font-weight: bold;">
                LAPORAN PENERIMAAN BARANG
            </h3>
        </td>
        
    </tr>
    <tr>
    	<td align="left">
        	<h3 style="font-weight: bold;">
                PT. UNITED SHIPPING INDONESIA
            </h3>
        </td>
    </tr>
</table>
<br>
<br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Tanggal</td>
			<td style="width: 40%;text-align:left;font-size: 15px;">: <b><?=$dt->TGL_TRX;?></b></td>
			<td style="width: 40%;text-align:left;font-size: 15px;"><b>Supplier</b></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">No LPB</td>
			<td style="width: 40%;text-align:left;font-size: 15px;">: <?=$dt->NO_BUKTI;?>/SMD/<?php echo $var; ?>/<?php echo $tahun_kas; ?></td>
			<td  style="width:40%;text-align:left;font-size: 15px;"><?=$dt->SUPPLIER;?></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Refrensi No</td>
			<td style="width: 40%;text-align:left;font-size: 15px;">: PO <?=$dt->NO_PO;?>/BRU/<?php echo $var; ?>/<?php echo $tahun_kas; ?></td>
			<td  style="width:40%;text-align:left;font-size: 15px;"></td>
		</tr>
	</table>
</div>
<br>
<div>
<table style="border-collapse: collapse;border:1px solid black;">
	
		<tr>
			<th style="width: 15%;padding: 5px 5px 5px 5px;text-align: center; ">QTY</th>
			<th style="width: 15%;padding: 5px 5px 5px 5px;text-align: center; ">ITEM NO</th>
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">KETERANGAN</th>
			<th style="width: 15%;padding: 5px 5px 5px 5px;text-align: center; ">UNIT</th>
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">KETERANGAN</th>
			
		</tr>
	
		<tr>
			<?php 
				if($dt->PBBKB == '0'){

				}else{
					?>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;"></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;">PBBKB</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;">PBBKB</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;">Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;"></td>
					<?php 
				}
				?>
			</tr>
			
				<?php
			foreach ($dt_det as $key => $va) {
				?>
				<tr>
					<td style="padding: 5px;height: 150px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;text-align: center;"><?=$va->QTY;?></td>
					<td style="padding: 5px;height: 150px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;text-align: center;"><?=$va->ID_PRODUK;?> - SMD</td>
					<td style="text-align:center;padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"><?=$va->NAMA_PRODUK;?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;text-align: center;">Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"><?=$va->KETERANGAN;?></td>
				</tr>
				<?php
			}
			?>

			
</table>
<table style="width: 100%;">
	<tr>
		<td style="width: 30%;text-align: center;height: 50px;">Yang Membuat</td>
		<td style="width: 30%;text-align: center;">Accounting</td>
		<td style="width: 30%;text-align: center;">Manager</td>
	</tr>
	<tr>
		<td style="width: 30%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
		<td style="width: 30%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
		<td style="width: 30%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
	</tr>
</table>
</div>




<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Sales Order');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_sales_order.pdf');
?>