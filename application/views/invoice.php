<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div  > 
                    <p class="text-center mt-3" style="font-weight: bold">Invoice</p>

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
                        <?php if(isset($cart)){ 
                            $net_total=$tot_tax=$gross_total=0;
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
                            <td > <?php echo $discount; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><b>Final_Amount</b></td>
                            <td id="final"><b><?php echo $gross_total-$discount; ?></b></td></tr> 
                        <?php } ?>
                        
                    </tbody>
                </table> 
                    
                </div>
            </div> 
        </div>
    </body>
</html>
<style type="text/css">
    body {
        height: 100vh;
        width: 100%;
        padding: 0px;
        margin: 0px;
        background-color: #f5f4f4;
        font-family: sans-serif;
    }
    .k-img {
        width: 100px;
    }
    .log-container {
        margin-top: 10%;
        background-color: #fff;
    }
    label {
        font-size: 14px;
    }
    .btn {
        font-size: 14px;
    }
    input[class="form-control"] {
        padding: 0px;
    }
    .log-container {
        margin-top: 1%;
    }
</style> 
<script type="text/javascript">
    document.title = 'Invoice';
    window.print();
    window.onafterprint = function(event) {
        window.close();
    }; 
</script>

