<?php 
Class ModelJabatan extends CI_Model{

	public function where($kolom,$id){
		return $this->db->get_where('data_jabatan',array($kolom=>$id));
	}

	public function pegawai_id($id)
	{
		$this->db->select('id_pegawai,nama_pegawai,gaji_pokok,tj_transport,uang_makan');
		$this->db->from('data_pegawai');
		$this->db->join('data_jabatan','data_pegawai.jabatan=data_jabatan.nama_jabatan','left');
		$this->db->where('id_pegawai',$id);
		return $this->db->get();
	}
}
?>