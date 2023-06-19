<?php 
class Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelGuruSlipGaji');
		$this->load->model('ModelGuruKehadiran');
		$this->load->model('ModelGuruGaji');

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
			$data_gaji = $this->db->query("SELECT * FROM data_kehadiran JOIN data_slip_gaji ON data_kehadiran.tanggal=data_slip_gaji.tanggal AND data_kehadiran.id_guru=data_slip_gaji.id_pegawai WHERE STATUS='diterima' AND id_pegawai='".$id."' AND data_slip_gaji.tanggal='".DATE('Y-m-',strtotime($data_tanggal)).'01'."'")->result();
		}
		else{
			$data_gaji = $this->db->query("SELECT * FROM data_kehadiran JOIN data_slip_gaji ON data_kehadiran.tanggal=data_slip_gaji.tanggal AND data_kehadiran.id_guru=data_slip_gaji.id_pegawai WHERE STATUS='diterima' AND id_pegawai='".$id."'")->result();
		}
		
		$data = [
			'title' => "Gaji",
			'pegawai' => $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai=".$id)->row(),
			'tanggal'=>$data_tanggal,
			'menu' => 'gaji',
			'sub_menu' => '',
			'gaji'=>$data_gaji,
		];

		// var_dump($data['gaji']);

		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/pegawai/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('pegawai/gaji',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
}
?>