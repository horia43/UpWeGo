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
        $data['json'] =$jsonArray;

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
        //$this->load->view('flyer');
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

        /*
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



        $this->load->library('Pdf');

        $pdf = new Pdf();
        $pdf->SetTitle('My Title is best test ever!!!');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(0);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        // set text shadow effect
        //        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = <<<EOD
<style>
        #container-parent {
            font-family: 'Muli', sans-serif;
            background-color: #7f7f7f;
            padding: 5% 0;
        }
        #container {
            width: 1000px; /*90%*/
            margin: 0 auto;
            top:150px;
            border:1px solid black;
            background-color:#D8D8D8;
            padding-left:25px;
            overflow:hidden;
        }
        .h1 {
            width:190px;
            margin:0 auto;
            font-size: 45px;
            padding-top: 50px;
            text-align: center;
            border-bottom:3px solid black;
            font-weight: bolder;
        }

        .h2 {
            font-size: 30px;
            padding-top: 5px;
            text-align: center;
            font-weight: bolder;
        }
        #logo{
            position:relative;
            bottom:110px;
            right:70px;
            width:179px;
            height:200px;
            background: url(<?php echo base_url();?>upload/UpWeGo_Logo.png);
            float:right;
            clear:left;
        }
        #qr_code{
            width:200px;
            height:200px;
            background: url(<?php echo base_url();?>upload/qr_code_pdf.jpg);
            background-size:cover;
            float:right;
            display:inline-block;
            margin-bottom:45px;
            margin-right:100px;
        }
        .details{
            padding-top: 15px;
        }
        .details p {
            font-size: 13px;
            margin-top: 1px;
            margin-bottom: 1px;
            padding-top: 1px;
            padding-bottom: 1px;
        }
        .details p span,td span{
            font-weight: bold;
        }
        .details2 p{
            font-weight: bold;
            margin-top:10px;
            margin-bottom:0px;
        }
        table{
            width:80%;
            margin:40px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        .darker{
            background-color: #BEBEBE;
        }
</style>

<div id="container-parent">
    <div id="container">
        <div style="width:100%; height:auto; overflow: hidden; ">
            <div class="h1">UpWeGo</div><hr style="width:160px; height:2px; background-color:#3c3c3c;"><hr style="width:120px; height:2px;background-color:#5f5f5f;">
            <div class="h2" style="clear:both;">Pay Slip</div>
            <div id="logo"></div>
            <div class="details">
                <p><span>Adress:</span> Calea Septembrie 13 , nr. 113	, Bucuresti	sector 5</p>
                <p><span>Phone:</span> 021 224 75 21</p>
                <p><span>Fax:</span> 021 224 75 20</p>
                <p><a href="www.upwego.com">www.upwego.com</a></p>
            </div>
        </div>
        <div class="details2">
            <p>Nume si Prenume:</p>
            <p>Anul si luna:</p>
        </div>
        <table>
            <thead colspan="3">Salariu de plata</thead>
            <tr class="darker">
                <td><span>Salariu de baza</span></td>
                <td> </td>
                <td>10000 (+)</td>
            </tr>
            <tr>
                <td>Nr. tichete de masa</td>
                <td> </td>
                <td>20</td>
            </tr>
            <tr>
                <td>Val. tichete de masa</td>
                <td> </td>
                <td>200</td>
            </tr>
            <tr>
                <td>Decontare transport</td>
                <td> </td>
                <td>100(+)</td>
            </tr>
            <tr>
                <td>Contributie C.A.S. </td>
                <td>10.5%</td>
                <td> (-)</td>
            </tr>
            <tr>
                <td>Contributie ajutor somaj </td>
                <td>0.5%</td>
                <td> (-)</td>
            </tr>
            <tr>
                <td>Contributie C.A.S.S. </td>
                <td>5.5%</td>
                <td> (-)</td>
            </tr>
            <tr class="darker">
                <td><span>Venit baza calc. impoz.</span></td>
                <td> </td>
                <td> </td>
            </tr>
            <tr>
                <td>Impozit</td>
                <td>16%</td>
                <td> (-)</td>
            </tr>
            <tr class="darker">
                <td><span>Salariu net</span></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <div id="qr_code"></div>

    </div>
</div>

EOD;

        $html= file_get_contents("application/views/flyer.php");
        
        // Print text using writeHTMLCell()
        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        //$pdf->writeHTML($html);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('My-File-Name.pdf', 'I');
        //echo var_dump($pdf);

    }


}
