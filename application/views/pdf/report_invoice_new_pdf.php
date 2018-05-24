<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<head>

  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Cetak Penawaran Beli</title>
  

  
  
  <style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 10mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    p{
        margin-top: 1px !important;
    	margin-bottom: 1px !important;
    }
  </style>
 <script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
  </head>
<body>
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

<font face="helvetica">
<div class="page">
<table style="width: 100%">
	<tr>
		<td><img style="width: 100%;height: 130px;" src="<?=$base_url2;?>assets/header_warna.png"></td>
	</tr>
	
</table>


<br>

<h2 align="center"><u>INOVICE</u></h2>

<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
  <table style="width: 100%;">
    <tr>
      <td style="width: 20%;text-align:left;font-size: 15px;">Tanggal</td>
      <td style="width: 40%;text-align:left;font-size: 15px;">: <b><?=$dt->TGL_TRX;?></b></td>
      <td style="width: 40%;text-align:left;font-size: 15px;"><b>Kepada Yth</b></td>
    </tr>
    <tr>
      <td style="width: 20%;text-align:left;font-size: 15px;">NO </td>
      <td style="width: 40%;text-align:left;font-size: 15px;">: <?=$dt->NO_INV;?>/SMD/<?php echo $var; ?>/<?php echo $tahun_kas; ?></td>
      <td  style="width:40%;text-align:left;font-size: 15px;"><?=$dt->PELANGGAN;?><br><?=$dt->ALAMAT;?></td>
    </tr>
    <tr>
      <td style="width: 20%;text-align:left;font-size: 15px;">Refrensi No</td>
      <td style="width: 40%;text-align:left;font-size: 15px;">: </td>
      <td  style="width:40%;text-align:left;font-size: 15px;"></td>
    </tr>
  </table>
</div>
<br>
<div>
<table style="border-collapse: collapse;">
  
    <tr>
      <th style="width: 25%;padding: 10px 10px 10px 10px;text-align: center;border-right: 1px solid black;border-top: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; ">KETERANGAN</th>
      <th style="width: 15%;padding: 10px 10px 10px 10px;text-align: center;border-right: 1px solid black;border-top: 1px solid black; border-bottom: 1px solid black;">QTY</th>
      <th style="width: 15%;padding: 10px 10px 10px 10px;text-align: center; border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">Harga (Rp.)</th>
      <th style="width: 15%;padding: 10px 10px 10px 10px;text-align: center;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black; ">Jumlah (Rp.)</th>
      
    </tr>
  
   <!--  <tr>
      <?php 
        if($dt->PBBKB == '0'){

        }else{
          ?>
          <td style="padding: 5px;border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;">PBBKB</td>
          <td style="padding: 5px;border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;text-align: center;">10%</td>
          <td style="padding: 5px;border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;text-align: center;">Rp. <?php echo number_format($dt->PBBKB,2); ?></td>
          <td style="padding: 5px;border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;text-align: center;">Rp. <?php echo number_format($dt->PBBKB,2); ?></td>
          <?php 
        }
        ?>
      </tr> -->
      
        <?php
      foreach ($dt_deti as $key => $va) {
        ?>
        <tr>
          <td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;vertical-align: top;"><?=$va->NAMA_PRODUK;?></td>
          <td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;vertical-align: top;"><?php echo number_format($va->QTY,2);?> Ltr</td>
          <td style="text-align:center;padding: 5px;border-left: 1px solid black;border-right: 1px solid black;vertical-align: top;text-align: right;"><?php echo number_format($va->TOTAL / $va->QTY,2);?></td>
          <td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;vertical-align: top;text-align: right;"><?php echo number_format($va->TOTAL,2);?></td>
        </tr>
        <?php
       
      }
      ?>
      
      <?php 
        if($dt->OAT == '0' || $dt->OAT == ''){

        }else{
          $oati_sat = $dt->OAT / $va->QTY;
          ?>
          <tr>
          <td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;vertical-align: top;">Transportasi FEE</td>
          <td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;vertical-align: top;"><?php echo number_format($va->QTY,2);?> Ltr</td>
          <td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;text-align: right;vertical-align: top;"><?=number_format($oati_sat, 2);?></td>
          <td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;text-align: right;vertical-align: top;"><?=number_format($dt->OAT, 2);?></td>
          </tr>
          <?php 
        }
        ?>
        <tr>
          <td style="padding: 5px;height:300px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"></td>
          <td style="padding: 5px;height:300px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"></td>
          <td style="padding: 5px;height:300px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"></td>
          <td style="padding: 5px;height:300px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"></td>
        </tr>

      
      <tr>
      
      <td style="border-left: none !important;" colspan="2"> Terbilang : <?php echo ucwords(kekata($dt->SUB_TOTAL + $dt->PPN + $oati)); ?> Rupiah</td>
      <td style="border-right:1px solid black;padding: 5px;text-align: right;">Sub Total<br>PPN<br>Total</td>
      <td style="border:1px solid black;padding: 5px;text-align: right;"><?=number_format($dt->SUB_TOTAL + $oati, 2);?><br><?=number_format($dt->PPN, 2);?><br><?php echo number_format($dt->SUB_TOTAL + $dt->PPN + $dt->OAT, 2); ?></td>
    </tr>

      
</table>

</div>
<br>
<div style="width: 100%;">
  <table style="width: 100%;">
    <tr>
      <td>
        1.Pembayaran harap ditransfer ke : <br>
        <strong>Bank Standart Chartered</strong><br>
        <strong>Cabang Basuki rahmad Surabaya</strong><br>
        <strong>No Rekening :</strong><br>
        <strong>Atas Nama : PT.UNITED SHIPPING INDONESIA</strong><br><br>
        2.Pembayaran dengan uang kontan hanya sah <br>
        apabilai ada kwitansi resmi dair Perusahaan<br>
        3.Pembayaran dengan Bilyet Giro/Cheque <br>dianggap sah apablia sudah masuk di Bank Kami
      </td>
      <td>
        PT UNITED SHIPPING INDONESIA<br><br><br><br><br><br><br><br><br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Herman Kwandy</strong>
      </td>
    </tr>
  </table>
</div>
</font>
</body>


<?PHP 
function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}


function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}
?>