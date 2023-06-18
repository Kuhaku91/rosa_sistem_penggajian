<?php

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

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
		$pegawai_admin = $this->db->query("SELECT * FROM data_pegawai WHERE hak_akses !='3' AND id_pegawai!='".$this->session->userdata('id_pegawai')."'");

		$data =[
			'title' => "Dashboard",
			'pegawai_admin' => $pegawai_admin->num_rows(),
			'menu' => 'dashboard',
			'sub_menu' => '',
		];
		// var_dump($data,$this->session->userdata('id_pegawai'));
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/dashboard',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
}

?>