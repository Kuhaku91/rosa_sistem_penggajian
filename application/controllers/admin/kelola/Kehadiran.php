<?php 

class Kehadiran extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('ModelAdminGaji');
		$this->load->model('ModelAdminKehadiran');
		$this->load->model('ModelAdminPegawai');

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
		//get tanggal
		$get_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : DATE('m/d/Y') ;
		// var_dump($get_tanggal);
		$convert_tanggal = explode('/',$get_tanggal);
		// var_dump($convert_tanggal[2]);
		$data_tanggal = $convert_tanggal[2].'-'.$convert_tanggal[0].'-'.$convert_tanggal[1];
		//get jadwal
		$data=[
			'title' => "Kehadiran",
			'menu'=>'kelola',
			'sub_menu'=>'kehadiran',
			'tanggal'=>$data_tanggal,
			'guru'=>$this->db->query("select * from data_pegawai where hak_akses=2")->result(),
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/kelola/kehadiran/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function update()
	{
		// var_dump($this->input->post());
		$data_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : DATE('Y-m-d');
		$post = $this->input->post();
		$notif = "";
		foreach($post['id_pegawai'] as $key => $value){
			// echo $key;
			// buat data untuk update maupun insert
			$pegawai = $this->ModelAdminPegawai->find($post['id_pegawai'][$key]);
			$data = [
				'tanggal'=>DATE('Y-m-',strtotime($data_tanggal)).'01',
				'id_guru'=>$post['id_pegawai'][$key],
				'alfa'=>$post['alfa'][$key],
				'izin'=>$post['izin'][$key],
				'sakit'=>$post['sakit'][$key],
			];
			$where = array(
				'tanggal'=>DATE('Y-m-',strtotime($data_tanggal)).'01',
				'id_guru'=>$post['id_pegawai'][$key],
			);
			// cek dulu apakah kehadiran ada apa tidak
			if ($this->ModelAdminKehadiran->data_kehadiran($post['id_pegawai'][$key],$data_tanggal)>0) {
			// cek data di db jika ada maka akan update, jika tidak maka akan insert
				if ($this->ModelAdminKehadiran->cek_data_kehadiran(DATE('Y-m-',strtotime($data_tanggal)).'01',$post['id_pegawai'][$key])) {
				// echo $this->ModelAdminKehadiran->cek_data_kehadiran(DATE('Y-m-',strtotime($data_tanggal)).'01',$post['id_pegawai'][$key])."<br>";
				// echo 'ada '.$post['id_pegawai'][$key]."<br>";
				// update ke dalam db
					$update_data = $this->ModelAdminKehadiran->update_data('data_kehadiran',$data,$where);
					if ($update_data) {
						$notif.='
						<div class="col-xs-12">
						<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Data '.$pegawai->nama_pegawai.' berhasil diubah</h4>
						</div>
						</div>
						';
					}
					else{
						$notif.='
						<div class="col-xs-12">
						<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Data '.$pegawai->nama_pegawai.' gagal diubah</h4>
						</div>
						</div>
						';
					}
				}
				else{
				// echo 'tidak '.$post['id_pegawai'][$key]."<br>";
				// insert ke dalam db
					$insert_data = $this->ModelAdminKehadiran->insert_data('data_kehadiran',$data);
					if ($insert_data) {
						$notif.='
						<div class="col-xs-12">
						<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Data '.$pegawai->nama_pegawai.' berhasil ditambahkan</h4>
						</div>
						</div>
						';
					}
					else{
						$notif.='
						<div class="col-xs-12">
						<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Data '.$pegawai->nama_pegawai.' gagal ditambahkan</h4>
						</div>
						</div>
						';
					}
				}	
			}
			else{
				$notif.='
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data jadwal '.$pegawai->nama_pegawai.' gagal ditambahkan karena belum ada jadwal</h4>
				</div>
				</div>
				';
			}
		}
		$this->session->set_flashdata('kehadiran',$notif);
		redirect('admin/kelola/kehadiran?tanggal='.DATE('m/d/Y',strtotime($data_tanggal)));
		// echo $data_tanggal;
	}
}

?>