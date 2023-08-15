<head>
  <meta http-equiv=refresh URL="ob_2BAR3_TRIMESTER_USG_REPORT.php" content="3">
</head>
<style>
.example_a {
color: #fff !important;
text-transform: uppercase;
text-decoration: none;
padding: 20px;
border-radius: 5px;
display: inline-block;
border: none;
transition: all 0.4s ease 0s;
}
.example_b {
color: #fff !important;
text-transform: uppercase;
text-decoration: none;
padding: 20px;
border-radius: 5px;
display: inline-block;
border: none;
transition: all 0.4s ease 0s;
}
.example_c {
color: #fff !important;
text-transform: uppercase;
text-decoration: none;
padding: 20px;
border-radius: 5px;
display: inline-block;
border: none;
transition: all 0.4s ease 0s;
}
.print{
  background: #1680d3;
}
.cancel{
  background: #ed3330;
}
.save{
  background: #4aa64a;
}
.example_a:hover {
background: #434343;
letter-spacing: 2px;
-webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
-moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
transition: all 0.4s ease 0s;
}
.example_b:hover {
background: #059b86;
letter-spacing: 2px;
-webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
-moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
transition: all 0.4s ease 0s;
}
.example_c:hover {
background: #22d790;
letter-spacing: 2px;
-webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
-moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
transition: all 0.4s ease 0s;
}
p{
  letter-spacing:2px;
}
.underline{
border-bottom: 1px solid;
width: 80%;
display: block;
}
</style>

<div id="printableArea">
  <?php
  if(!isset($_SESSION)) {
    session_start();
  }
   $user = $_SESSION["username"];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gjk";
  // Create connection

  //require 'dbcon.php';

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
  }//& password='$pass'

  $name = "";
  $desig="";
    if(!isset($_SESSION)) {
      session_start();
    }
     $user = $_SESSION["username"];
     $sql = "select * from user_account where username= '$user' ";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
         if($row = $result->fetch_assoc()) {
             $name=$row['fullname'];
             $desig = $row['degree'];
         }
     }
     $sql = "SELECT * FROM patient_record_header where attendedby = '$user' AND report_type='pelvistwo' AND status='notPrinted'";
     $pid="";
     $age="";
     $gender="";
     $referred="";
     $patient_name="";
     $indication="";
     $rkey="";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          if($row = $result->fetch_assoc()) {
              $pid=$row['pid'];
              $age=$row['age'];
              $gender=$row['gender'];
              $referred=$row['referredby'];
              $patient_name=$row['name'];
              $indication=$row['indication'];
              $rkey=$row['rkey'];
          }else {
            echo("Error description: " . $conn -> error);
          }
      }else {
echo($conn -> error);      }
require 'header_file_pelvis.php';
//pelvis report 2 parameters
$tvaginal="";
$tabdominal="";
$uappear = "";
$umeasure = "";
$cavity = "";
$emt = "";
$rom = "";
$ro = "";
$rocomment = "";
$lom = "";
$lo = "";
$locomment = "";
$impression = "";
$sql2 = "select * from pelvistwo where rkey= '$rkey'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    if($row2 = $result2->fetch_assoc()) {
      $tvaginal = $row2['tvaginal'];
      $tabdominal = $row2['tabdominal'];
      $uappear = $row2['uterus_appeared'];
      $umeasure = $row2['u_measured'];
      $cavity =$row2['cavity'];
      $emt = $row2['endomaterial_thickness'];
      $rom = $row2['ro_measure'];
      $ro = $row2['ro'];
      $rocomment = $row2['ro_comment'];
      $lom = $row2['lo_measure'];
      $lo = $row2['lo'];
      $locomment = $row2['lo_comment'];
      $impression= $row2['impression'];
    }
}

 ?>
<br/><br/>
<center>
  <u style="color:#21618c;"><h2 style="color:#21618c;">Haemo-Dialysis Report</h2></u>
  <p align="left"style="padding-left:5%;">Real time Haemo-Dialysis done.<br/><br/>
  <u><b style="font-size:20px; color:#21618c;">Veins</b></u><br/><br/>
<font style="padding-left:5%;">Is normal contour. No intraluminal echoes.</font><br/><br/>

<u><b style="font-size:20px; color:#21618c;">Dialysis</b></u><br/><br/>
<font style="padding-left:5%;"><?php
if($tvaginal == "yes" && $tabdominal == "yes"){
  echo "Trans-abdominal <span>&#10003;</span> & Transvaginal <span>&#10003;</span>";
}elseif ($tvaginal == "yes" && $tabdominal == "no") {
  echo "Trans-abdominal / Transvaginal <span>&#10003;</span>";
}elseif ($tvaginal == "no" && $tabdominal == "yes") {
  echo "Trans-abdominal <span>&#10003;</span> / Transvaginal";
}else {
  echo "Trans-abdominal / Transvaginal";
} ?> Calcium </font><br/>
<font style="padding-left:5%;">Urine Test <?php
if($uappear=="antiverted"){
  echo "high <span>&#10003;</span> / low ";
}elseif($uappear == "retroverted") {
  echo " high  / low <span>&#10003;</span> ";
}else {
  echo "high / low";
} ?> </font><br/>
<font style="padding-left:5%;">U <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $umeasure." "; ?></font></font><br/>
<font style="padding-left:5%;">Creatinine</font><br/>
<font style="padding-left:5%;">Abnormal - with</font><br/><br/>
<font style="padding-left:5%;">Cavity echo appeared normal / Abnormal</font><br/>
<font style="padding-left:5%;">Weight <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $emt." Kg"; ?></font></font><br/>
<font style="padding-left:5%;"><font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $rom." "; ?></font></font><br/>
<font style="padding-left:5%;">Blood Pressure<?php
if($ro == "normal"){
  echo " normal <span>&#10003;</span> / abnormal ";
}elseif($ro == "abnormal") {
  echo " normal  / abnormal <span>&#10003;</span> ";
}else {sss
  echo " normal / abnormal ";
} ?> <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $rocomment; ?></font></font><br/>
<font style="padding-left:5%;"><font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $lom." "; ?></font></font><br/>
<font style="padding-left:5%;">Apperance <?php
if($lo == "normal"){
  echo " normal <span>&#10003;</span> / abnormal ";
}elseif($lo == "abnormal") {
  echo " normal / abnormal <span>&#10003;</span> ";
}else {
  echo " normal / abnormal ";
} ?>  <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $locomment; ?></font></font><br/>
</p><br>
</p>


<p align="left" class="underline" style="padding-left:5%;"><u style="color:#21618c;"><b style="font-size:20px; color:#21618c;">Impression</b></u><br/><br/><?php echo $impression; ?></p>


<br>
<br>
<table width="100%">
<tr>
  <td width="50%"></td>
  <td><center><?php echo $name.".,".$desig ?></center></td>
</tr>

</table>
</center>


</div>
<?php require 'footer.php'; ?>
