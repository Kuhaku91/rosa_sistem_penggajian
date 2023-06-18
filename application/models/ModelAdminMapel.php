<?php 

Class ModelAdminMapel extends CI_Model{
	public function find($id)
	{
		$data_mapel = $this->db->get_where('data_mapel',array('id'=>$id));
		return $data_mapel->row();
	}
	public function insert_data($data,$table){
		return $this->db->insert($table, $data);
	}
	public function get_data() {
		return $this->db->get('data_mapel')->result();
	}
	public function update_data($table, $data, $whare){
		return $this->db->update($table, $data, $whare);
	}
	public function delete_data($whare,$table){
		$this->db->where($whare);
		$this->db->delete($table);
		return $this->db->query("alter table data_mapel auto_increment=0");
	}

}
?>