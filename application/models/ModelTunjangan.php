<?php
Class ModelTunjangan extends CI_Model
{
  public function get_data()
  {
    $data_tunjangan = $this->db->get('data_gaji_tunjangan');
    return $data_tunjangan->result();
  }
  public function insert_data($data)
  {
    $this->db->insert('data_gaji_tunjangan',$data);
    return $this->db->insert_id();
  }
  public function get_data_id($id)
  {
    $data_tunjangan = $this->db->get_where('data_gaji_tunjangan',array('id'=>$id));
    return $data_tunjangan->row();
  }
  public function update_data($data)
  {
    $this->db->where('id',$data['id']);
    $this->db->update('data_gaji_tunjangan',$data);
    return $this->db->affected_rows();
  }
  public function delete_data($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('data_gaji_tunjangan');
    return $this->db->affected_rows();
  }
  public function reset_id()
  {
    return $this->db->query('ALTER TABLE data_gaji_tunjangan AUTO_INCREMENT=0');
  }
}