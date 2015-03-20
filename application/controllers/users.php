<?php

class Users extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    function login()
    {
        if($this->session->userdata("user_id"))//If already logged in
        {
            redirect(base_url());//redirect to home page
        }
        $data['error'] = 0;
        if($this->input->post())//data inputed for login
        {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $user = $this->user_model->login($username, $password);
            if(!$user)
            { 
                $data['error'] = 1;
            }
            else if($user['status'] == 0)
            {
                $data['error'] = 2;
            }
            else //when user exist
            {
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('username', $user['username']);
                redirect(base_url().'news/user');
            }
        }
        
        $data['content'] = 'users/login';
        $this->load->view('includes/template' , $data);
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url().'news/');
    }
    function register()
    {
        $data['error'] = NULL;
        $data['message'] = NULL;
        if($this->input->post())
        {
            $config = array(
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'trim|required|min_length[3]|is_unique[users.username]'//is unique username in the user's table of DB
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|is_unique[users.email]|valid_email',//is unique email in the user's table of DB
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
                $user_data = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password')),
                    'status' => 0,
                    'activation_code' => md5(uniqid(rand(), true))
                );
                
                if($this->user_model->create_user($user_data))
                {
                    $this->load->library('email');

                    $this->email->from('noreply@newsapp.com', 'News App');
                    $this->email->to( $user_data['email']);
                    $this->email->subject('Activate your account at newsapp.com');

                    $email_data['user'] = $user_data;
                    $email_data['content'] = 'emails/activate';
                    $this->email->set_mailtype("html");
                    $this->email->message($this->load->view('includes/email' , $email_data , true));

                    $this->email->send();

                    $data['message'] = 'A confirmation link is sent to your registered email. Please activate your account using the link';
                }
            }
            
        }
        
        $data['content'] = 'users/register';
        $this->load->view('includes/template',$data);
    }

    // Activating user
    function activate($activation_code)
    {
        if($this->session->userdata("user_id") || !$activation_code)//If already logged in
        {
            redirect(base_url());
        }
        $data['error'] = false;
        $activation_error = false;
        $user = $this->user_model->get_by_activation_code($activation_code);
        if($user)
        { 

            $user_data = array(
                'status' => 1
            );
                    
            $this->user_model->update_user(array('id' => $user['id']) , $user_data);

            if($this->input->post())
            {
                $config = array(
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required|min_length[5]|max_length[20]'
                    ),
                    array(
                        'field' => 'passconf',
                        'label' => 'Password confirmed',
                        'rules' => 'trim|required|matches[password]',
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
                    $user_data = array(
                        'password' => sha1($this->input->post('password')),
                        'activation_code' => NULL
                    );
                    
                    $this->user_model->update_user(array('id' => $user['id']) , $user_data);

                    $this->session->set_flashdata('message' , 'Password created');
                    redirect(base_url('users/login'));
                }
                
            }

        }
        else //when user dont exist
        {
            $activation_error = true;
        }
        
        $data['activation_error'] = $activation_error;
        $data['content'] = 'users/activate';
        $this->load->view('includes/template',$data);
    }
}