<?php

class Presensi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ModelKelas');
		$this->load->model('ModelJadwal');
		$this->load->model('ModelPegawai');
		$this->load->model('ModelPotongan_Gaji');
		$this->load->model('ModelPotongan_Gaji');
		$this->load->model('ModelPresensi');

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
		// var_dump(DATE('Y-m'));
		// var_dump(cal_days_in_month(CAL_GREGORIAN, DATE('m'), date('Y')));
		
		//get tanggal
		$data_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : DATE('Y-m-d') ;
		if ($data_tanggal=='') {
			$data_tanggal=DATE('Y-m-d');
		}
		// var_dump($data_tanggal);

		//get jadwal
		$data_jadwal = array();
		foreach ($this->ModelKelas->get_data() as $key => $value) {
			array_push($data_jadwal,[
				'kelas'=>$value->nama_kelas,
				'jam'=>$this->ModelJadwal->get_kelas_id_tgl($value->id,$data_tanggal),
			]);
		}
		// var_dump($data_jadwal);

		$data=[
			'title'=>'Presensi pada',
			'guru'=>$this->ModelPegawai->get_data(),
			'tanggal'=>$data_tanggal,
			'data_jadwal'=>$data_jadwal,
		];
		// var_dump($data['data_jadwal']);
		// $this->session->unset_flashdata('pesan_jadwal');
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/presensi/data_presensi', $data);
		$this->load->view('template_admin/footer');
	}
	public function isi($id)
	{
		$data_jadwal = $this->ModelJadwal->get_data_id($id);
		$array_jadwal=get_object_vars($data_jadwal);
		$data_pegawai = $this->ModelPegawai->get_data_id($array_jadwal['id_guru']);
		$array_pegawai=get_object_vars($data_pegawai);
		$data = [
			'title'=>'Presensi Guru',
			'data_guru'=>$array_pegawai,
			'data_jadwal'=>$array_jadwal,
			'potongan'=>$this->ModelPotongan_Gaji->TampilPotongan(),

		];
		// var_dump($data['data_jadwal']);
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/presensi/update_data_presensi', $data);
		$this->load->view('template_admin/footer');
	}
	public function add($id)
	{
		// var_dump($this->input->post());
		// data Hadir
		$data_presensi = $this->ModelJadwal->get_data_id($id);
		// var_dump($data_presensi);
		if ($this->input->post('presensi')=='Hadir') {
			$data = [
				'id_jadwal'=>$id,
				'hadir'=>'Hadir',
				'id_potongan'=>'',
			];
			$insert_data=$this->ModelPresensi->insert($data);
			// var_dump($insert_data);
			if ($insert_data) {
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/presensi?tanggal='.$data_presensi->tanggal);
		}
		// data Presensi
		else{
			$data = [
				'id_jadwal'=>$id,
				'hadir'=>'Lainnya',
				'id_potongan'=>$this->input->post('presensi'),
			];
			$insert_data=$this->ModelPresensi->insert($data);
			if ($insert_data) {
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/presensi?tanggal='.$data_presensi->tanggal);
		}
	}
	public function update($id)
	{
		if ($this->ModelPresensi->cek_data($id,$this->input->post('presensi'))) {
			$this->session->set_flashdata('pesan_presensi','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data absen tidak berubah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/presensi/isi/'.$id);
		}
		$data_presensi = $this->ModelJadwal->get_data_id($id);
		if ($this->input->post('presensi')=='Hadir') {
			$data = [
				'id_jadwal'=>$id,
				'hadir'=>'Hadir',
				'id_potongan'=>'',
			];
			$insert_data=$this->ModelPresensi->update_data($data);
			// var_dump($insert_data);
			if ($insert_data) {
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/presensi?tanggal='.$data_presensi->tanggal);
		}
		// data Presensi
		else{
			$data = [
				'id_jadwal'=>$id,
				'hadir'=>'Lainnya',
				'id_potongan'=>$this->input->post('presensi'),
			];
			$insert_data=$this->ModelPresensi->update_data($data);
			// var_dump($insert_data,$data);
			if ($insert_data) {
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			else{
				$this->session->set_flashdata('pesan_presensi','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal Absen!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			}
			redirect('admin/presensi?tanggal='.$data_presensi->tanggal);
		}
	}
}

?>