<?php
class User_model extends CI_Model
{
    function create_user($data)
    {
        return $this->db->insert('users', $data);
    }

    function login($username, $password)
    {
        $match = array(
            'username'=>$username,
            'password' => sha1($password)
        );
        
        $this->db->select()->from('users')->where($match);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function get_by_activation_code($activation_code)
    {
        
        $this->db->select()->from('users')->where('activation_code' , $activation_code);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function update_user($match , $data)
    {
        $this->db->where($match);
        $this->db->update('users',$data);
        return $this->db->insert_id();
    }
}
