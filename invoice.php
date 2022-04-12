<body ng-controller="InvoiceController">
    <div ng-init="loadScript()" class="map-container">
        <div class="map-sub-container">
            <div id="map"></div>
            <div class='map-center'>
                <h2>Invoice</h2><br><br>
                Name: {{checkout.name}}<br>
                Email: {{checkout.email}}<br><br>
                Delivery Date: {{checkout.date}}<br>
                Delivery Time: {{checkout.time}}<br><br>
                
                <h5>Products</h5>
                <div ng-repeat="product in cart">
                  {{product.name}}<br>
                  Type: {{product.type}}<br>
                  Price: ${{product.unit_price}} CAD<br><br>
                </div>
                <b>Total:</b> ${{total_price}} CAD
                <br><br>

                <form ng-submit="confirm_purchase()">
                    <input value="Confirm Purchase" type='submit' name='submit' class='btn btn-success'/>
                </form>
            </div>
        </div>
    </div>
</body>
