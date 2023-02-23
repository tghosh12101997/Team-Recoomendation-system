<?php 
 include('../controller/db.php');
 include('../function/function.php');
$sql ='select * from oyester_inquiry where id='.$_REQUEST['id'];
$statement = $conn->prepare($sql);
$statement->execute(); 
$inquiry_data = $statement->fetchAll();

$sql ='select * from oyester_customer where id='.$inquiry_data[0]["customer_id"];
$statement = $conn->prepare($sql);
$statement->execute(); 
$customer_data = $statement->fetchAll();

$sql ='select * from oyester_products where id='.$inquiry_data[0]["product_id"];
$statement = $conn->prepare($sql);
$statement->execute(); 
$product_data = $statement->fetchAll();

if($inquiry_data[0]['length_id'] == 'inch'){
$total = (($inquiry_data[0]["length_val"]*$inquiry_data[0]["width_val"])/144);
}
if($inquiry_data[0]['length_id'] == 'feet'){
$total = ($inquiry_data[0]["length_val"]*$inquiry_data[0]["width_val"]);
}
if($inquiry_data[0]['length_id'] == 'cm'){
$total = ($inquiry_data[0]["length_val"]*$inquiry_data[0]["width_val"])*(0.0328084);
}
if($inquiry_data[0]['length_id'] == 'meter'){
$total = ($inquiry_data[0]["length_val"]*$inquiry_data[0]["width_val"])*(3.28084);
}
if($inquiry_data[0]['length_id'] == 'cm'){
$total = ($inquiry_data[0]["length_val"]*$inquiry_data[0]["width_val"])*(0.0328084);
} 
if($inquiry_data[0]['length_id'] == 'mm'){
$total = ($inquiry_data[0]["length_val"]*$inquiry_data[0]["width_val"])*(0.00328084);
}
$sq_feet = round($total);

$sql ='select * from oyester_price_list where category='.$inquiry_data[0]["application_id"].' and  sub_category='.$inquiry_data[0]["product_category_id"].' and  product_id='.$inquiry_data[0]["product_id"];
$statement = $conn->prepare($sql);
$statement->execute(); 
$price_data = $statement->fetchAll();

$sql ='select * from oyester_products where category='.$inquiry_data[0]["application_id"].' and  subcategory_id='.$inquiry_data[0]["product_category_id"].' and  id='.$inquiry_data[0]["product_id"];
$statement = $conn->prepare($sql);
$statement->execute(); 
$product_price_data = $statement->fetchAll(); 
if(!empty($price_data[0]["amount"]) && ($price_data[0]["discount_type"] == 'Amount')){
  if($price_data[0]["discount_type"] == 'Amount'){
     $dis_amt =  $price_data[0]["amount"];
     $price_data[0]["amount"] = $product_price_data[0]['selling_price'] - $dis_amt;
  }
}
else if(!empty($price_data[0]["percentage"]) && ($price_data[0]["discount_type"] == 'Percentage')){
  if($price_data[0]["discount_type"] == 'Percentage'){
     $dis_amt =  $price_data[0]["percentage"];
     $price_data[0]["amount"] = $product_price_data[0]['selling_price'] - ($product_price_data[0]['selling_price']*($dis_amt/100));
  }
}
else{
$price_data[0]["amount"] = $product_price_data[0]['selling_price'];
}

