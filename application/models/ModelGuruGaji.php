<?php 

Class ModelGuruGaji extends CI_Model{
	public function update_data_gaji_pokok($table, $data, $whare){
		return $this->db->update($table, $data, $whare);
	}
	public function update_data_potongan_gaji($table, $data, $whare){
		return $this->db->update($table, $data, $whare);
	}
	public function find($id)
	{
		$data_gaji = $this->db->get_where('data_gaji',array('id'=>$id));
		return $data_gaji->row();
	}
	public function insert_data($data,$table){
		return $this->db->insert($table, $data);
	}
	public function get_data($table) {
		return $this->db->get($table);
	}
	public function update_data($table, $data, $whare){
		return $this->db->update($table, $data, $whare);
	}
	public function delete_data($whare,$table){
		$this->db->where($whare);
		$this->db->delete($table);
		return $this->db->query("alter table data_gaji auto_increment=0");
	}
	public function cek_gaji_pokok(){
		$this->db->where('id',1);
		$data = $this->db->get('data_gaji_pokok'); 
		return $data->row();
	}
	public function cek_gaji_tunjangan($id_guru,$id_gaji)
	{
		// echo $id_guru;
		// echo $id_gaji;
		$this->db->where('id_guru',$id_guru);
		$this->db->where('id_gaji',$id_gaji);
		$data = $this->db->get('data_gaji_guru');
		return $data->row();
	}
	public function delete_gaji_tunjangan($id_guru,$id_gaji)
	{
		$this->db->where('id_guru',$id_guru);
		$this->db->where('id_gaji',$id_gaji);
		return $this->db->delete('data_gaji_guru');
	}
	public function find_tunjangan($id)
	{
		$this->db->select('nama_gaji,nominal,id_guru,id_gaji');
		$this->db->from('data_gaji_guru');
		$this->db->join('data_gaji','data_gaji_guru.id_gaji=data_gaji.id');
		$this->db->where('id_guru',$id);
		return $this->db->get();
	}
	public function nominal_gaji($id_guru)
	{
		$nominal = 0;
		$data = $this->db->query("SELECT * FROM data_gaji_guru LEFT JOIN data_gaji ON data_gaji_guru.id_gaji=data_gaji.id WHERE id_guru='$id_guru'")->result();
		foreach ($data as $key => $value) {
			$nominal += $value->nominal;
		}
		return $nominal;
	}

}
?>