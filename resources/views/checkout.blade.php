<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Checkout :-</h2>
  <table>
    <tr>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total</th>
    </tr>
    <?php $subtotal = 0;?>
     @foreach($carts as $cart)
     <?php $product = DB::table('products')->where('id',$cart->product_id)->first();?>
    <tr>
    
      <td>{{$product->peoduct_name}}</td>
      <td>{{$cart->quantity}}</td>
      <td>{{$cart->price}}</td>
      <td>{{$cart->quantity*$cart->price}}</td>
    </tr>
    <?php $subtotal += $cart->quantity*$cart->price ?>
     @endforeach
     <hr>

  </table>
  <h3 style="text-align: right; margin-right: 150px;">Sub Total : Rs. {{$subtotal}}</h3>  

</body>
</html>
