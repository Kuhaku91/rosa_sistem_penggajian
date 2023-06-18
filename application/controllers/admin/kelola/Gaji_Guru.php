<?php 

class Gaji_Guru extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('ModelAdminGaji');

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

	public function index(){
		$data=[
			'title' => "Gaji guru",
			'data' => $this->db->query("select * from data_pegawai where hak_akses=2")->result(),
			'pegawai' => $this->db->query("select * from data_pegawai where hak_akses=2")->result(),
			'tunjangan' => $this->db->query("select * from data_gaji")->result(),
			'menu'=>'kelola',
			'sub_menu'=>'gaji_guru',
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/kelola/gaji_guru/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function tambah()
	{
		// var_dump($this->input->post());
		$data = [
			'id_guru'=>$this->input->post('pegawai'),
			'id_gaji'=>$this->input->post('tunjangan'),
		];
		$cek_data = $this->ModelAdminGaji->cek_gaji_tunjangan($this->input->post('pegawai'),$this->input->post('tunjangan'));
		if ($cek_data) {
			$this->session->set_flashdata('gaji_guru','
				<div class="col-xs-12">
				<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data sudah ada</h4>
				</div>
				</div>
				');
			redirect('admin/kelola/gaji_guru');
		}
		else{
			$insert_data = $this->ModelAdminGaji->insert_data($data,'data_gaji_guru');
			if ($insert_data) {
				$this->session->set_flashdata('gaji_guru','
					<div class="col-xs-12">
					<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data berhasil ditambahkan</h4>
					</div>
					</div>
					');
			}
			else{
				$this->session->set_flashdata('gaji_guru','
					<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data gagal ditambahkan</h4>
					</div>
					</div>
					');
			}
			redirect('admin/kelola/gaji_guru');
		}
	}
	public function hapus($id_guru,$id_gaji)
	{
		$delete_data = $this->ModelAdminGaji->delete_gaji_tunjangan($id_guru,$id_gaji);
		// var_dump($delete_data,$id_guru,$id_gaji);
		if ($delete_data) {
			$this->session->set_flashdata('gaji_guru','
				<div class="col-xs-12">
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data berhasil dihapus</h4>
				</div>
				</div>
				');
		}
		else{
			$this->session->set_flashdata('gaji_guru','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data gagal dihapus</h4>
				</div>
				</div>
				');
		}
		redirect('admin/kelola/gaji_guru');
	}
}

?>