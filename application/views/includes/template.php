<!DOCTYPE HTML>
<html>

<head>
    <title>News App</title>
    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/css/style.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('public/images/favicon-16x16.png')?>">
</head>

<body>
    <div id="main">
        <div id="header">
            <div id="logo">
                <h1><a href="<?=base_url()?>news/">News App</a></h1>
            </div>
            <div id="menubar">
                <ul id="menu">
                    <li class="<?=( ($this->uri->segment(1) == 'news' || $this->uri->segment(1) == '' ) && $this->uri->segment(2) != 'user')  ? 'current' : ''?>"><a href="<?=base_url()?>">Home</a></li>
                    <?php if($this->session->userdata('user_id'))
                    {?>
                        <li class="<?=($this->uri->segment(2) == 'user')? 'current' : ''?>" ><a href="<?=  base_url('news/user')?>">My news</a></li>
                        <li class="" >
                            <a href="<?=  base_url('users/logout')?>">
                                Logout
                            </a>
                        </li>
                    <?php
                    } 
                    else{ ?>
                        <li class="<?=($this->uri->segment(2) == 'login')? 'current' : ''?>" ><a href="<?=  base_url()?>users/login">Login</a></li>
                        <li class="<?=($this->uri->segment(2) == 'register')? 'current' : ''?>" ><a href="<?=  base_url()?>users/register/">Register</a></li>
                    <?php } ?>
                    <li><a href="<?=  base_url('feed')?>">RSS</a></li>
                </ul>
            </div>
        </div>

        <div id="site_content">
            <div id="content">
                <?php if($this->session->userdata('user_id')){?>
                    <p style="text-align:center">Welcome  </p>
                <?php } ?>

                <?php if($message = $this->session->flashdata('message')) 
                    echo '<p class="alert green">'.$message.'</p>'; 
                ?>

                <?php $this->load->view($content); ?>

            </div>
        </div>

        <div id="footer">
            <p>Copyright &copy; News App</p>
        </div>
    </div>
    <script src="<?=  base_url()?>public/js/jquery-2.1.1.min.js"></script>
</body>
</html>