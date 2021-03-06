<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_jurnal_umum_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_list_akun_all($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien
        ORDER BY KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_jurnal_umum($id_klien, $tgl_awal, $tgl_akhir, $unit){
        $sql = "      
        SELECT a.NO_VOUCHER, a.URAIAN, a.TGL, b.KODE_AKUN, b.DEBET, b.KREDIT, c.NAMA_AKUN FROM ak_input_voucher a 
        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        JOIN ak_kode_akuntansi c ON b.KODE_AKUN = c.KODE_AKUN
        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
        ORDER BY a.NO_VOUCHER ASC, b.DEBET DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_jurnal_umum_bulanan($id_klien, $bulan, $tahun, $unit){
        $sql = "      
        SELECT a.NO_VOUCHER, a.URAIAN, a.TGL, b.KODE_AKUN, b.DEBET, b.KREDIT, c.NAMA_AKUN FROM ak_input_voucher a 
        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        JOIN ak_kode_akuntansi c ON b.KODE_AKUN = c.KODE_AKUN
        WHERE a.TGL LIKE '%-$bulan-$tahun%'
        ORDER BY a.NO_VOUCHER ASC, b.DEBET DESC
        ";

        return $this->db->query($sql)->result();
    }
}

?>