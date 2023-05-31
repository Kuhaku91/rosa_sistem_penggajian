<?php 

class Data_Tunjangan extends CI_Controller{

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
		$this->load->model('ModelTunjangan');
		$data=[
			'title' => "Data Gaji Tunjangan",
			'tunjangan' => $this->ModelTunjangan->get_data(),
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tunjangan/data_tunjangan',$data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data()
	{
		$data=[
			'title' => "Tambah Data Tunjangan",
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tunjangan/tambah_dataTunjangan', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi()
	{;
		$this->form_validation->set_rules('nama_tunjangan','Nama Tunjangan','required');
		$this->load->model('ModelTunjangan');
		if($this->form_validation->run()==FALSE){
			$this->tambah_data();
		}
		else{
			$data = [
				'nama_gaji' => $this->input->post('nama_tunjangan'),
			];
			$cek_insert = $this->ModelTunjangan->insert_data($data);
			if ($cek_insert) {
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/data_tunjangan');
		}
	}

	public function update_data($id)
	{
		$this->load->model('ModelTunjangan');
		$data_id = $this->ModelTunjangan->get_data_id($id);
		$data = [
			'title'=>'Update Data Tunjangan',
			'id'=>$data_id->id,
			'nama_gaji'=>$data_id->nama_gaji,
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tunjangan/update_dataTunjangan', $data);
		$this->load->view('template_admin/footer');
		// var_dump($data_id->id);
	}
	public function update_data_aksi()
	{
		$this->form_validation->set_rules('nama_gaji','Nama Tunjangan','required');
		$this->load->model('ModelTunjangan');
		if($this->form_validation->run()==FALSE){
			$this->update_data($this->input->post('id_tunjangan'));
		}
		else{
			$data = [
				'id' => $this->input->post('id_tunjangan'),
				'nama_gaji' => $this->input->post('nama_gaji'),
			];
			$update_data = $this->ModelTunjangan->update_data($data);
			if($update_data){
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil diubah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal diubah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/data_tunjangan');
		}
	}
	public function delete_data($id)
	{
		$this->load->model('ModelTunjangan');
		$delete_data = $this->ModelTunjangan->delete_data($id);
		if($delete_data){
			$this->ModelTunjangan->reset_id();
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		else{
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data gagal dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect('admin/data_tunjangan');
	}
}

?>