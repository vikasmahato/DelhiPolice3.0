<?php
$string1 = "";
$string2 = "";
$patient = "";
if($value['relation'] == "own" || $value['relation'] == "self")
   {	$string1 = ""; 
	$string2 = "$value[a_cghs_no]";
	$patient = "$value[applicant_name]";
   }
else
   {	$string1 = "$value[relation] of";
	$string2 = "$value[r_cghs_no]";
	$patient = "$value[relative_name] $string1 $value[applicant_name]";
   }


$form22 = "<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Medical Claim</title>

    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <style>
        h5{
            text-align: center;
            text-decoration: underline;
            font-weight: bold;
            padding:0px;
            margin:0px;
        }
        .container{
            font-size: 1.3em;
        }
    </style>
  </head>
  <body>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
      <div class='container'>
        <h5>OFFICE OF THE DEPUTY COMMISSIONER OF POLICE SOUTH EAST DISTRICT,</h5>
        <h5> IST FLOOR, POLICE STATION SARITA VIHAR, NEW DELHI-110076.</h5>
        <div style='text-align:justify;margin-top:10px;'>No._________ / Genl. Br. (SED) dated New Delhi, ____________/2017</div>
         <div style='margin-top:5px;'>To</div>
        <div><div style='margin-left:100px;'>The Medical Superintendent,</div>
        <div style='margin-left:100px;margin-top:10px;'>$value[hospital_name]</div>
        <div style='margin-left:100px;margin-top:10px;'>$value[hospital_address]</div>
        </div>
        <div style='margin-top:20px;'>Subject:- &nbsp;&nbsp;&nbsp;Regarding to provide credit facility for the treatment of
        <div style='margin-left:100px;margin-top:10px;'>$string1 $value[rank] $value[applicant_name], No. $value[police_station_no] (PIS $value[pis])</div>
        
        <div>Sir,</div>
		<p style='text-indent:12%;text-align:justify;'>It is stated that $patient is admitted in your Hospital since $value[startdate] in emergency condition due to as mentioned in emergency certificate. He/She is a CGHS beneficiary and having a valid CGHS card ID No. $string2. The applicant has requested for providing credit facility because he is not in a position to bear the expenditure to be incurred on the treatment of the patient. Hence, he/she may be provided credit facility as per CGHS instructions vide MH&FW O.M. No. S.11045/36/2012-CGHS(HEC), dated 01.10.2014 vide para-4 and bill may be prepared according to the CGHS approved rate list and sent to this office immediately (in duplicate) for reimbursement. The Govt. Servant is entitled for $value[a_cghs_category] ward category.</p>
        <div style='text-align:center;margin-top:40px;margin-bottom:40px'>This has the approval of Addl. DCP/SE district</div>
      <div style='text-align:right;margin-bottom:65px'>Yours faithfully,</div>
      <div style='text-align:right'>ASSTT. COMMISSIONER OF POLICE (HQ),</div>
      <div style='text-align:right'>SOUTH EAST DISTRICT, NEW DELHI.</div>
      </div>
  </body>
</html>";

?>
