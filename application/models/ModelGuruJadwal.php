<?php 

Class ModelGuruJadwal extends CI_Model{
	public function insert_data($data)
	{
		$this->db->insert('data_jadwal',$data);
		return $this->db->insert_id();
	}
	public function cek_data($kelas,$tgl,$jam)
	{
    // var_dump($tgl,$jam);
		$cek_data = $this->db->get_where('data_jadwal',array('id_kelas'=>$kelas,'tanggal'=>$tgl,'jam'=>$jam));
		if ($cek_data->result()) {
			return true;
		}
		else{
      // var_dump('a');
			return false;
		}
	}
	public function get_guru($jam,$tanggal,$kelas)
	{
		$cek_data = $this->db->get_where('data_jadwal',array('id_kelas'=>$kelas,'tanggal'=>$tanggal,'jam'=>$jam));
		if ($cek_data->result()) {
			return $cek_data->row()->id_guru;
		}
		else{
      // var_dump('a');
			return 0;
		}
	}
	public function get_mapel($jam,$tanggal,$kelas)
	{
		$cek_data = $this->db->get_where('data_jadwal',array('id_kelas'=>$kelas,'tanggal'=>$tanggal,'jam'=>$jam));
		if ($cek_data->result()) {
			return $cek_data->row()->id_mapel;
		}
		else{
      // var_dump('a');
			return 0;
		}
	}
	public function get_nama_mapel($id_mapel)
	{
		$cek_data = $this->db->query("select * from data_mapel where id='".$id_mapel."'")->row();
		if ($cek_data) {
			return $cek_data->nama_mapel;
		}
		else{
			return '';
		}
	}
	public function get_kelas($id_kelas)
	{
		$cek_data = $this->db->query("select * from data_kelas where id='".$id_kelas."'")->row();
		if ($cek_data) {
			return $cek_data->nama_kelas;
		}
		else{
			return '';
		}
	}
}
?>