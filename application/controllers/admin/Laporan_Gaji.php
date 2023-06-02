<?php

class Laporan_Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelJadwal');
		$this->load->model('ModelPegawai');
		$this->load->model('ModelJabatan');
		$this->load->model('ModelTunjangan_Guru');
		$this->load->model('ModelGaji');

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		}
	}

	public function index() 
	{	
		$data=[
			'title' => "Laporan Gaji Pegawai",
			'pegawai' => $this->ModelPenggajian->get_data('data_pegawai')->result(),
		];

		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/laporan_gaji',$data);
		$this->load->view('template_admin/footer');
	}

	public function cetak_laporan_gaji(){

		$data['title'] = "Cetak Laporan Gaji Pegawai";
		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$data['cetak_gaji'] = $this->db->query("SELECT data_pegawai.nik,data_pegawai.nama_pegawai,
			data_pegawai.jenis_kelamin,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,
			data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha FROM data_pegawai
			INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
			WHERE data_kehadiran.bulan='$bulantahun'
			ORDER BY data_pegawai.nama_pegawai ASC")->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/gaji/cetak_gaji', $data);
	}

	public function cetak_gaji($id)
	{
		//data bulan dan tahun
		$this->db->select('year(tanggal) as tahun, month(tanggal) as bulan');
		$this->db->from('data_jadwal');
		$this->db->where('id_guru',$id);
		$this->db->group_by('tahun,bulan');
		$this->db->order_by('bulan','desc');
		$this->db->order_by('tahun','desc');
		$data_bulan_tahun = $this->db->get()->result();


		$data_gaji_tunjangan = 0;
		foreach ($this->ModelTunjangan_Guru->get_data($id) as $key => $value) {
			$data_gaji_tunjangan+=$value->jumlah;
		}

		$data = [
			'title'=>"List Gaji",
			// 'guru'=>$this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai='$id'")->result(),
			'guru'=>$this->ModelPegawai->find($id),
			'data_gaji'=>$data_bulan_tahun,
			'gaji_jabatan'=>$this->ModelJabatan->where('nama_jabatan',$this->ModelPegawai->find($id)->jabatan)->row(),
			'data_gaji_tunjangan'=>$data_gaji_tunjangan,
		];

		// var_dump($data['data_gaji_tunjangan']);

		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/list_gaji',$data);
		$this->load->view('template_admin/footer');
	}
	public function ajukan_gaji($id_pegawai,$tahun,$bulan){
		$data = [
			'id_pegawai'=>$id_pegawai,
			'cetak'=>$tahun."-".$bulan.'-01',
		];
		if($this->ModelGaji->insert($data)){
			$this->session->set_flashdata('pesan_slip_gaji','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data slip gaji berhasil diajukan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/laporan_gaji/cetak_gaji/'.$id_pegawai);
		}
		else{
			$this->session->set_flashdata('pesan_slip_gaji','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data slip gaji gagal diajukan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/laporan_gaji/cetak_gaji/'.$id_pegawai);
		}
	}
	public function print_gaji($id_pegawai,$tahun,$bulan)
	{
		$c_gaji_tambahan = 1;
		$j_gaji_tambahan = 0;
		$gaji_tambahan = $this->ModelTunjangan_Guru->get_data($id_pegawai);
		foreach ($gaji_tambahan as $key => $value) {
			$c_gaji_tambahan++;
			$j_gaji_tambahan+=$value->jumlah;
		}
		$c_gaji_potongan = 1;
		$j_gaji_potongan = 0;
		$gaji_potongan = $this->ModelJadwal->gaji_tambahan($id_pegawai,$tahun,$bulan);
		foreach($gaji_potongan->result() as $key_gp => $value_gp ){
			if ($value_gp->hadir!="Hadir") {
				$c_gaji_potongan++;
				$j_gaji_potongan+=$value_gp->jml_potongan;
			}
		}
		$data = [
			'gaji_pokok'=>$this->ModelJabatan->pegawai_id($id_pegawai)->row(),
			'c_gaji_tambahan'=>$c_gaji_tambahan,
			'gaji_tambahan'=>$gaji_tambahan,
			'c_gaji_potongan'=>$c_gaji_potongan,
			'gaji_potongan'=>$gaji_potongan,
		];
		// var_dump($data['gaji_potongan']);
		// var_dump($gaji_potongan);
		$this->load->view('admin/gaji/print_gaji',$data);
	}
}

?>