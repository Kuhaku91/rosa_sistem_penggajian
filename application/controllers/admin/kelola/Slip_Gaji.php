<?php 

class Slip_Gaji extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('ModelAdminSlipGaji');
		$this->load->model('ModelAdminKehadiran');
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
			'title' => "Slip Gaji",
			'menu'=>'kelola',
			'sub_menu'=>'slip_gaji',
			'tanggal'=>$data_tanggal,
			'slip_gaji'=>$this->db->query("select * from data_kehadiran where month(tanggal)='$convert_tanggal[0]' and year(tanggal)='$convert_tanggal[2]'")->result(),
		];
		// var_dump($data['slip_gaji'],$convert_tanggal[0],$convert_tanggal[2]);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/admin/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('admin/kelola/slip_gaji/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function ajukan()
	{
		$post = $this->input->post();
		$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
		// cek keadaan sebelum input
		if ($post['id_pegawai']&&$tanggal) {
			// 
			if ($this->ModelAdminSlipGaji->cek_slip_gaji($post['id_pegawai'],$tanggal)) {
				// echo "ada";
				$this->session->set_flashdata('slip_gaji','
					<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Data Gaji Sudah Ada</h4>
					</div>
					</div>
					');
				redirect('admin/kelola/slip_gaji?tanggal='.DATE('m/d/Y'));
			}
			else{
				// echo 'tidak';
				$data = [
					'id_pegawai'=>$post['id_pegawai'],
					'tanggal'=>DATE('Y-m-',strtotime($tanggal)).'01',
				];
				$insert_data = $this->ModelAdminSlipGaji->insert_data('data_slip_gaji',$data);
				if ($insert_data) {
					$this->session->set_flashdata('slip_gaji','
						<div class="col-xs-12">
						<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Gaji berhasil diajukan</h4>
						</div>
						</div>
						');
				}
				else{
					$this->session->set_flashdata('slip_gaji','
						<div class="col-xs-12">
						<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Gaji gagal diajukan</h4>
						</div>
						</div>
						');
				}
				redirect('admin/kelola/slip_gaji?tanggal='.DATE('m/d/Y',strtotime($tanggal)));
			}
			var_dump($post['id_pegawai']);
		}
		else{
			$this->session->set_flashdata('slip_gaji','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data gagal ditambahkan</h4>
				</div>
				</div>
				');
			redirect('admin/kelola/slip_gaji?tanggal='.DATE('m/d/Y'));
		}
	}
	public function print_all()
	{
		$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
		if ($tanggal) {
			$data = [
				'slip_gaji'=>$this->db->query("
					select * from data_kehadiran 
					JOIN data_slip_gaji ON data_kehadiran.tanggal=data_slip_gaji.tanggal AND data_kehadiran.id_guru=data_slip_gaji.id_pegawai
					where month(data_kehadiran.tanggal)='".DATE('m',strtotime($tanggal))."' and year(data_kehadiran.tanggal)='".DATE('Y',strtotime($tanggal))."'
					and status='diterima'
					")->result(),
				'tanggal'=>$tanggal,
			];
			$this->load->view('admin/kelola/slip_gaji/cetak_slip_gaji_all', $data);
		}
		else{
			redirect('admin/kelola/slip_gaji?tanggal='.DATE('m/d/Y'));
		}
	}
	public function print()
	{
		$post = $this->input->post();
		$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
		// cek keadaan sebelum input
		if ($post['id_pegawai']&&$tanggal) {
			$data = [
				'id_pegawai'=>$post['id_pegawai'],
				'nama_guru'=>$this->ModelAdminSlipGaji->nama_guru($post['id_pegawai']),
				'tanggal'=>$tanggal,
			];
			$this->load->view('admin/kelola/slip_gaji/cetak_slip_gaji', $data);
		}
		else{
			redirect('admin/kelola/slip_gaji?tanggal='.DATE('m/d/Y'));
		}
	}
}

?>