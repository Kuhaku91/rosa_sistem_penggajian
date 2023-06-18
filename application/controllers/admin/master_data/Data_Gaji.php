<?php 

class Data_Gaji extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelAdminGaji');

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan_gaji','<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
			'title' => "Data",
			'gaji_pokok' => $this->ModelAdminGaji->cek_gaji_pokok()->nominal,
			'potongan' => $this->db->query("SELECT * FROM data_potongan_gaji")->result(),
			'gaji' => $this->db->query("SELECT * FROM data_gaji")->result(),
			'menu'=>'master_data',
			'sub_menu'=>'data_gaji',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_gaji/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}

	public function tambah()
	{
		$data=[
			'title' => "Tambah Data",
			'menu'=>'master_data',
			'sub_menu'=>'data_gaji',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_gaji/tambah');

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}

	public function tambah_aksi()
	{
		$this->form_validation->set_rules('nama_gaji','Nama Gaji','required');
		$this->form_validation->set_rules('nominal','Nominal Gaji','required');
		if($this->form_validation->run()==FALSE){
			$this->tambah();
		}
		else{
			$data = [
				'nama_gaji' => $this->input->post('nama_gaji'),
				'nominal' => $this->input->post('nominal'),
			];
			$cek_insert = $this->ModelAdminGaji->insert_data($data,'data_gaji');
			// var_dump($cek_insert);
			if ($cek_insert) {
				$this->session->set_flashdata('pesan_gaji','
					<div class="col-xs-12">
					<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data berhasil ditambahkan</h4>
					</div>
					</div>
					');
			}
			else{
				$this->session->set_flashdata('pesan_gaji','
					<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data gagal ditambahkan</h4>
					</div>
					</div>
					');
			}
			redirect('admin/master_data/data_gaji');
		}
	}

	public function update_data($id)
	{
		$data=[
			'title' => "Update Data",
			'gaji' => $this->db->get_where('data_gaji',array('id'=>$id))->row(),
			'menu'=>'master_data',
			'sub_menu'=>'data_gaji',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_gaji/update',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function update_aksi()
	{
		$this->form_validation->set_rules('nama_gaji','Nama Gaji','required');
		$this->form_validation->set_rules('nominal','Nominal Gaji','required');
		if($this->form_validation->run()==FALSE){
			$this->update_data($this->input->post('id'));
		}
		else{
			$data = [
				'nama_gaji' => $this->input->post('nama_gaji'),
				'nominal' => $this->input->post('nominal'),
			];
			$where = array(
				'id' => $this->input->post('id'),
			);
			$update_data = $this->ModelAdminGaji->update_data('data_gaji',$data,$where);
			// var_dump($update_data);
			if($update_data){
				$this->session->set_flashdata('pesan_gaji','
					<div class="col-xs-12">
					<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data berhasil diubah</h4>
					</div>
					</div>
					');
				redirect('admin/master_data/data_gaji');
			}
			else{
				$this->session->set_flashdata('pesan_gaji','
					<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data gagal diubah</h4>
					</div>
					</div>
					');
				redirect('admin/master_data/data_gaji');
			}
		}
	}
	public function delete_data($id)
	{
		$where = array('id' => $id);
		$delete_data = $this->ModelAdminGaji->delete_data($where, 'data_gaji');
		// var_dump($delete_data);
		if ($delete_data) {
			$this->session->set_flashdata('pesan_gaji','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil dihapus</h4>
				</div>
				</div>
				');
		}
		redirect('admin/master_data/data_gaji');
	}
	public function gaji_pokok()
	{
		$where = array('id' => 1);
		$data = [
			'nominal'=>$this->input->post('gaji_pokok'),
		];
		$update_data = $this->ModelAdminGaji->update_data_gaji_pokok('data_gaji_pokok',$data,$where);
		if($update_data){
			$this->session->set_flashdata('pesan_gaji_pokok','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil diubah</h4>
				</div>
				</div>
				');
			redirect('admin/master_data/data_gaji');
		}
		else{
			$this->session->set_flashdata('pesan_gaji_pokok','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data gagal diubah</h4>
				</div>
				</div>
				');
			redirect('admin/master_data/data_gaji');
		}
	}
	public function potongan_gaji($id)
	{
		$where = array('id' => $id);
		$data = [
			'nominal'=>$this->input->post('potong_gaji'),
		];
		$update_data = $this->ModelAdminGaji->update_data_potongan_gaji('data_potongan_gaji',$data,$where);
		if($update_data){
			$this->session->set_flashdata('pesan_potongan_gaji','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil diubah</h4>
				</div>
				</div>
				');
			redirect('admin/master_data/data_gaji');
		}
		else{
			$this->session->set_flashdata('pesan_potongan_gaji','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data gagal diubah</h4>
				</div>
				</div>
				');
			redirect('admin/master_data/data_gaji');
		}
	}
}

?>