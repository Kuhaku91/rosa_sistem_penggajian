<?php 

Class ModelAdminJadwal extends CI_Model{
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

}
?>