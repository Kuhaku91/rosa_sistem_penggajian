<?php 

class Data_Mapel extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelAdminMapel');

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan_mapel','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil dihapus</h4>
				</div>
				</div>
				');
			redirect('login');
		}
	}

	public function index() 
	{
		$data=[
			'title' => "Data",
			'mapel' => $this->db->query("SELECT * FROM data_mapel")->result(),
			'menu'=>'master_data',
			'sub_menu'=>'data_mapel',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_mapel/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}

	public function tambah()
	{
		$data=[
			'title' => "Tambah Data",
			'menu'=>'master_data',
			'sub_menu'=>'data_mapel',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_mapel/tambah');

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}

	public function tambah_aksi()
	{
		$this->form_validation->set_rules('nama_mapel','Nama Mapel','required');
		if($this->form_validation->run()==FALSE){
			$this->tambah();
		}
		else{
			$data = [
				'nama_mapel' => $this->input->post('nama_mapel'),
			];
			$cek_insert = $this->ModelAdminMapel->insert_data($data,'data_mapel');
			if ($cek_insert) {
				$this->session->set_flashdata('pesan_mapel','
					<div class="col-xs-12">
					<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data berhasil ditambahkan</h4>
					</div>
					</div>
					');
			}
			else{
				$this->session->set_flashdata('pesan_mapel','
					<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data gagal ditambahkan</h4>
					</div>
					</div>
					');
			}
			redirect('admin/master_data/data_mapel');
		}
	}

	public function update_data($id)
	{
		$data=[
			'title' => "Update Data",
			'mapel' => $this->db->get_where('data_mapel',array('id'=>$id))->row(),
			'menu'=>'master_data',
			'sub_menu'=>'data_user',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_mapel/update',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function update_aksi()
	{
		$this->form_validation->set_rules('nama_mapel','Nama Mapel','required');
		if($this->form_validation->run()==FALSE){
			$this->update_data($this->input->post('id'));
		}
		else{
			$data = array(
				'nama_mapel' => $this->input->post('nama_mapel'),
			);
			$where = array(
				'id' => $this->input->post('id'),
			);
			$update_data = $this->ModelAdminMapel->update_data('data_mapel',$data,$where);
			if($update_data){
				$this->session->set_flashdata('pesan_mapel','
					<div class="col-xs-12">
					<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data berhasil ubah</h4>
					</div>
					</div>
					');
			}
			else{
				$this->session->set_flashdata('pesan_mapel','
					<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data berhasil diubah</h4>
					</div>
					</div>
					');
			}
			redirect('admin/master_data/data_mapel');
		}
	}
	public function delete_data($id)
	{
		$where = array('id' => $id);
		$this->ModelAdminMapel->delete_data($where, 'data_mapel');
		$this->session->set_flashdata('pesan_mapel','
			<div class="col-xs-12">
			<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>Data berhasil dihapus</h4>
			</div>
			</div>
			');
		redirect('admin/master_data/data_mapel');
	}
}

?>