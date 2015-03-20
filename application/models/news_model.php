<?php
class News_model extends CI_Model
{
    function get_news($number = 10, $start = 0)
    {
        $this->db->select('*, news.id as id');
        $this->db->from('news');
        $this->db->join('users' , 'users.id = news.user_id');
        $this->db->order_by('date_added','desc');
        $this->db->limit($number, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_news_count()
    {
        $this->db->select()->from('news');
        $query = $this->db->get();
        return $query->num_rows;
    }
    function get_user_news($number = 10, $start = 0)
    {
        $this->db->select('*, news.id as id');
        $this->db->from('news');
        $this->db->join('users' , 'users.id = news.user_id');
        $this->db->where('user_id' , $this->session->userdata('user_id'));
        $this->db->order_by('date_added','desc');
        $this->db->limit($number, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_user_news_count()
    {
        $this->db->select()->from('news');
        $this->db->where('user_id' , $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->num_rows;
    }
    function get_one_news($news_id)
    {
        $this->db->select('*, news.id as id');
        $this->db->from('news');
        $this->db->join('users' , 'users.id = news.user_id');
        $this->db->where('news.id' , $news_id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function insert_news($data)
    {
        $this->db->insert('news',$data);
        return $this->db->insert_id();
    }
    
    function delete_news($news_id)
    {
        $this->db->where('id',$news_id);
        $this->db->delete('news');
    }
}
