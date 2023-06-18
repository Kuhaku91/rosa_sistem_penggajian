<?php 

Class ModelAdminPegawai extends CI_Model{
	public function find($id)
	{
		$data_tunjangan = $this->db->get_where('data_pegawai',array('id_pegawai'=>$id));
		return $data_tunjangan->row();
	}
	public function insert_data($data,$table){
		return $this->db->insert($table, $data);
	}
	public function get_data() {
		return $this->db->get_where('data_pegawai',array('hak_akses'=>2))->result();
	}
	public function update_data($table, $data, $whare){
		return $this->db->update($table, $data, $whare);
	}
	public function delete_data($whare,$table){
		$this->db->where($whare);
		$this->db->delete($table);
		return $this->db->query("alter table data_pegawai auto_increment=0");
	}

}
?>