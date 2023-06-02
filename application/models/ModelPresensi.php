<?php
Class ModelPresensi extends CI_Model
{
	public function get_id($id)
	{
		$data = $this->db->get_where('data_presensi',array('id_jadwal'=>$id));
		return $data->row();
	}
	public function insert_data($data)
	{
		$this->db->insert('data_presensi',$data);
		return $this->db->insert_id();
	}
	public function insert($data)
	{
		return $this->db->insert('data_presensi',$data);
	}
	public function update_data($data)
	{
		$this->db->where('id_jadwal',$data['id_jadwal']);
		$this->db->update('data_presensi',$data);
		return $this->db->affected_rows();
	}
	public function cek_data($id,$id_potongan)
	{
		$data = $this->db->get_where('data_presensi',array('id_jadwal'=>$id,'id_potongan'=>$id_potongan));
		return $data->row();
	}
}
?>