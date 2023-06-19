<?php 
class Jadwal extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelGuruJadwal');

		if($this->session->userdata('hak_akses') != '2'){
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
		$get_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : DATE('m/d/Y') ;
		$convert_tanggal = explode('/',$get_tanggal);
		$data_tanggal = $convert_tanggal[2].'-'.$convert_tanggal[0].'-'.$convert_tanggal[1];
		$get_kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
		
		$id=$this->session->userdata('id_pegawai');
		$data = [
			'title' => "Jadwal",
			'menu' => 'jadwal',
			'sub_menu' => '',
			'pegawai' => $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai=".$id)->row(),
			'tanggal'=>$data_tanggal,
			'kelas'=>$get_kelas,
			'data_kelas'=>$this->db->query("select * from data_kelas")->result(),
			'data_mapel'=>$this->db->query("select * from data_mapel")->result(),
		];

		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/pegawai/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('pegawai/jadwal',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
}
?>