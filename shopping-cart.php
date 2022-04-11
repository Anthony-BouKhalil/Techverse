<body ng-controller="CartController">
    <table id="devices" style="width:100%">
  	    <col style="width:20%">
        <col style="width:20%">
        <col style="width:30%">
        <col style="width:10%">
        <col style="width:10%">
        <col style="width:10%">
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Type</th>
          <th>Actions</th>
        </tr>
        <tr ng-repeat="product in cart">
            <td>
                <img src='{{product.image}}' alt='{{product.name}}' width='100%'>
            </td>
            <td> {{product.name}} </td>
            <td> {{product.description}} </td>
            <td> ${{product.unit_price}} CAD </td>
            <td> {{product.type}} </td>
            <td>
                <button ng-click='delete(product.product_id)'>Delete</button>
            </td>
        </tr>
    </table><br>
    
    <font color='red' ng-if="!$parent.name">You must be signed in to checkout</font>
    <form ng-if='$parent.name && cart.length' action='check-out.php' method='POST'>
        <a href='check-out.php'><button type='button' class='btn btn-warning' name='checkout' style='float:right;'>Proceed to Checkout</button></a>
    </form>
    <font color='red' ng-if='$parent.name && !cart.length'>You must have items in your cart to checkout</font>
</body>
