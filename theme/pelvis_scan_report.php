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
     $sql = "SELECT * FROM patient_record_header where attendedby = '$user' AND report_type='pelvis' AND status='notPrinted'";
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
  $rom = "";
  $ro = "";
  $rocomment = "";
  $lom = "";
  $lo = "";
  $locomment = "";
  $impression = "";
  $dte1="";
  $day1="";
  $ro1="";
  $lo1="";
  $emt1="";
  $dte2="";
  $day2="";
  $ro2="";
  $lo2="";
  $emt2="";
  $dte3="";
  $day3="";
  $ro3="";
  $lo3="";
  $emt3="";
  $dte4="";
  $day4="";
  $ro4="";
  $lo4="";
  $emt4="";
  $sql2 = "select * from pelvis where rkey= '$rkey'";
  $result2 = $conn->query($sql2);

  if ($result2->num_rows > 0) {
    if($row2 = $result2->fetch_assoc()) {
      $tvaginal = $row2['tvaginal'];
      $tabdominal = $row2['tabdominal'];
      $uappear = $row2['uterus_appeared'];
      $umeasure = $row2['uterus_measure'];
      $cavity =$row2['cavity'];
      $rom = $row2['ro_measure'];
      $ro = $row2['ro_appear'];
      $rocomment = $row2['ro_comment'];
      $lom = $row2['lo_mesure'];
      $lo = $row2['lo_appear'];
      $locomment = $row2['lo_comment'];
      $impression= $row2['impression'];
      $dte1=$row2["date1"];
      $day1=$row2["day1"];
      $ro1=$row2["ro1"];
      $lo1=$row2["lo1"];
      $emt1=$row2["et1"];
      $dte2=$row2["date2"];
      $day2=$row2["day2"];
      $ro2=$row2["ro2"];
      $lo2=$row2["lo2"];
      $emt2=$row2["et2"];
      $dte3=$row2["date3"];
      $day3=$row2["day3"];
      $ro3=$row2["ro3"];
      $lo3=$row2["lo3"];
      $emt3=$row2["et3"];
      $dte4=$row2["date4"];
      $day4=$row2["day4"];
      $ro4=$row2["ro4"];
      $lo4=$row2["lo4"];
      $emt4=$row2["et4"];
    }
  }

  ?>
  <br/><br/>
  <center>
    <u style="color:#21618c;"><h2 style="color:#21618c;">Haemo-Dialysis Report</h2></u>
    <p align="left"style="padding-left:5%;">Real time Haemo-Dialysis done.<br/><br/>
    <u style="color:#21618c;"><b style="color:#21618c; font-size:20px;">Veins</b></u><br/><br/>
  <font style="padding-left:5%;">Is normal contour. No intraluminal echoes.</font><br/><br/>

  <u style="color:#21618c;"><b style="font-size:20px; color:#21618c;">Dialysis</b></u><br/><br/>
  <font style="padding-left:5%;"><?php
  if($tvaginal == "yes" && $tabdominal == "yes"){
    echo "Calcium High <span>&#10003;</span> & Low <span>&#10003;</span>";
  }elseif ($tvaginal == "yes" && $tabdominal == "no") {
    echo " Calcium High / <span>&#10003;</span> Low";
  }elseif ($tvaginal == "no" && $tabdominal == "yes") {
    echo " Calcium High <span>&#10003;</span> / Low ";
  }else {
    echo "Calcium High / Low";
  } ?> Calcium</font><br/>
  <font style="padding-left:5%;">Potassium <?php
  if($uappear=="antiverted"){
    echo " high <span>&#10003;</span> / low ";
  }elseif($uappear == "retroverted") {
    echo " high/ <span>&#10003;</span> low";
  }else {
    echo "high / low";
  } ?> </font><br/>
  <font style="padding-left:5%;">Urine Test <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $umeasure." "; ?></font></font><br/>
  <font style="padding-left:5%;">Creatinine</font><br/>
  <font style="padding-left:5%;">Abnormal - with</font><br/><br/>
  <font style="padding-left:5%;">Cavity echo appeared
    <?php
  if($cavity == "normal"){
    echo "<b style='color:#21618c;'> normal</b> <span>&#10003;</span> / abnormal ";
  }elseif($cavity == "abnormal") {
    echo " normal / <span>&#10003;</span><b style='color:#21618c;'>abnormal</b> ";
  }else {
    echo " normal / abnormal ";
  }
  ?></font><br/>
  <font style="padding-left:5%;">Weight <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $rom." kg"; ?></font></font><br/>
  <font style="padding-left:5%;">Blood Pressure <?php
  if($ro == "normal"){
    echo " <b style='color:#21618c;'>normal</b> <span>&#10003;</span> / abnormal ";
  }elseif($ro == "abnormal") {
    echo " normal / <b style='color:#21618c;'>abnormal</b> <span>&#10003;</span> ";
  }else {
    echo " normal / abnormal ";
  } ?> <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $rocomment; ?></font></font><br/>
  <font style="padding-left:5%;"> <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $lom.""; ?></font></font><br/>
  <font style="padding-left:5%;">Appearance <?php
  if($lo == "normal"){
    echo " <b style='color:#21618c;'>normal</b> <span>&#10003;</span> / abnormal";
  }elseif($lo == "abnormal") {
    echo " normal / <b style='color:#21618c;'>abnormal</b> <span>&#10003;</span>";
  }else {
    echo " normal / abnormal ";
  } ?>  <font style="padding:0px 10px; border-bottom:1px dashed;"><?php echo $locomment; ?></font></font><br/>
  </p><br>
  </p>

