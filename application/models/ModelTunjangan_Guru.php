<?php
Class ModelTunjangan_Guru extends CI_Model
{
	public function get_data($id)
	{
		$this->db->select('*');
		$this->db->from('data_gaji_tunjangan_guru');
		$this->db->join('data_gaji_tunjangan','data_gaji_tunjangan_guru.id_tunjangan=data_gaji_tunjangan.id','left');
		$this->db->where('id_guru',$id);
		$data_tunjanganguru = $this->db->get();
		return $data_tunjanganguru->result();
	}
	public function insert($data)
	{
		$this->db->insert('data_gaji_tunjangan_guru',$data);
		return $this->db->affected_rows();
	}
	public function delete($data)
	{
		// var_dump($data);
		$this->db->where('id_guru',$data['id_guru']);
		$this->db->where('id_tunjangan',$data['id_tunjangan']);
		$this->db->where('jumlah',$data['jumlah']);
		$this->db->delete('data_gaji_tunjangan_guru');
		return $this->db->affected_rows();
	}
}
?>