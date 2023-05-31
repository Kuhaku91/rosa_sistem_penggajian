<?php

class Set_Tunjangan extends CI_Controller {
	
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
		$this->load->model('ModelPegawai');
		$data=[
			'title'=>'Tunjangan Guru',
			'guru'=>$this->ModelPegawai->get_data(),
		];
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tunjangan_guru/data_tunjangan', $data);
		$this->load->view('template_admin/footer');
	}
	public function detail($id)
	{
		$this->load->model('ModelTunjangan_Guru');
		$this->load->model('ModelTunjangan');
		$this->load->model('ModelPegawai');
		$data=[
			'title'=>'Detail Tunjangan Guru',
			'id_guru'=>$id,
			'nama_guru'=>$this->ModelPegawai->get_data_id($id),
			'tunjangan'=>$this->ModelTunjangan->get_data(),
			'data_tunjangan'=>$this->ModelTunjangan_Guru->get_data($id),
		];
		// var_dump($data);
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tunjangan_guru/detail_tunjangan', $data);
		$this->load->view('template_admin/footer');
		// var_dump($data);
	}
	public function simpan_tunjangan()
	{
		$this->form_validation->set_rules('tunjangan','Tunjangan','required');
		$this->form_validation->set_rules('jumlah','Jumlah','required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('pesan_tunjangan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data gagal ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			$this->detail($this->input->post('id'));
		}
		else{
			$this->load->model('ModelTunjangan_Guru');
			$data = [
				'id_guru'=>$this->input->post('id'),
				'id_tunjangan'=>$this->input->post('tunjangan'),
				'jumlah'=>$this->input->post('jumlah'),
			];
			$cek_insert = $this->ModelTunjangan_Guru->insert($data);
			if ($cek_insert) {
				$this->session->set_flashdata('pesan_tunjangan','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_tunjangan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/set_tunjangan/detail/'.$this->input->post('id'));
		}
	}
	public function hapus($id_guru,$id_tunjangan,$jumlah)
	{
		// var_dump($id_guru,$id_tunjangan,$jumlah);
		$this->load->model('ModelTunjangan_Guru');
		$data = [
			'id_guru'=>$id_guru,
			'id_tunjangan'=>$id_tunjangan,
			'jumlah'=>$jumlah,
		];
		$delete_data = $this->ModelTunjangan_Guru->delete($data);
		if($delete_data){
			$this->session->set_flashdata('pesan_tunjangan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		else{
			$this->session->set_flashdata('pesan_tunjangan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data gagal dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect('admin/set_tunjangan/detail/'.$id_guru);
	}
}
?>