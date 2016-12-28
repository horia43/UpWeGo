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

$secret_key="key-587313660811b72439cdd67c897ea689";
$domain = "sandbox9ca54d91dbdf46b4b961f7700fa16fc4.mailgun.org";

#email options
$Option['FROM_MAIL']="postmaster@sandbox9ca54d91dbdf46b4b961f7700fa16fc4.mailgun.org";
$Option['FROM_NAME']="Gorillaz";
$Option['TO_MAIL']="hbsfirstfugitive@gmail.com";
$Option['TO_NAME']="Mr. Stancu";
$Option['SUBJECT']="This is so going to be awesome";
$Option['BODY_TEXT']="Here is some plain message";
$Option['BODY_HTML']="<b style='color:red'>Ia de aici !</b>";

### Calling mailGun API ###

#Include the Autoloader

require  'vendor/autoload.php';
use Mailgun\Mailgun;

$client = new \GuzzleHttp\Client([
    'verify'=>false,
]);

$mailgun = new Mailgun($secret_key, new \Http\Adapter\Guzzle6\Client($client));

#Instantiate the client with option to disable ssl verification.


# pass te client to Guzzle Adapter

# $adapter = new \Http\Adapter\Guzzle6\Client($client);

# pass the Adapter to mailgun object

# $mailgun = new \Mailgun\Mailgun($secret_key,$adapter);

# Make the call to the client.

$result= $mailgun->sendMessage($domain,array(
   'from'       =>"{$Option['FROM_NAME']} <{$Option['FROM_MAIL']}>",
   'to'         =>"{$Option['TO_NAME']} <{$Option['TO_MAIL']}>",
   'subject'    =>$Option['SUBJECT'],
   'text'       =>$Option['BODY_TEXT'],
   'html'       =>$Option['BODY_HTML'],
));
# result will return as object //let's test it
# var_dump($result);

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->helper('url');
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
            redirect('login', 'refresh');
        }

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

        $this->db->select("*");
        $this->db->where('admin !=', 1);
        $this->db->limit($itemsPerPage, ($indexPage-1)*$itemsPerPage);
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


        $this->db->select("*");
        $this->db->where('admin !=', 1);
        $select = $this->db->get("user");
        $pageCount = $select->num_rows();
        $pageCount=ceil($pageCount/$itemsPerPage);
        $data['pageCount']=$pageCount;


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
    function pageindex(){


        $this->load->helper('url');
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
            redirect('login', 'refresh');
        }

        if($this->input->get('items')!=NULL){
            $itemsPerPage=$this->input->get('items');
        }
        else{
            $itemsPerPage = 5;
        }
        $indexPage = $this->input->get('page');



        /*$this->db->count_all("user");
        $this->db->where('admin !=', 1);
        $select = $this->db->get("user");
        $pageCount = $select->result();
        $numberPages=count($pageCount);
        $data['numberPages']=$numberPages;*/

        $this->db->select("*");
        $this->db->where('admin !=', 1);
        $select = $this->db->get("user");
        $pageCount = $select->num_rows();
        $pageCount=ceil($pageCount/$itemsPerPage);
        $data['pageCount']=$pageCount;

        if($indexPage>$pageCount){
            $indexPage=$pageCount;
            $var=$_GET;
            $_GET['page']=$pageCount;

        }


        $this->db->select("*");
        $this->db->where('admin !=', 1);
        $this->db->limit($itemsPerPage, ($indexPage-1)*$itemsPerPage);
        $select = $this->db->get("user");
        $users = $select->result_array();
        $data['myUsers'] = $users;

        $this->load->view('ListUsers', $data);


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
                        'admin' => '0'
                    );
                    $this->db->insert('user', $data);
                }else{
                    $data = array(
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('username'),
                        'admin' => '0'
                    );
                    $this->db->insert('user', $data);
                }
                redirect('admin', 'refresh');

            }
        }


        $this->load->view("adduser");
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
                        'username' => $this->input->post('username')

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
                    if ($query->row()->picture!=NULL) {

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

        $this->db->select('username,firstname,lastname,email,picture');
        $this->db->where('id=', $this->input->get('id'));
        $select = $this->db->get('user');
        $users = $select->result_array();
        $data['myUser'] = $users;


        $this->load->view("edituser", $data);
    }


    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

}

?>
