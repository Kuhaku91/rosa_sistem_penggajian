<?php 

class Data_Jadwal extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('ModelPegawai');
		$this->load->model('ModelJadwal');
		$this->load->model('ModelKelas');
		$this->load->model('ModelTunjangan_Guru');
		$this->load->model('ModelTunjangan_Guru');
		$this->load->model('ModelTunjangan');
		$this->load->model('ModelMapel');
		$this->load->model('ModelGaji');

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
				'jam'=>[
					'1'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,1),
					'2'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,2),
					'3'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,3),
					'4'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,4),
					'5'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,5),
					'6'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,6),
					'7'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,7),
					'8'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,8),
					'9'=>$this->ModelJadwal->get_kelas_tanggal_jam($value->id,$data_tanggal,9),
				],
			]);
		}
		// var_dump($data_jadwal);

		$data=[
			'title'=>'Jadwal Pegawai',
			'guru'=>$this->ModelPegawai->get_data(),
			'tanggal'=>$data_tanggal,
			'data_jadwal'=>$data_jadwal,
		];
		// $this->session->unset_flashdata('pesan_jadwal');
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jadwal/data_jadwal', $data);
		$this->load->view('template_admin/footer');
	}
	public function add()
	{
		$data=[
			'title'=>'Tambah Jadwal Pegawai',
			'pegawai'=>$this->ModelPegawai->get_data(),
			'mapel'=>$this->ModelMapel->get_data(),
			'kelas'=>$this->ModelKelas->get_data(),
		];
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jadwal/tambah_datajadwal', $data);
		$this->load->view('template_admin/footer');
		// $this->session->unset_flashdata('pesan_jadwal_add');
	}
	public function simpan()
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
			redirect('admin/data_jadwal/add');
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
				redirect('admin/data_jadwal/add');
			}	
			else{
				$cek_slip = $this->ModelGaji->cek_gaji($this->input->post('pegawai'),$this->input->post('tanggal'));
				// var_dump($cek_slip);
				if ($cek_slip) {
					$this->session->set_flashdata('pesan_jadwal_add','<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data jadwal tidak bisa dimasukkan karena dalam proses pengajuan atau sudah diacc untuk slip gaji!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('admin/data_jadwal/add');
				}
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
					redirect('admin/data_jadwal/?tanggal='.$this->input->post('tanggal'));
				}
				else{
					$this->session->set_flashdata('pesan_jadwal_add','<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data jadwal gagal dimasukkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('admin/data_jadwal/add');
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