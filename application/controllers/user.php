<?php

class User extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        if ($this->session->userdata('logged_in') && !$this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
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

        $this->db->select("id");
        $this->db->where('username=', $data['username']);
        $query = $this->db->get("user");
        $id_employee = $query->result_array()[0]['id'];

        $yearPicked = "2017";


        $this->db->select("*");
        $this->db->where("id_employee=", $id_employee);
        $this->db->like("s_date", $yearPicked);
        $select = $this->db->get("salary");

        //$select = $this->db->query('SELECT * FROM salary WHERE id_employee="' . $id_employee . '"');
        $jsonArray = array();


        if ($select->num_rows() > 0) {
            foreach ($select->result_array() as $row) {
                $jsonArrayItem = array();
                $jsonArrayItem['payment_id'] = $row['payment_id'];
                $jsonArrayItem['s_date'] = $row['s_date'];
                $jsonArrayItem['s_amount'] = $row['s_amount'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }

        $jsonArray = json_encode($jsonArray);
        $data = array(
            'json' => $jsonArray
        );
        /*header('Content-type: application/json');
        echo '<pre>';
        print_r($jsonArray);
        echo '</pre>';
        echo json_encode($jsonArray);*/
        //$row = $select->fetch_array();
        //echo '<pre>';
        //var_dump($row);
        //print_r($select);
        //echo $row;
        //echo '</pre>';


        /*$user_details = $select->result_array();
        $data['userDetails'] = $user_details;*/

        /*$response = array(
            "success" => true//, // e o cheie de tip string success
        );
        echo json_encode($response);
        */
        //if ($this->input->post($yearPicked) == null) {
        $this->load->view('user', $data);
        //}

    }

    function changeChart()
    {
        try {


            if ($this->session->userdata('logged_in') && !$this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
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

            $this->db->select("id");
            $this->db->where('username=', $data['username']);
            $query = $this->db->get("user");
            $id_employee = $query->result_array()[0]['id'];

            $yearPicked = $this->input->post('yearPicker');


            $this->db->select("*");
            $this->db->where("id_employee=", $id_employee);
            $this->db->like("s_date", $yearPicked);
            $select = $this->db->get("salary");


            //propunere formatare date

            $salaries = array();
            $months=array("Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August","Septembrie","Octombrie","Noiembrie","Decembrie");

            for($i=1; $i<=12; $i++){
                //$date = substr(sprintf("%s-%02d", $yearPicked, $i),5);        // date = 2017-01/02/03/04/05/...11/12
                //$date = substr(sprintf("%s-%d", $yearPicked, $i),5);        // date = 2017-01/02/03/04/05/...11/12
                $date=$months[$i-1];                                            //date=Jan,Feb, etc.
                $salaries[$date] = array(                           // salaries["2017-01"] = { "s_date" : "2017-01" , "s_amount" : 0 }
                    "s_date"    =>  $date,                          // salaries["2017-02"] = { "s_date" : "2017-02" , "s_amount" : 0 }
                    "s_amount"  =>  0
                );
            }


            /*if ($select->num_rows() > 0) {
            foreach ($select->result_array() as $row) {                                 //$row["s_date"] == "2017-01", il numim $data , valoare extrasa din db
                    $salaries [$row['s_date']] ["s_amount"] = $row['s_amount'];           //$salaries [$data] ["s_amount"] = $row["amount"]  in salaries,
                }                                                                       //la obiectul retinut la indexul data , schimba ammount cu valoarea din db
            }*/
            /*if ($select->num_rows() > 0) {
                foreach ($select->result_array() as $row) {
                    $salaries[$row['s_date']] = array(
                        "s_date"    =>  $row['s_date'],
                        "s_amount"  =>  $row['s_amount']
                    );
                }
            }*/

            if ($select->num_rows() > 0) {
                foreach ($select->result_array() as $row) {
                    $row["s_date"]=$months[substr($row["s_date"],6)-1];        // * //
                    $salaries[$row['s_date']] = array(
                        "s_date"    =>  $row['s_date'],
                        "s_amount"  =>  $row['s_amount']
                    );
                }
            }
            $salaries_json = json_encode(array_values($salaries));










            $month = '01';
            $default_json = array();                                      // creez un json cu date default pt lunile anului si salariile = 0
            for ($i = 1; $i < 13; $i++) {
                $dateItem =$yearPicked . "-" . sprintf("%02d", $month);
                $jsonArrayItem = array(
                    "s_date"    =>  $dateItem,
                    "s_amount"  =>  0
                );
                /*$jsonArrayItem['s_date']    = $dateItem;
                $jsonArrayItem['s_amount']  = 10000;*/                        // Am nevoie sa fie caracter ? "0"
                array_push($default_json, $jsonArrayItem);
                $month++;
            }

            $jsonArray = array();


            if ($select->num_rows() > 0) {
                foreach ($select->result_array() as $row) {
                    $jsonArrayItem = array();
                    //$jsonArrayItem['payment_id'] = $row['payment_id'];
                    $jsonArrayItem['s_date']    = $row['s_date'];
                    $jsonArrayItem['s_amount']  = $row['s_amount'];
                    //append the above created object into the main array.
                    array_push($jsonArray, $jsonArrayItem);
                    for ($i = 0; $i < 12; ++$i) {
                        if($default_json[$i]['s_date']==$row['s_date']) {
                            $default_json[$i]['s_amount'] = $row['s_amount'];
                        }
                    }
                }
            }



            function cmp($a, $b)
            {
                return strcmp($a["s_date"], $b["s_date"]);
            }
            usort($jsonArray,"cmp");


           /*
           foreach ($jsonArray as $row) {
                foreach ($default_json as $row2) {
                    if($row["s_date"]==$row2["s_date"]){
                        $row["s_amount"] = $row2["s_amount"];
                    }
                }
            }
            */



            $default_json   = json_encode($default_json);
            $jsonArray      = json_encode($jsonArray);
            //$jsonArray=array_sort($jsonArray, 's_date', SORT_ASC);



           /* for ($i = 0; $i < 13; ++$i) {
                for ($j = 0; $j < $select->num_rows(); ++$j) {
                    if($default_json[i]['s_date']==$jsonArray[j]['s_date']) {
                        $default_json[i]['s_amount'] = $jsonArray[j]['s_amount'];
                    }
                }
            }*/



            $response = array(
                "success" => true, // e o cheie de tip string success
                "data" => $salaries_json
            );


        } catch (Exception $e) {
            $response = array(
                "success" => false//, // e o cheie de tip string success
                //"msg" => $e->getMessage() // preiau mesajul "umpleti campul"
            );
        }
        echo json_encode($response);
    }



    function downloadPDF(){



       /* $this->load->library('tcpdf/pdf');
        $this->load->helper('url');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        $pdf->Write(5, 'Some sample text');
        $pdf->Output('pdf-example.pdf', 'I');*/
        //require_once(APPPATH.'libraries\tcpdf\tcpdf.php');
        //require_once(APPPATH.'libraries/tcpdf/tcpdf.php');
        //$this->load->library('Pdf');
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        /*$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle("Acesta este titlul");
        $pdf->SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
        $pdf->SetDefaultMonospacedFont('helvetica');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->setAutoPageBreak(TRUE,10);
        $pdf->SetFont('helvetica','',12);

        $content='';
        $content.=  '
        <div>
                            <h2>Hello,Horia</h2>
                            <p>Thank you for joining our team, everything is almost set up.</p>
                            <p>You can login with the following credentials after you have activated your account by pressing the url below.</p>
                            
                            <p>Activation URL: </p>
                            <p><i>Random Link</i></p>
        </div>
                    ';
        $pdf->AddPage();*/
        /*$pdf->writeHTML($content);
        $pdf->Output("sample.pdf","I");*/


        $this->load->library('Pdf');

        $pdf = new Pdf();
        $pdf->SetTitle('My Title is best test ever!!!');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        // set text shadow effect
                $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;
        
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $pdf->Output('My-File-Name.pdf', 'I');
        //echo var_dump($pdf);






        exit;
        $response = array(
               "success" => true,//, // e o cheie de tip string success
               "data" => "Am trimis true!" // preiau mesajul "umpleti campul"
               //"msg" => $e->getMessage() // preiau mesajul "umpleti campul"
           );
           echo json_encode($response);
           exit;


            $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Pdf Example');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->Write(5, 'CodeIgniter TCPDF Integration');
            $pdf->Output('pdfexample.pdf', 'I');




        //exit;

    }


    /*public function tralala(){
        $this->load->view('second');
    }*/
}
