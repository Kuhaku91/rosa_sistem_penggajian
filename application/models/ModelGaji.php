<?php
Class ModelGaji extends CI_Model{
	public function status($id_pegawai,$tahun,$bulan){
		$this->db->select('id_pegawai,cetak,status');
		$this->db->from('data_gaji');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('year(cetak)',$tahun);
		$this->db->where('month(cetak)',$bulan);
		return $this->db->get()->row();
	}
	public function insert($data)
	{
		return $this->db->insert('data_gaji',$data);
	}
	public function update($data)
	{
		$this->db->where('id_pegawai',$data['id_pegawai']);
		$this->db->where('cetak',$data['cetak']);
		$this->db->update('data_gaji',$data);
		return $this->db->affected_rows();
	}
	public function cek_gaji($id_pegawai,$tahun)
	{
		$thn = DATE('Y',strtotime($tahun));
		$bln = DATE('m',strtotime($tahun));
		$cek_data = $this->db->get_where('data_gaji',array('id_pegawai'=>$id_pegawai,'cetak'=>$thn."-".$bln."-01"));
		if ($cek_data->result()) {
			return true;
		}
		else{
			return false;
		}
	}
}
?>