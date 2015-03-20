<?php

class News extends CI_Controller
{   
    function __construct() 
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    // Home page / All news
    function index($page = 1)//index page
    {
        $per_page = 10; // news per page
        $start = ($page - 1 ) * $per_page;
        $data['news'] = $this->news_model->get_news($per_page, $start);
        
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url().'news/index/';//url to set pagination
        $config['total_rows'] = $this->news_model->get_news_count();
        $config['per_page'] = $per_page; 
        $this->pagination->initialize($config); 
        $data['pages'] = $this->pagination->create_links(); //Links of pages

        $data['content'] = 'news/index'; // template part
        $this->load->view('includes/template',$data);
        
    }

    // Single News page
    function view($news_id)
    {       
        $data['news'] = $this->news_model->get_one_news($news_id);
        $data['content'] = 'news/view'; // template part
        $this->load->view('includes/template',$data);
    }

    // get pdf view
    function pdf($news_id)
    {
        $this->load->helper(array('dompdf'));  
        $data['news'] = $this->news_model->get_one_news($news_id);
        $data['content'] = 'news/pdf'; // template part  
        $html = $this->load->view('includes/pdf', $data, true);
        pdf_create($html, 'viewnews');
    }
    
    // Create new news
    function add()
    {
        if(!$this->session->userdata('user_id'))//when the user is not an andmin and author
        {
            redirect(base_url().'users/login');
        }
        $data['error'] = NULL;
        if($this->input->post())
        {
            $config = array(
                array(
                    'field' => 'title',
                    'label' => 'Title',
                    'rules' => 'trim|required|min_length[10]'//is unique username in the user's table of DB
                ),
                array(
                    'field' => 'content',
                    'label' => 'News Content',
                    'rules' => 'trim|required|min_length[100]',//is unique email in the user's table of DB
                ),
            );
            $this->load->library('form_validation');
            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE)
            {
                $data['error'] = validation_errors();
            }
            else 
            {
                $config['upload_path'] = './public/uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048'; //in KB
                $config['max_width'] = '1024'; //in px
                $config['max_height'] = '768'; //in px

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload()) {

                    $data['error'] = $this->upload->display_errors();
                }
                else{
                    $upload_data = $this->upload->data();
                    $data = array(
                        'title' => $this->input->post('title'),
                        'content' => $this->input->post('content'),
                        'image' => $upload_data['file_name'],
                        'user_id' => $this->session->userdata('user_id')
                    );
                    $this->news_model->insert_news($data);
                    redirect(base_url().'news/user');
                }
            }
        }
            
        $data['content'] = 'news/add'; // template part
        $this->load->view('includes/template',$data);
    }
    
    // Delete news
    function deletenews($news_id)
    {
        if(!$this->session->userdata('user_id'))
        {
            redirect(base_url().'users/login');
        }
        $this->news_model->delete_news($news_id);
        $this->session->set_flashdata('message' , 'News Deleted');
        redirect(base_url().'news/');
    }

    // User news
    function user($page = 1)//index page
    {
        if(!$this->session->userdata('user_id'))
        {
            redirect(base_url().'users/login');
        }
        $per_page = 10; // news per page
        $start = ($page - 1 ) * $per_page;
        $data['news'] = $this->news_model->get_user_news($per_page, $start);
        
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url().'news/user/';//url to set pagination
        $config['total_rows'] = $this->news_model->get_user_news_count();
        $config['per_page'] = $per_page; 
        $this->pagination->initialize($config); 
        $data['pages'] = $this->pagination->create_links(); //Links of pages

        $data['content'] = 'news/index'; // template part
        $this->load->view('includes/template',$data);
        
    }
    
}