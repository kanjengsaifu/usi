<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<style>
.gridth {
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 15px;
}
.gridtd {
    vertical-align: middle;
    font-size: 14px;
    height: 15px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td{
  border-left: 1px solid black;
  border-right: : 1px solid black;
}

.kolom_header{
    height: 20px;
    padding-left: 5px;
    padding-right: 5px;
    font-size: 14px;
}

</style>

<?PHP 
    $voc_now = "";
    $old_voc = "";
?>


<table align="center" style="width:100%;">
    <tr>
        <td align="center">
            <h3>
                JURNAL MEMORIAL <br>
                <?=strtoupper($judul);?> <br>    
            </h3>
        </td>
    </tr>
</table>

<?PHP if(count($data) > 0){ ?>
<table align="center" class="grid" style="width:100%;">
    <tr>
        <th style='text-align:center; width:15%;' class='kolom_header'> TANGGAL </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> NO AKUN </th>
        <th style='text-align:center; width:35%;' class='kolom_header'> KETERANGAN </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> DEBET </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> KREDIT </th>
    </tr>
    <?PHP 
    $no = 0;
    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;

    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;

    $totalDebet = 0;
    $totalKredit = 0;

    foreach ($data as $key => $row) {
        $totalDebet += $row->DEBET;
        $totalKredit += $row->KREDIT;

        $nilDebet  = format_akuntansi($row->DEBET);
        $nilKredit = format_akuntansi($row->KREDIT);

        if($nilDebet == 0){
            $nilDebet = '';
        }

        if($nilKredit == 0){
            $nilKredit = '';
        }

        $no++;   
        if($no == 1){
            echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$row->TGL."</td>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$row->KODE_AKUN."</td>" ;
                echo "<td class='gridtd'>".$row->NAMA_AKUN."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".$nilDebet."</td>" ; 
                echo "<td class='gridtd' style='text-align:right;'>".$nilKredit."</td>" ; 
            echo "</tr>" ; 
        } else {
            echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$row->KODE_AKUN."</td>" ;
                echo "<td class='gridtd'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row->NAMA_AKUN."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".$nilDebet."</td>" ; 
                echo "<td class='gridtd' style='text-align:right;'>".$nilKredit."</td>" ; 
            echo "</tr>" ; 
        }
        

        if($row->NO_VOUCHER != $old_voc && $old_voc != ""){
            $no = 0;
            echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
            echo "</tr>" ;
        }

        $old_voc = $row->NO_VOUCHER;
    }
    ?>

    <?PHP 
    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;
    ?>

    <tr>
        <th style='text-align:center; width:15%;' class='kolom_header'></th>
        <th style='text-align:center; width:15%;' class='kolom_header'></th>
        <th style='text-align:left; width:35%;' class='kolom_header'><b>JUMLAH</b></th>
        <th style='text-align:right; width:15%;' class='kolom_header'><b><?=format_akuntansi($totalDebet);?></b></th>
        <th style='text-align:right; width:15%;' class='kolom_header'><b><?=format_akuntansi($totalKredit);?></b></th>
    </tr>
</table>

<?PHP } else if(count($data) == 0){ ?>

<table align="center" class="grid" style="width:100%;">
    <tr>
        <td class='gridtd'  align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
    </tr>
</table>

<?PHP } ?>

<?PHP 
    function format_akuntansi($value)
    {
        if($value > 0){
            $value = number_format($value, 2);
        } else if($value == 0){
            $value = 0;
        } else {
            $value = number_format(abs($value), 2);
        }

        return $value;
    }
?>

<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 17.4;
    $height_in_mm = $height_in_inches * 22.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Jurnal Memorial');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_jurnal_memorial.pdf');
?>