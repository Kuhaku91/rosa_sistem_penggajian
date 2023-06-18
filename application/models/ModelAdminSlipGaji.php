<?php 

Class ModelAdminSlipGaji extends CI_Model{
	public function nama_guru($id_guru)
	{
		$data = $this->db->get_where('data_pegawai',array('id_pegawai'=>$id_guru))->row();
		return $data->nama_pegawai;
	}
	public function gaji_pokok()
	{
		$data = $this->db->get_where('data_gaji_pokok',array('id'=>1))->row();
		return $data->nominal;
	}
	public function gaji_alfa()
	{
		$data = $this->db->get_where('data_potongan_gaji',array('potongan'=>'Alfa'))->row();
		return $data->nominal;
	}
	public function gaji_izin()
	{
		$data = $this->db->get_where('data_potongan_gaji',array('potongan'=>'Izin'))->row();
		return $data->nominal;
	}
	public function gaji_sakit()
	{
		$data = $this->db->get_where('data_potongan_gaji',array('potongan'=>'Sakit'))->row();
		return $data->nominal;
	}
	public function gaji_tambahan($id_guru)
	{
		$nominal = 0;
		$data = $this->db->query("SELECT * FROM data_gaji_guru LEFT JOIN data_gaji ON data_gaji_guru.id_gaji=data_gaji.id WHERE id_guru='$id_guru'")->result();
		foreach ($data as $key => $value) {
			$nominal += $value->nominal;
		}
		return $nominal;
	}
	public function cek_slip_gaji($id_pegawai,$tanggal)
	{
		$data = $this->db->get_where('data_slip_gaji',array('id_pegawai'=>$id_pegawai,'tanggal'=>DATE('Y-m-',strtotime($tanggal)).'01'))->row();
		return $data;
	}
	public function insert_data($table,$data){
		return $this->db->insert($table, $data);
	}
}

?>