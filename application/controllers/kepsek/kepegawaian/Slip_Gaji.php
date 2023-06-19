<?php

class Slip_Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelKepsekSlipGaji');
		$this->load->model('ModelKepsekKehadiran');
		$this->load->model('ModelKepsekGaji');

		if($this->session->userdata('hak_akses') != '3'){
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
			'menu'=>'kepegawaian',
			'sub_menu'=>'slip_gaji',
			'tanggal'=>$data_tanggal,
			'slip_gaji'=>$this->db->query("select * from data_kehadiran where month(tanggal)='$convert_tanggal[0]' and year(tanggal)='$convert_tanggal[2]'")->result(),
		];
		// var_dump($data['slip_gaji'],$convert_tanggal[0],$convert_tanggal[2]);
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/kepsek/sidebar');
		$this->load->view('layouts/wraper_up');

		$this->load->view('kepsek/kepegawaian/slip_gaji/index', $data);

		$this->load->view('layouts/wraper_down');
		$this->load->view('layouts/footer');
	}
	public function persetujuan()
	{
		$post = $this->input->post();
		$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
		// cek keadaan sebelum input
		if ($post['id_pegawai']&&$tanggal) {
			if ($this->ModelKepsekSlipGaji->cek_slip_gaji($post['id_pegawai'],$tanggal)) {
				echo "ada";
				$data = [
					'id_pegawai'=>$post['id_pegawai'],
					'tanggal'=>DATE('Y-m-',strtotime($tanggal)).'01',
					'status'=>"diterima",
				];
				$where = array(
					'id_pegawai'=>$post['id_pegawai'],
					'tanggal'=>DATE('Y-m-',strtotime($tanggal)).'01',
				);
				$acc = $this->ModelKepsekSlipGaji->update_data('data_slip_gaji',$data,$where);
				if ($acc) {
					$this->session->set_flashdata('slip_gaji','
						<div class="col-xs-12">
						<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Gaji Berhasil di Setujui</h4>
						</div>
						</div>
						');
				}
				else{
					$this->session->set_flashdata('slip_gaji','
						<div class="col-xs-12">
						<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Gaji Gagal di Setujui</h4>
						</div>
						</div>
						');	
				}
				redirect('kepsek/kepegawaian/slip_gaji?tanggal='.DATE('m/d/Y',strtotime($tanggal)));
			}
			else{
				$this->session->set_flashdata('slip_gaji','
					<div class="col-xs-12">
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Gaji yang ingin di Setujui tidak ada</h4>
					</div>
					</div>
					');
			}
		}
		else{
			$this->session->set_flashdata('slip_gaji','
				<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>Data tidak ada yang dipilih</h4>
				</div>
				</div>
				');
		}
		redirect('kepsek/kepegawaian/slip_gaji?tanggal='.DATE('m/d/Y'));
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
			$this->load->view('kepsek/kepegawaian/slip_gaji/cetak_slip_gaji_all', $data);
		}
		else{
			redirect('kepsek/kepegawaian/slip_gaji?tanggal='.DATE('m/d/Y'));
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
				'nama_guru'=>$this->ModelKepsekSlipGaji->nama_guru($post['id_pegawai']),
				'tanggal'=>$tanggal,
			];
			$this->load->view('kepsek/kepegawaian/slip_gaji/cetak_slip_gaji', $data);
		}
		else{
			redirect('kepsek/kepegawaian/slip_gaji?tanggal='.DATE('m/d/Y'));
		}
	}
}

?>