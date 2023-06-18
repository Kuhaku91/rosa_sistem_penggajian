<?php 

class Data_Jadwal extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('ModelAdminPegawai');
		$this->load->model('ModelAdminJadwal');
		$this->load->model('ModelAdminMapel');
		$this->load->model('ModelAdminKelas');

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
		$get_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : DATE('m/d/Y') ;
		// var_dump($get_tanggal);
		$convert_tanggal = explode('/',$get_tanggal);
		// var_dump($convert_tanggal[2]);
		$data_tanggal = $convert_tanggal[2].'-'.$convert_tanggal[0].'-'.$convert_tanggal[1];
		//get jadwal

		$data=[
			'title'=>'Jadwal',
			'menu'=>'master_data',
			'sub_menu'=>'data_jadwal',
			'tanggal'=>$data_tanggal,
		];
		// var_dump($data);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_jadwal/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function tambah()
	{
		$data=[
			'title'=>'Tambah Jadwal',
			'pegawai'=>$this->ModelAdminPegawai->get_data(),
			'mapel'=>$this->ModelAdminMapel->get_data(),
			'kelas'=>$this->ModelAdminKelas->get_data(),
			'menu'=>'master_data',
			'sub_menu'=>'data_jadwal',
		];
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/master_data/data_jadwal/tambah', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function simpan()
	{
		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('mapel','Mapel','required');
		$this->form_validation->set_rules('guru','Guru','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		$this->form_validation->set_rules('jam','Jam','required');
		if ($this->form_validation->run()==FALSE) {
			$this->session->set_flashdata('pesan_jadwal_add','
				<div class="col-xs-12">
				<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data harus diisi semua</h4>
				</div>
				</div>
				');
			redirect('admin/master_data/data_jadwal/tambah');
		}
		else{
			// var_dump($this->input->post());
			$tanggal = explode('/',$this->input->post('tanggal'));
			// var_dump($tanggal);
			$cek_data = $this->ModelAdminJadwal->cek_data($this->input->post('kelas'),$tanggal[2].'-'.$tanggal[0].'-'.$tanggal[1],$this->input->post('jam'));
			if ($cek_data) {
				$this->session->set_flashdata('pesan_jadwal_add','
					<div class="col-xs-12">
					<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data sudah ada yang mengisi</h4>
					</div>
					</div>
					');
				redirect('admin/master_data/data_jadwal/tambah');
			}
			else{
				$insert_data = [
					'id_guru'=>$this->input->post('guru'),
					'id_mapel'=>$this->input->post('mapel'),
					'id_kelas'=>$this->input->post('kelas'),
					'tanggal'=>$tanggal[2].'-'.$tanggal[0].'-'.$tanggal[1],
					'jam'=>$this->input->post('jam'),
				];
				$cek_insert = $this->ModelAdminJadwal->insert_data($insert_data);
				if ($cek_insert) {
					$this->session->set_flashdata('pesan_jadwal','
						<div class="col-xs-12">
						<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Data berhasil ditambahkan</h4>
						</div>
						</div>
						');
					redirect('admin/master_data/data_jadwal/?tanggal='.$this->input->post('tanggal'));
				}
				else{
					$this->session->set_flashdata('pesan_jadwal_add','
						<div class="col-xs-12">
						<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Data gagal ditambahkan</h4>
						</div>
						</div>
						');
					redirect('admin/master_data/data_jadwal/tambah');
				}
			}
		}
	}
	public function simpanan()
	{
		// var_dump($this->input->post());
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		if ($this->form_validation->run()==FALSE) {
			$this->session->set_flashdata('pesan_jadwal_add','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data tanggal tidak boleh kosong!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/master_data/data_jadwal/add');
		}
		else{
			$cek_data = $this->ModelJadwal->cek_data($this->input->post('kelas'),$this->input->post('tanggal'),$this->input->post('jam'));
			if ($cek_data) {
				$this->session->set_flashdata('pesan_jadwal_add','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data jadwal sudah ada yang mengisi!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('admin/master_data/data_jadwal/tambah');
			}	
			else{
				$insert_data = [
					'id_guru'=>$this->input->post('pegawai'),
					'id_mapel'=>$this->input->post('mapel'),
					'id_kelas'=>$this->input->post('kelas'),
					'tanggal'=>$this->input->post('tanggal'),
					'jam'=>$this->input->post('jam'),
				];
				$cek_insert = $this->ModelJadwal->insert_data($insert_data);
				if ($cek_insert) {
					$this->session->set_flashdata('pesan_jadwal','<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Data jadwal berhasil dimasukkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('admin/master_data/data_jadwal/?tanggal='.$this->input->post('tanggal'));
				}
				else{
					$this->session->set_flashdata('pesan_jadwal_add','<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data jadwal gagal dimasukkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('admin/master_data/data_jadwal/tambah');
				}
			}
		}
	}
	public function detail($id)
	{
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