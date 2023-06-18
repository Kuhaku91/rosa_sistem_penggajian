<?php 

Class ModelAdminKelas extends CI_Model{
	public function find($id)
	{
		$data_kelas = $this->db->get_where('data_kelas',array('id'=>$id));
		return $data_kelas->row();
	}
	public function insert_data($data,$table){
		return $this->db->insert($table, $data);
	}
	public function get_data() {
		return $this->db->get('data_kelas')->result();
	}
	public function update_data($table, $data, $whare){
		return $this->db->update($table, $data, $whare);
	}
	public function delete_data($whare,$table){
		$this->db->where($whare);
		$this->db->delete($table);
		return $this->db->query("alter table data_kelas auto_increment=0");
	}

}
?>