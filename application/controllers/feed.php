<?php
class Feed extends CI_Controller {
     
    function __construct() 
    {
        parent::__construct();
         
        $this->load->helper('xml');
        $this->load->helper('text');
        $this->load->model('news_model');
    }
     
    function index()
    {
        $data['feed_name'] = 'NewsApp.com';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = base_url('feeds');
        $data['page_description'] = 'Rss feed of News App';
        $data['page_language'] = 'en-en';
        $data['creator_email'] = 'mail@newsapp.com';
        $data['news'] = $this->news_model->get_news();   
        header("Content-Type: application/rss+xml");
         
        $this->load->view('rss', $data);
    }
     
}