<?php
Class ModelJadwal extends CI_Model
{
  public function get_data()
  {
    $data = $this->db->get('data_jadwal');
    return $data->result();
  }
  public function insert_data($data)
  {
    $this->db->insert('data_jadwal',$data);
    return $this->db->insert_id();
  }
  public function get_data_id($id)
  {
    $data = $this->db->get_where('data_jadwal',array('id'=>$id));
    return $data->row();
  }
  public function update_data($data)
  {
    $this->db->where('id',$data['id']);
    $this->db->update('data_jadwal',$data);
    return $this->db->affected_rows();
  }
  public function delete_data($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('data_jadwal');
    return $this->db->affected_rows();
  }
  public function reset_id()
  {
    return $this->db->query('ALTER TABLE data_jadwal AUTO_INCREMENT=0');
  }
  public function get_kelas_tanggal_jam($kelas,$tgl,$jam)
  {
    $cek_jadwal = $this->db->get_where('data_jadwal',array('id_kelas'=>$kelas,'tanggal'=>$tgl,'jam'=>$jam));
    // var_dump($cek_jadwal->result());
    $data_jadwal=array();
    if ($cek_jadwal->result()) {
      $cek_isi = 'ada';
      foreach ($cek_jadwal->result() as $key => $value) {
        foreach ($this->db->get_where('data_pegawai',array('id_pegawai'=>$value->id_guru))->result() as $key_guru => $value_guru) {
          $nama_guru = $value_guru->nama_pegawai;
        }
        foreach ($this->db->get_where('data_mapel',array('id'=>$value->id_mapel))->result() as $key_mapel => $value_mapel) {
          $nama_mapel = $value_mapel->nama_mapel;
        }
      }
      // var_dump($id_guru,$id_mapel);
      array_push($data_jadwal,[
        'guru' => $nama_guru,
        'mapel' => $nama_mapel,
      ]);
      // var_dump($data_jadwal);
    }
    else{
      array_push($data_jadwal,[
        'guru' => 'KOSONG',
        'mapel' => 'KOSONG',
      ]);
      // $cek_isi = 'tidak';
    }
    return $data_jadwal;
    // return $tgl.",".$jam.",".$kelas.",".$cek_isi;
  }
}