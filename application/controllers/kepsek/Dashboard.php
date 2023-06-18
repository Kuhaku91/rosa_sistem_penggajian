<?php

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '3'){
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
		$pegawai = $this->db->query("SELECT * FROM data_pegawai");
		$admin = $this->db->query("SELECT * FROM data_pegawai WHERE hak_akses=1");
		$kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
		
		$data =[
			'title' => "Dashboard",
			'pegawai' => $pegawai->num_rows(),
			'admin' => $admin->num_rows(),
			'kehadiran' => $kehadiran->num_rows(),
		];
		// var_dump($data['status']);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/kepsek/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('kepsek/dashboard',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
}

?>