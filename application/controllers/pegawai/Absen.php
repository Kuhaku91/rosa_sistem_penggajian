<?php 
class Absen extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ModelGuruKehadiran');

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
		$get_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ;
		if ($get_tanggal!='') {	
			$convert_tanggal = explode('/',$get_tanggal);
			$data_tanggal = $convert_tanggal[2].'-'.$convert_tanggal[0].'-'.$convert_tanggal[1];
		}
		else{
			$data_tanggal = DATE('Y-m-d');
		}

		$id=$this->session->userdata('id_pegawai');

		if ($get_tanggal!='') {
			$tgl_sql = DATE('Y-m-',strtotime($data_tanggal)).'01';
			$data_absen = $this->db->query("SELECT * FROM data_kehadiran where id_guru='".$id."' AND tanggal='".DATE('Y-m-',strtotime($data_tanggal)).'01'."'")->result();
		}
		else{
			$data_absen = $this->db->query("SELECT * FROM data_kehadiran where id_guru='".$id."'")->result();
		}
		
		$data = [
			'title' => "Absen",
			'pegawai' => $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai=".$id)->row(),
			'tanggal'=>$data_tanggal,
			'menu' => 'absen',
			'sub_menu' => '',
			'absen'=> $data_absen,
		];

		// var_dump($data['absen']);

		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/pegawai/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('pegawai/absen',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
}
?>