$igst =  $product_price_data[0]['gst'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Inquiry Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
<style type="text/css">
.btn{
display: inline-block;
font-weight: 400;
color: white;
text-align: center;
vertical-align: middle;
cursor: pointer;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
background-color: #ababd585;;
border: 1px solid transparent;
padding: .375rem .75rem;
font-size: 1rem;
line-height: 1.5;
border-radius: .25rem;
transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
</style>

</head>

<body id="print">

	<div id="page-wrap">

		<!--<textarea id="header" style="height: 30px;width: 100%;margin: 20px 0;
    background: #222;text-align: center;color: white;font: bold 15px Helvetica, Sans-Serif;
    text-decoration: uppercase;letter-spacing: 20px;padding: 8px 0px;">INVOICE</textarea>-->
		
	<div id="identity">
       <div style="width:100%;display:flex;border:1px solid;">
       <div style="width:33%">
       <img id="image" src="../dist/img/Oyster Decor Styling Logo.jpeg" alt="logo" width="100%" />
       </div>
       <div style="width:33%;border-left:2px solid;border-right:2px solid;text-align: -webkit-center;">
        <b style="font-weight: 300;font-size:13px;">Custom Decor: WallCoverings, WallPosters, Window Roller Blinds, Window Zebra Blinds, Window Curtains, Glass Films,  <br> WallFrames, DecorPanels, Furniture Skins, MetallicPanels,Stretch Ceiling, ArtFrames, LaminateSheets, ACPSheets,<br>BackaliteSheets, MetalArt, MDFSheets.</b>
       </div>
       <div style="width:33%">
       <h1 style="font-weight:lighter;border-bottom:2px solid; text-align:center;padding:2px;">Estimate</h1><br>

       <h3 style="font-weight:lighter;font-size:30px;text-align:center;">Proforma Invoice</h3>
       </div>
       </div>
      </div>
  
      <div style="clear:both"></div>
      <table style="width:100%; display: flex;">
        <tr>
          <td>Company Name:</td>
          <td><?php echo $inquiry_data[0]["company_id"];?></td>
          <td>Estimate Number</td>
          <td><?php echo $inquiry_data[0]["ticket_no"]."".$inquiry_data[0]["ticket_id"];?></td>
          <td>Date:</td> 
          <td><?php echo date('d.m.y',strtotime($inquiry_data[0]["created_on"]));?></td>
          </tr>
        <tr>
          <td>Kind Attn:</td> 
          <td><?php echo $inquiry_data[0]["customer_name"];?></td>
          <td>Prepared By</td>
          <td colspan="3"><?php  echo $inquiry_data[0]["prepared_by"]?$inquiry_data[0]["prepared_by"]:'Amarjeet Kaur'; ?></td>
        </tr>
        <tr>
          <td rowspan="3">Company Registered Address:</td>
          <td rowspan="3"><?php echo $customer_data[0]["bill_address_street1"];?></td>
          <td>Checked By</td> 
          <td colspan="3"><?php  echo $inquiry_data[0]["checked_by"]?$inquiry_data[0]["checked_by"]:'Dipak Chandra';?></td>
        </tr>
        <tr>
          <td>Approved By</td>
          <td colspan="3">Kuljit R Suri</td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td>Email ID:</td>
          <td><?php echo $customer_data[0]["customer_email"];?></td>
          <td rowspan="3">Site /Delivery Address:</td>
          <td colspan="3" rowspan="3"><?php echo $inquiry_data[0]["site_address"]?$inquiry_data[0]["site_address"]:$customer_data[0]["bill_address_street1"];?></td>
        </tr>
        <tr>
          <td>Mobile No:</td>
          <td><?php echo $customer_data[0]["telephone"];?></td>
        </tr>
        <tr>
          <td>Client GSTIN No :</td>
          <td><?php echo $customer_data[0]["gst_no"];?></td>

        </tr>
      </table>

      <table style="width:100%;">

      	<tr>
      		<th rowspan="2" colspan="1">Sr. No</th>
      		<th rowspan="2" colspan="3">Description</th>
      		<th rowspan="2" colspan="2">HSN/SAC</th>
      		<th>Size(H)</th>
      		<th>Size(W)</th>
          <th rowspan="2" colspan="1">Quantity</th>
      	  <th rowspan="2" colspan="1">Total Sq.feet</th>
          <th rowspan="2" colspan="2">Rate</th>
          <th rowspan="2" colspan="4">Amount</th>
      	</tr>
        <tr>
        <th colspan="2">Sizes in <?php echo ucfirst($inquiry_data[0]["length_id"]);?></th>
        </tr>
        <tr>
          <td colspan="1">1</td>
          <td colspan="3"><?php  echo $inquiry_data[0]["description"]?$inquiry_data[0]["description"]:getNamebyid($inquiry_data[0]["application_id"],'oyester_category').' '.getNamebyid($inquiry_data[0]["product_category_id"],'oyester_subcategory').' '.getNamebyid($inquiry_data[0]["product_id"],'oyester_products');?></td>
          <td colspan="2"><?php echo $product_data[0]["hsn"];?></td>
          <td><?php 
          $size_h = $inquiry_data[0]["size_h"]?$inquiry_data[0]["size_h"]:$inquiry_data[0]["length_val"];
          echo $inquiry_data[0]["size_h"]?$inquiry_data[0]["size_h"]:$inquiry_data[0]["length_val"];?></td>
          <td><?php 
          $size_w = $inquiry_data[0]["size_w"]?$inquiry_data[0]["size_w"]:$inquiry_data[0]["width_val"];
          echo $inquiry_data[0]["size_w"]?$inquiry_data[0]["size_w"]:$inquiry_data[0]["width_val"];?></td>
          <td colspan="1"><?php echo $inquiry_data[0]["quantity"];?></td>
          <td colspan="1"><?php echo number_format((float)((($size_h*$size_w)/144)*($inquiry_data[0]["quantity"])), 2, '.', '');
          $sq_feet =  number_format((float)((($size_h*$size_w)/144)*($inquiry_data[0]["quantity"])), 2, '.', '');
          ?></td>
          <td colspan="2"><?php 
          if(!empty($inquiry_data[0]['rate'])){
          	$price_data[0]["amount"] = $inquiry_data[0]['rate'];
          }
          echo $price_data[0]["amount"];?></td>
          <td colspan="5"><?php echo round($sq_feet*$price_data[0]["amount"]);
          $amount = round($sq_feet*$price_data[0]["amount"]);
          ?></td>
        </tr>
        <tr>
          <td colspan="8">Important Instructions:</td>
          <th colspan="3">SUB TOTAL</th>
          <td colspan="4"><?php echo $amount;?></td>
        </tr>
        <tr>
          <td colspan="8">Product warranty : 12months</td>
          <td colspan="3">Design Charges + <?php echo  $inquiry_data[0]['design_charges']?$inquiry_data[0]['design_charges']:'18'; ?>% GST :</td>
          <td colspan="4"><?php echo ($inquiry_data[0]['design_charges_amt']+($inquiry_data[0]['design_charges_amt']*(($inquiry_data[0]['design_charges']?$inquiry_data[0]['design_charges']:'18')/100)));
          $total = $inquiry_data[0]['design_charges_amt']+($inquiry_data[0]['design_charges_amt']*(($inquiry_data[0]['design_charges']?$inquiry_data[0]['design_charges']:'18')/100));
          ?></td>
          </tr>
        <tr>
          <td colspan="8">Installation: Not Applicable</td>
          <td colspan="3">Mapping Charges:</td>
          <td colspan="4">-</td>
        </tr>
        <tr>
          <td colspan="8">Lead time: 7 days</td>
          <td colspan="3">Courier Charges:</td>
          <td colspan="4">-</td> 
        </tr>
        <tr>
        <td colspan="8"></td> 
          <td colspan="3">Installation Charges:</td>
          <td colspan="4">-</td>
        </tr>
        <tr>
          <td colspan="8"></td>
          <th colspan="3">TOTAL</th>
          <td colspan="4"><?php echo $amount+$total; ?></td>
        </tr>
         <tr>
          <td colspan="8"></td>
          <td colspan="3">CGST <?php echo ((int)$igst/2); ?>%</td>
          <td colspan="4">-</td>
        </tr>
         <tr>
          <td colspan="8"></td>
          <td colspan="3">SGST <?php echo ((int)$igst/2); ?>%</td>
          <td colspan="4">-</td>
        </tr>
        <tr>
          <td colspan="8"></td>
          <td colspan="3">IGST <?php echo ((int)$igst); ?>%</td>
          <td colspan="4"><?php echo ($amount*((int)$igst/100)); 
          $total_igst = ($amount*((int)$igst/100));
          ?></td>
        </tr>
        <tr>
          <td rowspan="3" colspan="2">(amount in words)</td>
          <td rowspan="3" colspan="6">Rupees <?php 
            $total_amt  = round($amount+$total+$total_igst);
            if($inquiry_data[0]["advance_payment"] > 0){
              $total_amt = $total_amt - $inquiry_data[0]["advance_payment"];
            }

          echo  numberTowords($total_amt); ?> Only</td>
          <th colspan="3">GRAND TOTAL</th>
          <td colspan="4"><?php echo round($total_amt) ?></td>
        </tr>
          <tr>
          <th colspan="3">ADVANCE  PAYMENT RECEIVED</th>
          <td colspan="4"><?php  echo $inquiry_data[0]["advance_payment"]?$inquiry_data[0]["advance_payment"]:'-';?></td>
        </tr>
        <tr>
          <th colspan="3">FINAL RECEIVABLE AMOUNT</th>
          <td colspan="4"><?php  echo round($total_amt); ?></td>
        </tr>
        <tr>
          <td colspan="17" style="font-size: 12px;">Bank: IndusInd Bank Ltd.  Branch: Ground Floor, Shop No.1, Gemini CHS, Nehru Rd, Vile Parle (E), Mumbai 400057.  A/c No: 259820531318    IFSC Code: INDB0000268 </td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">Terms & Conditions :</td>
          <td colspan="7" rowspan="6" style="font-size: 10px;">Customer Acceptance </td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">1. Payment Terms : 70% advance with order confirmation and remaining balance after completion.</td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">2. Taxes: GST is mentioned in the above estimate, any other applicable taxes will be charged extra.</td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">3. Validity: 30 days from date mentioned in the estimate.</td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">4. Purchase Order : To be raised on Oyster Mural, Mumbai.</td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">5. Registration Details: Pan No: ALCPS7750A / GSTIN No: 27ALCPS7750A1Z5</td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">6. Jurisdiction: Subject to Mumbai Jurisdiction.</td>
          <td colspan="7" rowspan="5" style="font-size: 10px;">for Oyster Mural </td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">7. All supplies are subject to availability of stock.</td>
        </tr>
        <tr>
          <td colspan="10" style="font-size: 10px;">8. All cheques favoring : Oyster Mural</td>
        </tr>
        <tr>
          <td colspan="10" rowspan="2" style="font-size: 10px;">9. Correspondence Address: f43, nand dham estate, maroshi road, marol, andheri (e), Mumbai: 400059. Maharashtra, India</td>
        </tr>
        <tr>
        </tr>
        <tr>
          <th colspan="17" style="font-size: 10px;">Kuljit R Suri - CEO/Founder / mobile:+91 9820531318 / e: ceo@oystermural.com / www.oystermural.com / call us: 022 49692525</th>
        </tr>
      </table><br>
      <button class="btn" id="print" onclick="print()">Print</button>
  </div>

</body>

</html>
<script type="text/javascript">
	$(document).ready(function(){
    // window.print();
	});
</script>