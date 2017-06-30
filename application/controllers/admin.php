<?php
/**
 * Created by PhpStorm.
 * User: hstancu
 * Date: 10/25/2016
 * Time: 9:36 PM
 */
//  session_start(); ///////////////////

// require mail gun autoload
/// ii trimit un link si ii aparenew password - repeat new password
//un unique id  din php ca sa creez string/ token -ul respectiv pe care trebuie sa il am in baza de date
//


/*$Option['BODY_HTML']="  <div style=\"background-color:black;color:white;padding:20px;\">
                            <h2>London</h2>
                            <p>London is the capital city of England. It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
                            <p>Standing on the River Thames, London has been a major settlement for two millennia, its history going back to its founding by the Romans, who named it Londinium.</p>
                        </div>";*/


require 'vendor/autoload.php';
use Mailgun\Mailgun;

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
        {

            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];  // doar pentru testare
            $data['email'] = $session_data['email'];          // doar pentru testare

            $data['isAdmin'] = $session_data['isAdmin'];    // doar pentru testare
            $data['logged_in'] = $session_data['logged_in'];
            //$this->load->view('ListUsers',$data);
        } else {
            //If no session, redirect to login page
            redirect('welcome', 'refresh');
        }
    }

    function index()
    {

        /*$pass=rand(1000,500000);
        echo $pass;
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        echo '<br>'.$hash;
        $hash2 = password_hash($pass, PASSWORD_BCRYPT);
        echo '<br>'.$hash2.'<br>';
        //if($hash==$hash2){
        if(password_verify($pass,$hash2)){
            echo 'Match !';
        }else{
            echo 'Nein !';
        }*/


        $this->load->database();
        //$select = $this->db->query('SELECT * FROM user');

        /*if($this->input->get('items')!=NULL){
            $itemsPerPage=$this->input->get('items');
        }
        else{
            $itemsPerPage = 3;
        }*/
        $itemsPerPage = 5;
        $indexPage = 1;//$this->input->get('pageIndex');

        $this->db->order_by("active", "desc");
        $this->db->select("*");
        $this->db->where('admin !=', 1);
        $this->db->limit($itemsPerPage, ($indexPage - 1) * $itemsPerPage);
        $select = $this->db->get("user");

        $users = $select->result_array();
        $data['myUsers'] = $users;

        /*
        foreach ($select->result() as $row){
            $selectall[] = array(
                'firstname'=>$row->firstname,
                'lastname'=>$row->lastname,
                'username'=>$row->username,
                'email'=>$row->email,
                'picture'=>$row->picture,
                'admin'=>$row->admin,
                'active'=>$row->active
            );
        }*/

        /* foreach ($select->result() as $row){

                 $data['firstname']=$row->firstname;
                 $data['lastname']=$row->lastname;
                 $data['username']=$row->username;
                 $data['email']=$row->email;
                 $data['picture']=$row->picture;
                 $data['admin']=$row->admin;
                 $data['active']=$row->active;
         }
         */

        /*$sdata = array( $data, $selectall);
        $this->load->view('ListUsers',$sdata);*/

        $this->db->order_by("active", "desc");
        $this->db->select("*");
        $this->db->where('admin !=', 1);
        $select = $this->db->get("user");
        $pageCount = $select->num_rows();
        $pageCount = ceil($pageCount / $itemsPerPage);
        $data['pageCount'] = $pageCount;


        $this->load->view('ListUsers', $data);
        //$this->load->view('ListUsers',$data,$selectall);


        /*if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('ListUsers', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }*/
    }

    function pageindex()
    {

        /*$field  = $this->input->get('field');
        $search = $this->input->get('search');

        $this->db->order_by("active","desc");
        $this->db->select("*");
        $this->db->like($field, $search);
        $select = $this->db->get("user");

        $users = $select->result_array();
        $data['myUsers'] = $users;*/

        if ($this->input->get('field') != NULL && $this->input->get('search') != NULL) {

            $field  = $this->input->get('field');
            $search = $this->input->get('search');
            if ($this->input->get('items') != NULL) {
                $itemsPerPage = $this->input->get('items');
            } else {
                $itemsPerPage = 5;
            }
            if ($this->input->get('page') != NULL) {
                $indexPage = $this->input->get('page');
            } else {
                $indexPage = 1;
            }



            $this->db->order_by("active", "desc");
            $this->db->select("*");
            $this->db->like($field, $search);
            $this->db->where('admin !=', 1);
            $select = $this->db->get("user");
            $pageCount = $select->num_rows();
            $pageCount = ceil($pageCount / $itemsPerPage);
            $data['pageCount'] = $pageCount;
            if($pageCount==0){
                echo '<script type="text/javascript">alert("Nu exista rezultate pentru cautarea efectuata!\\nInapoi la pagina principala");</script>';
                redirect('admin', 'refresh');
                exit;
            }
            if ($indexPage > $pageCount) {
                $indexPage = $pageCount;
                $var = $_GET;
                $_GET['page'] = $pageCount;

            }

            $this->db->order_by("active", "desc");
            $this->db->select("*");
            $this->db->like($field, $search);
            $this->db->where('admin !=', 1);
            $this->db->limit($itemsPerPage, ($indexPage - 1) * $itemsPerPage);
            $select = $this->db->get("user");
            $users = $select->result_array();
            $data['myUsers'] = $users;

            $this->load->view('ListUsers', $data);
        } else {

            //echo '<script type="text/javascript">alert("hello!");</script>';
            if ($this->input->get('items') != NULL) {
                $itemsPerPage = $this->input->get('items');
            } else {
                $itemsPerPage = 5;
            }
            $indexPage = $this->input->get('page');


            $this->db->order_by("active", "desc");
            $this->db->select("*");
            $this->db->where('admin !=', 1);
            $select = $this->db->get("user");
            $pageCount = $select->num_rows();
            $pageCount = ceil($pageCount / $itemsPerPage);
            $data['pageCount'] = $pageCount;

            if ($indexPage > $pageCount) {
                $indexPage = $pageCount;
                $var = $_GET;
                $_GET['page'] = $pageCount;

            }

            $this->db->order_by("active", "desc");
            $this->db->select("*");
            $this->db->where('admin !=', 1);
            $this->db->limit($itemsPerPage, ($indexPage - 1) * $itemsPerPage);
            $select = $this->db->get("user");
            $users = $select->result_array();
            $data['myUsers'] = $users;

            $this->load->view('ListUsers', $data);
        }

    }

    function pageadduser()
    {
        if ($this->input->post()) {
            $this->load->database();

            $this->db->select('username');
            $this->db->where('username=', $this->input->post('username'));
            $query = $this->db->get('user');

            $this->db->select('email');
            $this->db->where('email=', $this->input->post('email'));
            $query2 = $this->db->get('user');


            if ($query->num_rows() > 0) {
                $message = "Username already exists. Please try a different username.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif ($query2->num_rows() > 0) {
                $message = "This email is already being used. Please try a different email.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif (!(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL))) {
                $message = "This email is not valid.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {

                $secret_key = "key-1a09ec0d388ee909db72392f91315f3f";  // apparently it's the same
                $domain = "sandbox3e9b9f50dadb48a09d73f35a82204c0c.mailgun.org";

                //$html= $this->load->view('pinql', '', true);

                $pass = rand(1000, 500000);
                $hash = password_hash($pass, PASSWORD_BCRYPT);
                //$link= 'http://gorillaz/UpWeGo/verify.php?email='.$this->input->post("email").'&hash='.$hash;
                $link = base_url() . 'login/verify?email=' . $this->input->post("email") . '&hash=' . $hash;


                /*if(password_verify($pass,$hash)){
                    echo 'Match !';
                }else{
                    echo 'Nein !';
                }*/

                $Option['FROM_MAIL'] = "postmaster@sandbox9ca54d91dbdf46b4b961f7700fa16fc4.mailgun.org";
                $Option['FROM_NAME'] = "UpWeGo";
                $Option['TO_MAIL'] = $this->input->post('email');
                $Option['TO_NAME'] = "Mr/Mrs." . $this->input->post('lastname');
                $Option['SUBJECT'] = "UpWeGo Registration";
                $Option['BODY_TEXT'] = "Here is some plain message";
                $Option['BODY_HTML'] = '  
                        <head>
                            <style>
                                p{
                                    color:yellow;
                                }
                                i{
                                    color:#0645AD;
                                }
                                li{
                                    color:sandybrown;
                                }
                            </style>
                        </head> 
                        <body>
                        
                        <div style="background-color:black; color:white; padding:20px; width:100%; height:700px;">
                            <h2>Hello,' . $this->input->post('lastname') . '</h2>
                            <p>Thank you for joining our team, everything is almost set up.</p>
                            <p>You can login with the following credentials after you have activated your account by pressing the url below.</p>
                            
                            <p>Activation URL: </p>
                            <p><i>' . $link . '</i></p>

                            -------------------------------
                            <p>Username: ' . $this->input->post('username') . '</p>
                            <p>Password: ' . $pass . '</p>
                            -------------------------------
                           
                            <p>This password was assigned automatically. For better security, change the password after first login or as soon as possible.</p>
                            <p>Here are some tips to help you create a strong password:</p>

                            <ul>
                                <li>Make sure your password is at least eight characters in length.</li>
                                <li>Combine numbers and letters, and don\'t include commonly used words.</li>
                                <li>Select a word or acronym and insert numbers between some of the letters.</li>
                                <li>Include punctuation marks.</li>
                                <li>Mix capital and lowercase letters.</li>
                            </ul>
                            <p>For your security, we recommend that you don\'t reuse passwords associated with your email address or any other type of account. Additionally, if you enter your original password as your new password, you may trigger an error message. Create an entirely new password the next time you sign in.</p>
                        
                        
                        </div>
                        </body>';

                $client = new \GuzzleHttp\Client([
                    'verify' => false,
                ]);
                $mailgun = new Mailgun($secret_key, new \Http\Adapter\Guzzle6\Client($client));

                $mailgun->sendMessage($domain, array(
                    'from' => "{$Option['FROM_NAME']} <{$Option['FROM_MAIL']}>",
                    'to' => "{$Option['TO_NAME']} <{$Option['TO_MAIL']}>",
                    'subject' => $Option['SUBJECT'],
                    'text' => $Option['BODY_TEXT'],
                    'html' => $Option['BODY_HTML'],
                ));
                //echo $html;
                //echo "<script type='text/javascript'>alert('$html');</script>";


                if ($this->input->post('fileInputName') != '') {
                    $extension_pos = strrpos($this->input->post('fileInputName'), '.'); // find position of the last dot, so where the extension starts
                    $new_name = $this->input->post('username') . "_" . uniqid() . substr($this->input->post('fileInputName'), $extension_pos);


                    $config['upload_path'] = './upload/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 8192000;
                    $config['max_width'] = 9000;
                    $config['max_height'] = 9000;
                    $config['file_name'] = $new_name;

                    $this->load->library('upload', $config);
                    $this->upload->do_upload('fileInput');

                    $data = array(
                        'picture' => $new_name,
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('username'),
                        'admin' => '0',
                        'active' => '0',
                        'password' => $hash,
                        'departament' => $this->input->post('departament'),
                        'functie' => $this->input->post('functie')
                    );
                    $this->db->insert('user', $data);
                } else {
                    $data = array(
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('username'),
                        'admin' => '0',
                        'active' => '0',
                        'password' => $hash,
                        'departament' => $this->input->post('departament'),
                        'functie' => $this->input->post('functie')

                    );
                    $this->db->insert('user', $data);
                }
                redirect('admin', 'refresh');

            }
        }


        $this->load->view("adduser");
    }

    function pageaddsalary()
    {


        if ($this->input->post()) {

            $this->load->database();

            $id_employee = $this->input->get('id');
            $s_amount = $this->input->post('s_amount');
            $s_date = $this->input->post('s_date');

            $this->db->select('payment_id');
            $this->db->where('s_date=', $s_date);
            $this->db->where('id_employee=', $id_employee);
            $select = $this->db->get('salary');

            if ($select->num_rows() > 0) {
                $message = "You already made the payment for this employee on the specific month.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $data = array(
                    'id_employee' => $id_employee,
                    's_amount' => $s_amount,
                    's_date' => $s_date
                );

                $this->db->insert('salary', $data);
                redirect('admin', 'refresh');
            }

        }


        $this->load->database();

        $this->db->select('username,firstname,lastname,email,picture,departament,functie');
        $this->db->where('id=', $this->input->get('id'));
        $select = $this->db->get('user');
        $users = $select->result_array();
        $data['myUser'] = $users;


        $this->load->view("addsalary", $data);
    }

    function pageedituser()
    {
        if ($this->input->post()) {

            $this->load->database();

            $this->db->select('username');
            $this->db->where('username=', $this->input->post('username'));
            $this->db->where('id!=', $this->input->get('id'));
            $query = $this->db->get('user');

            $this->db->select('email');
            $this->db->where('email=', $this->input->post('email'));
            $this->db->where('id!=', $this->input->get('id'));
            $query2 = $this->db->get('user');

            /*$this->db->select('firstname,lastname');
            $this->db->where('firstname=', $this->input->post('firstname'));
            $this->db->where('lastname=', $this->input->post('lastname'));
            $query2 = $this->db->get('user');*/

            /*var_dump($this->input->post('picture'));
            die;*/
            if ($query->num_rows() > 0) {
                $message = "Username already exists. Please try a different username.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif ($query2->num_rows() > 0) {
                $message = "This email is already being used. Please try a different email.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif (!(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL))) {
                $message = "This email is not valid.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {


                if ($this->input->post('fileInputName') == '') {

                    $data = array(
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('username'),
                        'departament' => $this->input->post('departament'),
                        'functie' => $this->input->post('functie')

                    );
                    $this->db->where('id=', $this->input->get('id'));       /////////////////////////////YUHUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU////////////////////
                    $this->db->update('user', $data);
                } else {

                    $this->db->select('picture');
                    $this->db->where('id=', $this->input->get('id'));
                    $query = $this->db->get('user');
                    /*echo '<pre>';
                    var_dump($query->row()->picture!=NULL);
                    echo '<pre>';
                    die;*/
                    if ($query->row()->picture != NULL) {

                        $new_name = $query->row()->picture;

                        /*var_dump($new_name);
                        die;*/

                        $config['upload_path'] = './upload/';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = 8192000;
                        $config['max_width'] = 9000;
                        $config['max_height'] = 9000;
                        $config['file_name'] = $new_name;
                        $config['overwrite'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('fileInput');

                        $data = array(
                            'picture' => $new_name,
                            'firstname' => $this->input->post('firstname'),
                            'lastname' => $this->input->post('lastname'),
                            'email' => $this->input->post('email'),
                            'username' => $this->input->post('username')

                        );
                        $this->db->where('id=', $this->input->get('id'));       /////////////////////////////YUHUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU////////////////////
                        $this->db->update('user', $data);
                    } else {

                        $extension_pos = strrpos($this->input->post('fileInputName'), '.'); // find position of the last dot, so where the extension starts
                        $new_name = $this->input->post('username') . "_" . uniqid() . substr($this->input->post('fileInputName'), $extension_pos);
                        /*                    echo'sunt aici';
                                            var_dump($new_name);
                                            die;*/
                        $config['upload_path'] = './upload/';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = 8192000;
                        $config['max_width'] = 9000;
                        $config['max_height'] = 9000;
                        $config['file_name'] = $new_name;


                        $this->load->library('upload', $config);
                        $this->upload->do_upload('fileInput');

                        $data = array(
                            'picture' => $new_name,
                            'firstname' => $this->input->post('firstname'),
                            'lastname' => $this->input->post('lastname'),
                            'email' => $this->input->post('email'),
                            'username' => $this->input->post('username'),
                            'admin' => '0'
                        );
                        $this->db->where('id=', $this->input->get('id'));       /////////////////////////////YUHUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU////////////////////
                        $this->db->update('user', $data);
                    }

                }
                /////////////////////////////YUHUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU////////////////////
            }
            redirect('admin', 'refresh');
        }

        $this->load->database();

        $this->db->select('username,firstname,lastname,email,picture,departament,functie');
        $this->db->where('id=', $this->input->get('id'));
        $select = $this->db->get('user');
        $users = $select->result_array();
        $data['myUser'] = $users;


        $this->load->view("edituser", $data);
    }

    function makeinactive()
    {

        $this->load->database();
        $data = array(
            'active' => 0
        );
        $this->db->where('id=', $this->input->get('id'));       /////////////////////////////YUHUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU////////////////////
        $this->db->update('user', $data);
        redirect('admin', 'refresh');
    }

}

?>
