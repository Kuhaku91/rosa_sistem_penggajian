<?php
Class ModelGaji extends CI_Model{
	public function status($id_pegawai,$tahun,$bulan){
		$this->db->select('id_pegawai,cetak,status');
		$this->db->from('data_gaji');
		$this->db->where('year(cetak)',$tahun);
		$this->db->where('month(cetak)',$bulan);
		return $this->db->get()->row();
	}
	public function insert($data)
	{
		return $this->db->insert('data_gaji',$data);
	}
}
?>