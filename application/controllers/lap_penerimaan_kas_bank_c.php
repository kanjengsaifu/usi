<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_penerimaan_kas_bank_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    // $this->load->model('lap_buku_besar_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$nomor_akun = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);
		$get_list_akun_bank = $this->master_model_m->get_list_akun_bank();

		if($this->input->post('pdf')){
			$this->cetak_laporan_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_laporan_xls();
		} 

		//$dt = $this->model->get_no_akun($keyword, $id_klien);

		$data =  array(
			'page' => "lap_penerimaan_kas_bank_v", 
			'title' => "Laporan Penerimaan Kas/Bank", 
			'msg' => "", 
			'master' => "laporan_keuangan", 
			'view' => "lap_penerimaan_kas_bank_c", 
			//'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'get_list_akun_bank' => $get_list_akun_bank, 
			'post_url' => 'lap_penerimaan_kas_bank_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak_laporan_pdf(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit   = $this->input->post('unit');
		$jns_laporan   = $this->input->post('jns_laporan');
		$view = "pdf/report_penerimaan_kas_bank_pdf";
		$dt = "";
		$judul = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);

		if($filter == "Harian"){
			$tgl_full = $this->input->post('tgl');
			if($tgl_full == ""){
				$tgl_full = date('d-m-Y')." sampai ".date('d-m-Y');
			}

			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];
			$judul =  date("d-F-Y", strtotime($tgl_awal))."  -  ".date("d-F-Y", strtotime($tgl_akhir));
			$judul_2 = "HARIAN";

			$sql = "
					SELECT a.TGL, a.NO_VOUCHER, a.URAIAN, a.KODE_AKUN, a.KONTAK, c.NAMA_AKUN, (a.DEBET + a.KREDIT) AS TOTAL FROM ak_input_voucher a 
					JOIN ak_kode_akuntansi c ON a.KODE_AKUN = c.KODE_AKUN
					WHERE a.DEBET > 0
					AND STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			      ";
			$dt = $this->db->query($sql)->result();
		
		} else if($filter == "Bulanan"){
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt $tahun";
			$judul_2 = "BULANAN";

			$sql = "
					SELECT a.TGL, a.NO_VOUCHER, a.URAIAN, a.KODE_AKUN, a.KONTAK, c.NAMA_AKUN, (a.DEBET + a.KREDIT) AS TOTAL FROM ak_input_voucher a 
					JOIN ak_kode_akuntansi c ON a.KODE_AKUN = c.KODE_AKUN
					WHERE a.DEBET > 0
					AND a.TGL LIKE '%-$bulan-$tahun%'
			      ";
			$dt = $this->db->query($sql)->result();

		} 



		$data = array(
			'title' 		=> 'LAPORAN PELUNASAN KAS/BANK ',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'judul_2'			=> $judul_2,
			'dt_unit'			=> $dt_unit,
			'jns_laporan'			=> $jns_laporan,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

	function cetak_laporan_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit   = $this->input->post('unit');
		$jns_laporan   = $this->input->post('jns_laporan');
		$view = "xls/report_penerimaan_kas_bank_xls";
		$dt = "";
		$judul = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);

		if($filter == "Harian"){
			$tgl_full = $this->input->post('tgl');
			if($tgl_full == ""){
				$tgl_full = date('d-m-Y')." sampai ".date('d-m-Y');
			}

			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];
			$judul =  date("d-F-Y", strtotime($tgl_awal))."  -  ".date("d-F-Y", strtotime($tgl_akhir));
			$judul_2 = "HARIAN";

			$sql = "
					SELECT a.TGL, a.NO_VOUCHER, a.URAIAN, a.KODE_AKUN, a.KONTAK, c.NAMA_AKUN, (a.DEBET + a.KREDIT) AS TOTAL FROM ak_input_voucher a 
					JOIN ak_kode_akuntansi c ON a.KODE_AKUN = c.KODE_AKUN
					WHERE a.DEBET > 0
					AND STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			      ";
			$dt = $this->db->query($sql)->result();
		
		} else if($filter == "Bulanan"){
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt $tahun";
			$judul_2 = "BULANAN";

			$sql = "
					SELECT a.TGL, a.NO_VOUCHER, a.URAIAN, a.KODE_AKUN, a.KONTAK, c.NAMA_AKUN, (a.DEBET + a.KREDIT) AS TOTAL FROM ak_input_voucher a 
					JOIN ak_kode_akuntansi c ON a.KODE_AKUN = c.KODE_AKUN
					WHERE a.DEBET > 0
					AND a.TGL LIKE '%-$bulan-$tahun%'
			      ";
			$dt = $this->db->query($sql)->result();

		} 



		$data = array(
			'title' 		=> 'LAPORAN PELUNASAN KAS/BANK ',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'judul_2'			=> $judul_2,
			'dt_unit'			=> $dt_unit,
			'jns_laporan'			=> $jns_laporan,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

	function cari_kode(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_no_akun($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_kode_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_kode_by_id($id);

		echo json_encode($dt);
	}

	function datetostr($var){

		 if($var == "01"){
		 	$var = "Januari";
		 } else if($var == "02"){
		 	$var = "Februari";
		 } else if($var == "03"){
		 	$var = "Maret";
		 } else if($var == "04"){
		 	$var = "April";
		 } else if($var == "05"){
		 	$var = "Mei";
		 } else if($var == "06"){
		 	$var = "Juni";
		 } else if($var == "07"){
		 	$var = "Juli";
		 } else if($var == "08"){
		 	$var = "Agustus";
		 } else if($var == "09"){
		 	$var = "September";
		 } else if($var == "10"){
		 	$var = "Oktober";
		 } else if($var == "11"){
		 	$var = "November";
		 } else if($var == "12"){
		 	$var = "Desember";
		 }

		 return $var;

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */