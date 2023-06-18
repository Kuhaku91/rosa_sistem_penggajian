<?php

class Slip_Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelJadwal');
		$this->load->model('ModelPegawai');
		$this->load->model('ModelJabatan');
		$this->load->model('ModelTunjangan_Guru');
		$this->load->model('ModelGaji');

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
		$data = [
			'title'=> 'Slip Gaji Pegawai',
			'pegawai'=> $this->ModelPenggajian->get_data_pegawai('data_pegawai')->result(),
		];

		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/kepsek/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('kepsek/slip_gaji/index',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function cetak_gaji($id)
	{
		$data = [
			'title'=>"List Gaji",
			'guru'=>$this->ModelPegawai->find($id),
		];

		// var_dump($data);

		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/kepsek/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('kepsek/slip_gaji/list_gaji',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function acc($id_pegawai,$tahun,$bulan)
	{
		$data = [
			'id_pegawai'=>$id_pegawai,
			'cetak'=>$tahun."-".$bulan."-01",
			'status'=>"diterima",
		];
		// var_dump($data);
		$update = $this->ModelGaji->update($data);
		if ($update) {
			$this->session->set_flashdata('pesan_slip_gaji','<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				Gaji berhasil Disetujui!.
				</div>');
		}
		else{
			$this->session->set_flashdata('pesan_slip_gaji','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Gaji gagal Disetujui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect('kepsek/slip_gaji/cetak_gaji/'.$id_pegawai);
	}
}

?>