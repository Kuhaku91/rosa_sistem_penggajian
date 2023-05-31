<?php 

class Data_Mapel extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan_mapel','<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
		$this->load->model('ModelMapel');
		$data=[
			'title' => "Data Gaji Mapel",
			'mapel' => $this->ModelMapel->get_data(),
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/mapel/data_mapel',$data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data()
	{
		$data=[
			'title' => "Tambah Data Mapel",
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/mapel/tambah_dataMapel', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi()
	{;
		$this->form_validation->set_rules('nama_mapel','Nama Mapel','required');
		$this->load->model('ModelMapel');
		if($this->form_validation->run()==FALSE){
			$this->tambah_data();
		}
		else{
			$data = [
				'nama_mapel' => $this->input->post('nama_mapel'),
			];
			$cek_insert = $this->ModelMapel->insert_data($data);
			if ($cek_insert) {
				$this->session->set_flashdata('pesan_mapel','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_mapel','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/data_mapel');
		}
	}

	public function update_data($id)
	{
		$this->load->model('ModelMapel');
		$data_id = $this->ModelMapel->get_data_id($id);
		$data = [
			'title'=>'Update Data Mapel',
			'id'=>$data_id->id,
			'nama_mapel'=>$data_id->nama_mapel,
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/mapel/update_dataMapel', $data);
		$this->load->view('template_admin/footer');
		// var_dump($data_id->id);
	}
	public function update_data_aksi()
	{
		$this->form_validation->set_rules('nama_mapel','Nama Mapel','required');
		$this->load->model('ModelMapel');
		if($this->form_validation->run()==FALSE){
			$this->update_data($this->input->post('id_mapel'));
		}
		else{
			$data = [
				'id' => $this->input->post('id_mapel'),
				'nama_mapel' => $this->input->post('nama_mapel'),
			];
			$update_data = $this->ModelMapel->update_data($data);
			if($update_data){
				$this->session->set_flashdata('pesan_mapel','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil diubah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_mapel','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal diubah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/data_mapel');
		}
	}
	public function delete_data($id)
	{
		$this->load->model('ModelMapel');
		$delete_data = $this->ModelMapel->delete_data($id);
		if($delete_data){
			$this->ModelMapel->reset_id();
			$this->session->set_flashdata('pesan_mapel','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		else{
			$this->session->set_flashdata('pesan_mapel','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data gagal dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect('admin/data_mapel');
	}
}

?>