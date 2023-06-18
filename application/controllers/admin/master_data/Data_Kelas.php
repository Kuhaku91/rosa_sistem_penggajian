<?php 

class Data_Kelas extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelAdminKelas');

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan_kelas','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil ditambahkan</h4>
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
			'kelas' => $this->db->query("SELECT * FROM data_kelas")->result(),
			'menu'=>'master_data',
			'sub_menu'=>'data_kelas',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_kelas/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}

	public function tambah()
	{
		$data=[
			'title' => "Tambah Data",
			'menu'=>'master_data',
			'sub_menu'=>'data_kelas',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_kelas/tambah');

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}

	public function tambah_aksi()
	{
		$this->form_validation->set_rules('nama_kelas','Nama Kelas','required');
		if($this->form_validation->run()==FALSE){
			$this->tambah();
		}
		else{
			$data = [
				'nama_kelas' => $this->input->post('nama_kelas'),
			];
			$cek_insert = $this->ModelAdminKelas->insert_data($data,'data_kelas');
			if ($cek_insert) {
				$this->session->set_flashdata('pesan_kelas','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil ditambahkan</h4>
				</div>
				</div>
				');
			}
			else{
				$this->session->set_flashdata('pesan_kelas','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data gagal ditambahkan</h4>
				</div>
				</div>
				');
			}
			redirect('admin/master_data/data_kelas');
		}
	}

	public function update_data($id)
	{
		$data=[
			'title' => "Update Data",
			'kelas' => $this->db->get_where('data_kelas',array('id'=>$id))->row(),
			'menu'=>'master_data',
			'sub_menu'=>'data_kelas',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_kelas/update',$data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function update_aksi()
	{
		$this->form_validation->set_rules('nama_kelas','Nama Kelas','required');
		if($this->form_validation->run()==FALSE){
			$this->update_data($this->input->post('id'));
		}
		else{
			$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
			);
			$where = array(
				'id' => $this->input->post('id'),
			);
			$update_data = $this->ModelAdminKelas->update_data('data_kelas',$data,$where);
			if($update_data){
				$this->session->set_flashdata('pesan_kelas','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil diubah</h4>
				</div>
				</div>
				');
			}
			else{
				$this->session->set_flashdata('pesan_kelas','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data gagal diubah</h4>
				</div>
				</div>
				');
			}
			redirect('admin/master_data/data_kelas');
		}
	}
	public function delete_data($id)
	{
		$where = array('id' => $id);
		$this->ModelAdminKelas->delete_data($where, 'data_kelas');
		$this->session->set_flashdata('pesan_kelas','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil dihapus</h4>
				</div>
				</div>
				');
		redirect('admin/master_data/data_kelas');
	}
}

?>