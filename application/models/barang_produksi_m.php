<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_produksi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_produk($keyword, $id_klien){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "a.UNIT = ".$user->UNIT;
        }


        $sql = "
        SELECT a.*, b.ID AS ID_PRODUKSI, c.NAMA_AKUN, b.KODE_AKUN FROM ak_produk a
        JOIN ak_barang_produksi b ON a.ID = b.ID_ITEM
        LEFT JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND c.UNIT = '$user->UNIT'
        WHERE $where_unit AND a.APPROVE = 3
        ORDER BY b.ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_produk2($keyword, $id_klien){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "UNIT = ".$user->UNIT;
        }


        $sql = "
        SELECT * FROM ak_produk
        WHERE $where_unit AND APPROVE = 3 AND ID NOT IN (SELECT ID_ITEM FROM ak_barang_produksi) AND TIPE = 'JADI'
        ORDER BY APPROVE ASC, ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_produk($id){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        if($user->LEVEL == 'USER'){
            $sql = "UPDATE ak_produk SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_produk WHERE ID = $id"; 
            $this->db->query($sql);
        }
    }

    function cari_produk_by_id($id){
        $sql = "
        SELECT * FROM ak_produk WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function simpan_produk($id_klien, $kode_produk, $nama_produk, $satuan, $deskripsi, $harga_jual, $harga_beli, $unit, $ppn, $pph, $service){

        if($satuan == "" || $satuan == null){
            $satuan = "-";
        }

        if($deskripsi == "" || $deskripsi == null){
            $deskripsi = "-";
        }

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 0;
        }


        $sql = "
        INSERT INTO ak_produk
        (ID_KLIEN, KODE_PRODUK, NAMA_PRODUK, SATUAN, DESKRIPSI, HARGA_JUAL, HARGA, APPROVE, UNIT, PPH, PPN, SERVICE)
        VALUES 
        ($id_klien, '$kode_produk', '$nama_produk', '$satuan', '$deskripsi', '$harga_jual', '$harga_beli', '$approve', '$unit', '$pph', '$ppn', '$service')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_produk($id_produk, $kode_produk_ed, $nama_produk_ed, $satuan_ed, $deskripsi_ed, $harga_jual, $harga_beli, $ppn_ed, $pph_ed, $service_ed){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_produk SET 
        KODE_PRODUK = '$kode_produk_ed', NAMA_PRODUK = '$nama_produk_ed', SATUAN = '$satuan_ed', 
        DESKRIPSI = '$deskripsi_ed', HARGA = '$harga_beli', HARGA_JUAL = '$harga_jual', APPROVE = '$approve',
        PPN = '$ppn_ed', PPH = '$pph_ed', SERVICE = '$service_ed'
        WHERE ID = $id_produk
        ";

        $this->db->query($sql);
    }

    function simpan_produksi($kode_akun, $item, $unit){
        $sql = "
        INSERT INTO ak_barang_produksi
        (ID_ITEM, UNIT, KODE_AKUN)
        VALUES 
        ('$item', '$unit', '$kode_akun')
        ";

        $this->db->query($sql);
    }

    function ubah_produksi($id_produksi, $item, $unit){
        $sql = "
        UPDATE ak_barang_produksi SET ID_ITEM = '$item'
        WHERE ID = '$id_produksi'
        ";

        $this->db->query($sql);
    }

    function simpan_produksi_detail($id_produksi, $id_bahan, $satuan, $qty){

        $qty = str_replace(',', '', $qty);

        $sql = "
        INSERT INTO ak_barang_produksi_detail
        (ID_PRODUKSI, ID_BAHAN, SATUAN, QTY)
        VALUES 
        ('$id_produksi', '$id_bahan', '$satuan', '$qty')
        ";

        $this->db->query($sql);
    }

    function get_barang_baku($id){
        $sql = "
        SELECT b.*, a.QTY FROM ak_barang_produksi_detail a
        JOIN ak_produk b ON a.ID_BAHAN = b.ID
        WHERE a.ID_PRODUKSI = '$id' 
        ";
        return $this->db->query($sql)->result();
    }

    function get_data_barang_produksi_by_id($id_produksi){
        $sql = "
        SELECT a.*, b.NAMA_PRODUK FROM ak_barang_produksi a 
        LEFT JOIN ak_produk b ON a.ID_ITEM = b.ID
        WHERE a.ID = '$id_produksi' 
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_barang_produksi_detail_by_id($id_produksi){
        $sql = "
        SELECT a.*, b.NAMA_PRODUK, b.KODE_PRODUK, b.STOK FROM ak_barang_produksi_detail a 
        LEFT JOIN ak_produk b ON a.ID_BAHAN = b.ID
        WHERE a.ID_PRODUKSI = '$id_produksi' 
        ";

        return $this->db->query($sql)->result();
    }

}

?>