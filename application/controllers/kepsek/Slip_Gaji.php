<?php

class Slip_Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('ModelJadwal');
		$this->load->model('ModelPegawai');
		$this->load->model('ModelJabatan');
		$this->load->model('ModelTunjangan_Guru');
		$this->load->model('ModelGaji');

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
		$data = [
			'title'=> 'Slip Gaji Pegawai',
			'pegawai'=> $this->ModelPenggajian->get_data('data_pegawai')->result(),
		];

		$this->load->view('template_kepsek/header',$data);
		$this->load->view('template_kepsek/sidebar');
		$this->load->view('template_kepsek/wrapper_up');
		$this->load->view('template_kepsek/navbar');
		$this->load->view('kepsek/slip_gaji/index',$data);
		$this->load->view('template_kepsek/wrapper_down');
		$this->load->view('template_kepsek/footer');
	}
	public function cetak_gaji($id)
	{
		//data bulan dan tahun
		$this->db->select('year(tanggal) as tahun, month(tanggal) as bulan');
		$this->db->from('data_jadwal');
		$this->db->where('id_guru',$id);
		$this->db->group_by('tahun,bulan');
		$this->db->order_by('bulan','desc');
		$this->db->order_by('tahun','desc');
		$data_bulan_tahun = $this->db->get()->result();


		$data_gaji_tunjangan = 0;
		foreach ($this->ModelTunjangan_Guru->get_data($id) as $key => $value) {
			$data_gaji_tunjangan+=$value->jumlah;
		}

		$data = [
			'title'=>"List Gaji",
			// 'guru'=>$this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai='$id'")->result(),
			'guru'=>$this->ModelPegawai->find($id),
			'data_gaji'=>$data_bulan_tahun,
			'gaji_jabatan'=>$this->ModelJabatan->where('nama_jabatan',$this->ModelPegawai->find($id)->jabatan)->row(),
			'data_gaji_tunjangan'=>$data_gaji_tunjangan,
		];

		// var_dump($data['data_gaji']);

		$this->load->view('template_kepsek/header',$data);
		$this->load->view('template_kepsek/sidebar');
		$this->load->view('template_kepsek/wrapper_up');
		$this->load->view('template_kepsek/navbar');
		$this->load->view('kepsek/slip_gaji/list_gaji',$data);
		$this->load->view('template_kepsek/wrapper_down');
		$this->load->view('template_kepsek/footer');
	}
	public function acc($id_pegawai,$tahun,$bulan)
	{
		$data = [
			'id_pegawai'=>$id_pegawai,
			'cetak'=>$tahun."-".$bulan."-01",
			'status'=>"diterima",
		];
		// var_dump($data);
		$update = $this->ModelGaji->update($data);
		if ($update) {
			$this->session->set_flashdata('pesan_slip_gaji','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Gaji berhasil Disetujui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		else{
			$this->session->set_flashdata('pesan_slip_gaji','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Gaji gagal Disetujui!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect('kepsek/slip_gaji/cetak_gaji/'.$id_pegawai);
	}
}

?>