<?php
Class ModelPegawai extends CI_Model
{
  public function get_data()
  {
    $this->db->select('*');
    $this->db->from('data_pegawai');
    $this->db->where('hak_akses !=',3);
    $data_tunjangan = $this->db->get();
    return $data_tunjangan->result();
  }
  public function insert_data($data,$table){
    $this->db->insert($table, $data);
  }
  public function get_data_id($id)
  {
    $data_tunjangan = $this->db->get_where('data_pegawai',array('id_pegawai'=>$id));
    return $data_tunjangan->row();
  }
  public function update_data($data)
  {
    $this->db->where('id',$data['id']);
    $this->db->update('data_pegawai',$data);
    return $this->db->affected_rows();
  }
  public function delete_data($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('data_pegawai');
    return $this->db->affected_rows();
  }
  public function reset_id()
  {
    return $this->db->query('ALTER TABLE data_pegawai AUTO_INCREMENT=0');
  }
  public function get_data_row_id($id){
    $data = $this->db->get_where('data_pegawai',array('id_pegawai'=>$id))->row();
    $data_mapel=array();
    foreach ($data as $key => $value) {
      // var_dump($key);
      // var_dump($key);
      // array_push($data_mapel,[
      //   $key=>$value
      // ]);
      $data_mapel[]=array($key=>$value);
    }
    // var_dump($data_mapel);
    return $data_mapel;
  }
  public function find($id)
  {
    return $this->db->get_where('data_pegawai',array('id_pegawai'=>$id))->row();
  }
  public function get_data_by_level($hak_akses)
  {
    $this->db->select('*');
    $this->db->from('data_pegawai');
    $this->db->where('hak_akses',$hak_akses);
    $result = $this->db->get();
    return $result;
  }
}