<table width="90%" style="border-collapse: collapse;" border="1" align="center">
  <tr>
    <td rowspan="2"align="center" style="border: solid 1px #21618c; color:#21618c;">Date</td>
    <td rowspan="2"align="center" style="border: solid 1px #21618c; color:#21618c;">Day</td>
    <td colspan="2"align="center" style="border: solid 1px #21618c; color:#21618c;">Dominant Elements</td>
    <td rowspan="2"align="center" style="border: solid 1px #21618c; color:#21618c;">Haemoglobin</td>
  </tr>
  <tr>
    <td align="center" style="border: solid 1px #21618c; color:#21618c;">Sodium</td>
    <td align="center" style="border: solid 1px #21618c; color:#21618c;">Blood Pressure</td>
  </tr>
  <tr>
    <td align="center" style="border: solid 1px #21618c;"><?php if($dte1 !=''){echo date('d/m/Y',strtotime($dte1));} ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $day1; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $ro1; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $lo1; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $emt1; ?></td>
  </tr>
  <tr>
    <td align="center" style="border: solid 1px #21618c;"><?php if($dte2 !=''){echo date('d/m/Y',strtotime($dte2));} ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $day2; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $ro2; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $lo2; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $emt2; ?></td>
  </tr>
  <tr>
    <td align="center" style="border: solid 1px #21618c;"><?php if($dte3 !=''){echo date('d/m/Y',strtotime($dte3));} ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $day3; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $ro3; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $lo3; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $emt3; ?></td>
  </tr>
  <tr>
    <td align="center" style="border: solid 1px #21618c;"><?php if($dte4 !=''){echo date('d/m/Y',strtotime($dte4));} ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $day4; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $ro4; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $lo4; ?></td>
    <td align="center" style="border: solid 1px #21618c;"><?php echo $emt4; ?></td>
  </tr>
</table>
</p>


<p align="left" class="underline" style="padding-left:5%;"><u style="color:#21618c;"><b style="font-size:20px;color:#21618c;">Impression</b></u><br/><br/><?php echo $impression; ?></p>


<br>
<br>
<table width="100%">
<tr>
  <td width="50%"></td>
  <td><center><?php echo $name.".,".$desig ?></center></td>
</tr>
</div>
<?php require 'footer.php'; ?>
