<?php
Class ModelMapel extends CI_Model
{
  public function get_data()
  {
    $data = $this->db->get('data_mapel');
    return $data->result();
  }
  public function insert_data($data)
  {
    $this->db->insert('data_mapel',$data);
    return $this->db->insert_id();
  }
  public function get_data_id($id)
  {
    $data = $this->db->get_where('data_mapel',array('id'=>$id));
    return $data->row();
  }
  public function update_data($data)
  {
    $this->db->where('id',$data['id']);
    $this->db->update('data_mapel',$data);
    return $this->db->affected_rows();
  }
  public function delete_data($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('data_mapel');
    return $this->db->affected_rows();
  }
  public function reset_id()
  {
    return $this->db->query('ALTER TABLE data_mapel AUTO_INCREMENT=0');
  }
}