<?php

class Data_Pegawai extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelAdminPegawai');

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				</div>
				');
			redirect('login');
		}
	}
	// clear
	public function _rules() {
		$this->form_validation->set_rules('nik','NUPTK','exact_length[16]');
		$this->form_validation->set_rules('nama','Nama Pegawai','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
		$this->form_validation->set_rules('akses','Tanggal Masuk','required');
	}
	// clear
	public function index()
	{
		$data=[
			'title' => "Data",
			'user' => $this->db->query("SELECT * FROM data_pegawai WHERE hak_akses!=3 AND id_pegawai!='".$this->session->userdata('id_pegawai')."'")->result(),
			'menu'=>'master_data',
			'sub_menu'=>'data_user',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_guru/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	// clear
	public function tambah()
	{
		$data=[
			'title' => "Tambah Data",
			'menu'=>'master_data',
			'sub_menu'=>'data_user',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_guru/tambah');

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	// clear
	public function tambah_aksi()
	{
		// var_dump($this->input->post(),$_FILES['foto']);
		$this->_rules();
		if ($this->form_validation->run()==FALSE) {
			$this->tambah();
		}
		else{
			$nik = $this->input->post('nik');
			$nama_pegawai = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$akses = $this->input->post('akses');
			$foto = $_FILES['foto']['name'];
			if ($foto!='') {
				$config['upload_path'] 		= './foto';
				$config['allowed_types'] 	= 'jpg|jpeg|png|tiff';
				$config['max_size']			= 2048;
				$config['file_name']		= 'pegawai-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('foto')){
					echo "Photo Gagal Diupload !";
				}else{
					$foto=$this->upload->data('file_name');
				}
			}
			$data = array(
				'nik'=>$nik,
				'nama_pegawai'=>$nama_pegawai,
				'username'=>$username,
				'password'=>$password,
				'jenis_kelamin'=>$jenis_kelamin,
				'hak_akses'=>$akses,
				'photo'=>$foto,
			);
			$this->ModelAdminPegawai->insert_data($data, 'data_pegawai');
			$this->session->set_flashdata('data user','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil ditambahkan</h4>
				</div>
				</div>
				');
			redirect('admin/master_data/data_pegawai');
		}
	}
	// clear
	public function update_data($id) 
	{
		$data=[
			'title' => "Update Data",
			'user' => $this->db->get_where('data_pegawai',array('id_pegawai'=>$id))->row(),
			'menu'=>'master_data',
			'sub_menu'=>'data_user',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_guru/update',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	// clear
	public function update_aksi() {
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->update_data($this->input->post('id_pegawai'));
		} else {
			$id_pegawai = $this->input->post('id_pegawai');
			$nik = $this->input->post('nik');
			$nama_pegawai = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$akses = $this->input->post('akses');
			$foto = $_FILES['foto']['name'];
			if($foto){
				$config['upload_path'] 		= './foto';
				$config['allowed_types'] 	= 'jpg|jpeg|png|tiff';
				$config['max_size']			= 	2048;
				$config['file_name']		= 	'pegawai-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$this->load->library('upload',$config);
				if($this->upload->do_upload('foto')){
					$foto=$this->upload->data('file_name');
					$this->db->set('photo',$foto);
				}else{
					echo $this->upload->display_errors();
				}
			}

			$data = array(
				'nik'=>$nik,
				'nama_pegawai'=>$nama_pegawai,
				'username'=>$username,
				'password'=>$password,
				'jenis_kelamin'=>$jenis_kelamin,
				'hak_akses'=>$akses,
				'photo'=>$foto,
			);

			$where = array(
				'id_pegawai' => $id_pegawai

			);

			$this->ModelAdminPegawai->update_data('data_pegawai', $data, $where);
			$this->session->set_flashdata('data user','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil diubah</h4>
				</div>
				</div>
				');
			redirect('admin/master_data/data_pegawai');
		}
	}
	// clear
	public function delete_data($id) {
		$where = array('id_pegawai' => $id);
		$this->ModelAdminPegawai->delete_data($where, 'data_pegawai');
		$this->session->set_flashdata('data user','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil dihapus</h4>
				</div>
				</div>
				');
		redirect('admin/master_data/data_pegawai');
	}
}
?>
