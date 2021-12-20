<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<style type="text/css">
.form-style-1 {
    margin:10px auto;
    max-width: 400px;
    padding: 20px 12px 10px 20px;
    font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-1 li {
    padding: 0;
    display: block;
    list-style: none;
    margin: 10px 0 0 0;
}
.form-style-1 label{
    margin:0 0 3px 0;
    padding:0px;
    display:block;
    font-weight: bold;
}
.form-style-1 input[type=text], 
.form-style-1 input[type=date],
.form-style-1 input[type=datetime],
.form-style-1 input[type=number],
.form-style-1 input[type=search],
.form-style-1 input[type=time],
.form-style-1 input[type=url],
.form-style-1 input[type=email],
textarea, 
select{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border:1px solid #BEBEBE;
    padding: 7px;
    margin:0px;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;
    outline: none;  
}
.form-style-1 input[type=text]:focus, 
.form-style-1 input[type=date]:focus,
.form-style-1 input[type=datetime]:focus,
.form-style-1 input[type=number]:focus,
.form-style-1 input[type=search]:focus,
.form-style-1 input[type=time]:focus,
.form-style-1 input[type=url]:focus,
.form-style-1 input[type=email]:focus,
.form-style-1 textarea:focus, 
.form-style-1 select:focus{
    -moz-box-shadow: 0 0 8px #88D5E9;
    -webkit-box-shadow: 0 0 8px #88D5E9;
    box-shadow: 0 0 8px #88D5E9;
    border: 1px solid #88D5E9;
}
.form-style-1 .field-divided{
    width: 49%;
}

.form-style-1 .field-long{
    width: 100%;
}
.form-style-1 .field-select{
    width: 100%;
}
.form-style-1 .field-textarea{
    height: 100px;
}
.form-style-1 input[type=submit], .form-style-1 input[type=button]{
    background: #4B99AD;
    padding: 8px 15px 8px 15px;
    border: none;
    color: #fff;
}
.form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
    background: #4691A4;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
}
.form-style-1 .required{
    color:red;
}
td{
    text-align: right;
}
</style> 
 </head>
 <body>
<div style="display: flex;">
<div class="form"  style="width: 40%"> 
<ul class="form-style-1">
    <li>
        <label>Product Name <span class="required">*</span></label>
        <input type="text" id="name" name="name" class="field-long" />
    </li>
    <li><label>Details<span class="required">*</span></label><input type="number" name="price" id="price" class="field-divided" placeholder="Unit Price" onchange="calculate()" onkeyup="calculate()" /><input type="number" id="qty" name="qty" class="field-divided" placeholder="Quantity" onkeyup="calculate()" onchange="calculate()"  /> </li> 
    <li>
        <label>Tax %</label>
        <select name="field4" class="field-select" id="tax" onchange="calculate()">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="5">5</option>
            <option value="10">10</option>
        </select>
    </li> 
    <li>
        <label>Total</label>
        <input type="email" id="total" class="field-long" readonly />
    </li>
    <li>
        <input type="submit" value="Add" onclick="add_product()" />
    </li>
</ul>
</div>


<div class="container" style="width: 50%;<?php if(!isset($_SESSION['cart'])){ echo 'display: none'; } ?>">
    <div class="row" id="printdiv">
        <div class="col-md-4 offset-md-4 log-container rounded shadow" style="max-width: 65%">  
            <table class="table"  style="max-width: 65%">
                <thead>
                    <tr> 
                        <th width="100px">Product</th>
                        <th>Price</th>
                        <th>Quantity</th> 
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php   
                        $net_total=$tot_tax=$gross_total=0;
                        if(isset($_SESSION['cart']))
                            $cart=$_SESSION['cart'];
                        else
                            $cart=array();
                        foreach ($cart as $key => $value) { ?>
                            <tr >
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['price']; ?></td>
                                <td><?php echo $value['qty']; ?></td> 
                                <td><?php echo $value['price']*$value['qty']; ?></td> 
                            </tr>
                    <?php
                        $net_total+=(int)$value['price']*(int)$value['qty'];
                        $tot_tax+=(int)$value['tax'];
                        $gross_total+=(int)$value['total'];
                      } ?>

                      <tr id="append"> 
                        <td></td>
                        <td></td>
                        <td>Net_total</td>
                        <td id="net"><?php echo $net_total; ?></td> 
                     </tr>
                     <tr> 
                        <td></td>
                        <td></td>
                        <td>Tax</td>
                        <td id="tax"><?php echo $tot_tax; ?></td> 
                     </tr>
                     <tr> 
                        <td></td>
                        <td></td>
                        <td>Gross</td>
                        <td id="gross"><?php echo $gross_total; ?></td> 
                     </tr>
                     <tr> 
                        <td></td>
                        <td></td>
                        <td>Discount</td>
                        <td id="disc_div">
                            <select id='type' onchange="disc_calculate()"><option value='amount' >Amount</option><option value='perc' >Percentage</option></select>
                            <input type='number' id='discount' style='width: 50px;' onkeyup="disc_calculate()" onchange="disc_calculate()" >
                        </td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td></td>
                        <td>Final_Amount</td>
                        <td id="final"><?php echo $gross_total; ?></td></tr> 
                    <?php   ?>
                    
                </tbody>
            </table>
             <a href="Main/generate_invoice" target="_black" class="btn btn-success" style="float: right;" >Generate Invoice</a>
        </div>
    </div> 
   
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function calculate(){
        var qty=$('#qty').val(); 
        var price=$('#price').val();
        var tax=$('#tax').val();  
        var total=  parseInt(qty*price)+parseInt((qty*price)*tax/100);
        $('#total').val(total.toFixed(2)); 

    } 
    function disc_calculate(){
        var discount=$('#discount').val(); 
        var type=$('#type').val();
        var gross=$('#gross').html(); 
        if(type=='amount'){
            var final=  parseFloat(gross)-parseFloat(discount); 
        }else{
            var final=  parseInt(gross)-parseInt((gross)*discount/100);
            discount=parseInt((gross)*discount/100);
        } 
        if($('#discount').val()==''){
            $('#final').html(gross);
        }else{
            $('#final').html(final.toFixed(2));  
            $.ajax({
                type: "post",
                url: "Main/add_cart_disc",
                data:{discount:discount}, 
            });
        } 
    }

    function add_product(){

        var name=$('#name').val(); 
        var qty=$('#qty').val(); 
        var price=$('#price').val();
        var tax=$('#tax').val(); 
        var total=$('#total').val(); 
        var tax=parseInt((qty*price)*tax/100); 
        $.ajax({
            type: "post",
            url: "Main/add_cart",
            data:{name:name,qty:qty,price:price,tax:tax,total:total},
            dataType: "json", 
            success: function(data){  
                $('#net').html(data.net_total); 
                $('#tax').html(data.tot_tax); 
                $('#gross').html(data.gross_total); 
                $('#final').html(data.gross_total);  
            }
        });

       var data1= "<tr><td>"+name+"</td><td>"+price+"</td><td>"+qty+"</td> <td>"+price*qty+"</td>  </tr>";
        $('.container').show(); 
        $('#append').before(data1); 
        
    }
 
</script>
</body>
</html>