<?php
Class ModelKelas extends CI_Model
{
  public function get_data()
  {
    $data = $this->db->get('data_kelas');
    return $data->result();
  }
  public function insert_data($data)
  {
    $this->db->insert('data_kelas',$data);
    return $this->db->insert_id();
  }
  public function get_data_id($id)
  {
    $data = $this->db->get_where('data_kelas',array('id'=>$id));
    return $data->row();
  }
  public function update_data($data)
  {
    $this->db->where('id',$data['id']);
    $this->db->update('data_kelas',$data);
    return $this->db->affected_rows();
  }
  public function delete_data($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('data_kelas');
    return $this->db->affected_rows();
  }
  public function reset_id()
  {
    return $this->db->query('ALTER TABLE data_kelas AUTO_INCREMENT=0');
  }
}