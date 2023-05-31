<?php 

class Data_Kelas extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan_kelas','<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
		$this->load->model('ModelKelas');
		$data=[
			'title' => "Data Gaji Kelas",
			'mapel' => $this->ModelKelas->get_data(),
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/kelas/data_kelas',$data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data()
	{
		$data=[
			'title' => "Tambah Data Kelas",
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/kelas/tambah_datakelas', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi()
	{;
		$this->form_validation->set_rules('nama_kelas','Nama Kelas','required');
		$this->load->model('ModelKelas');
		if($this->form_validation->run()==FALSE){
			$this->tambah_data();
		}
		else{
			$data = [
				'nama_kelas' => $this->input->post('nama_kelas'),
			];
			$cek_insert = $this->ModelKelas->insert_data($data);
			if ($cek_insert) {
				$this->session->set_flashdata('pesan_kelas','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_kelas','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/data_kelas');
		}
	}

	public function update_data($id)
	{
		$this->load->model('ModelKelas');
		$data_id = $this->ModelKelas->get_data_id($id);
		$data = [
			'title'=>'Update Data Kelas',
			'id'=>$data_id->id,
			'nama_kelas'=>$data_id->nama_kelas,
		];

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/kelas/update_datakelas', $data);
		$this->load->view('template_admin/footer');
		// var_dump($data_id->id);
	}
	public function update_data_aksi()
	{
		$this->form_validation->set_rules('nama_kelas','Nama Kelas','required');
		$this->load->model('ModelKelas');
		if($this->form_validation->run()==FALSE){
			$this->update_data($this->input->post('id_kelas'));
		}
		else{
			$data = [
				'id' => $this->input->post('id_kelas'),
				'nama_kelas' => $this->input->post('nama_kelas'),
			];
			$update_data = $this->ModelKelas->update_data($data);
			if($update_data){
				$this->session->set_flashdata('pesan_kelas','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil diubah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_kelas','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal diubah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/data_kelas');
		}
	}
	public function delete_data($id)
	{
		$this->load->model('ModelKelas');
		$delete_data = $this->ModelKelas->delete_data($id);
		if($delete_data){
			$this->ModelKelas->reset_id();
			$this->session->set_flashdata('pesan_kelas','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		else{
			$this->session->set_flashdata('pesan_kelas','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data gagal dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect('admin/data_kelas');
	}
}

?>