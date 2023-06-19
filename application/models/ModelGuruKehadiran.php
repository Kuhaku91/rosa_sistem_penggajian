<?php 

Class ModelGuruKehadiran extends CI_Model{

  public function data_kehadiran($id_guru,$tanggal)
  {
  	$jumlah = 0;
  	$data_tanggal = DATE('m',strtotime($tanggal));
  	$jumlah_jadwal = $this->db->query('select * from data_jadwal where id_guru='.$id_guru.' and month(tanggal)='.$data_tanggal)->result();
  	foreach ($jumlah_jadwal as $key => $value) {
  		$jumlah ++;
  	}
  	// return $id_guru.$tanggal.$data_tanggal;
  	return $jumlah;
  }

  public function data_alfa($id_guru,$tanggal)
  {
    $jumlah = 0;
    $this->db->where('tanggal',(DATE('Y-m-',strtotime($tanggal))).'01');
    $this->db->where('id_guru',$id_guru);
    $data = $this->db->get('data_kehadiran');
    if($data->row()){
      $jumlah = $data->row()->alfa;
    }
    return $jumlah;  
  }

  public function data_izin($id_guru,$tanggal)
  {
  	$jumlah = 0;
    $this->db->where('tanggal',(DATE('Y-m-',strtotime($tanggal))).'01');
    $this->db->where('id_guru',$id_guru);
    $data = $this->db->get('data_kehadiran');
    if($data->row()){
      $jumlah = $data->row()->izin;
    }
    return $jumlah;
  }

  public function data_sakit($id_guru,$tanggal)
  {
  	$jumlah = 0;
    $this->db->where('tanggal',(DATE('Y-m-',strtotime($tanggal))).'01');
    $this->db->where('id_guru',$id_guru);
    $data = $this->db->get('data_kehadiran');
    if($data->row()){
      $jumlah = $data->row()->sakit;
    }
    return $jumlah;
  }

  public function cek_data_kehadiran($tanggal,$id_guru)
  {
  	$this->db->where('tanggal',$tanggal);
  	$this->db->where('id_guru',$id_guru);
  	$data = $this->db->get('data_kehadiran');
  	return $data->row();
  	// return $tanggal." ".$id_guru;
  }

  public function insert_data($table,$data){
    return $this->db->insert($table, $data);
  }
  public function update_data($table, $data, $whare){
    return $this->db->update($table, $data, $whare);
  }
}

?>