<body ng-controller="CheckoutController">
  <div class="container">
    <h2>Checkout</h2>
    <p>Please complete the information below to purchase the item(s):</p>
    <form role="form" ng-submit="get_invoice()">
      <div class="form-group row">
        <label for="inputUser" class="col-sm-3 col-form-label">Name <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input ng-model="checkout.name" ng-required="true" type="text" class="form-control" id="inputUser" name="user" placeholder="Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail" class="col-sm-3 col-form-label">Email <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input ng-model="checkout.email" ng-required="true" type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">         
        </div>
      </div>
      <div class="form-group row">
      <label for="inputBranch" class="col-sm-3 col-form-label">Select a Branch <font color='red'>*</font></label>
        <div class="col-sm-6">
          <select ng-model="checkout.branch" ng-required="true" id="inputBranch" class="form-control" name="branch">;
                    <option value="43.832950,-79.243210">900 Passmore Ave, Scarborough, ON M1X 0A1, Canada</option>;
                    <option value="40.749643,-73.985337">6 W 35th St, New York, NY 10001, United States</option>;
                    <option value="43.618069,-79.790192">8050 Heritage Rd, Brampton, ON L6Y 0C9, Canada</option>;
                    <option value="42.374380,-83.425500">39000 Amrhein Rd, Livonia, MI 48150, United States</option>;
                    <option value="43.414280,-80.387589">125 Maple Grove Rd, Cambridge, ON N3H 4R7, Canada</option>;
                </select>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputDate" class="col-sm-3 col-form-label">Select a Date <font color='red'>*</font></label>
        <div class="col-sm-6">
            <?php
                $today = date('Y-m-d');
                $future = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
                echo '<input ng-model="checkout.date" ng-required="true" required="required" type="date" id="inputDate" name="date" value="'.$today.'" min="'.$today.'" max="'.$future.'" >';
            ?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputTime" class="col-sm-3 col-form-label">Select a Time <font color='red'>*</font></label>
        <div class="col-sm-6">
            <div class="form-check form-check-inline">
              <input ng-model="checkout.time" ng-required="!checkout.time" class="form-check-input" type="radio" name="time1" id="time1" value="1:00 pm">
              <label class="form-check-label" for="time1">1:00 pm</label>
            </div>
            <div class="form-check form-check-inline">
              <input ng-model="checkout.time" ng-required="!checkout.time" class="form-check-input" type="radio" name="time2" id="time2" value="3:00 pm">
              <label class="form-check-label" for="time2">3:00 pm</label>
            </div>
            <div class="form-check form-check-inline">
              <input ng-model="checkout.time" ng-required="!checkout.time" class="form-check-input" type="radio" name="time3" id="time3" value="5:00 pm">
              <label class="form-check-label" for="time3">5:00 pm</label>
            </div>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">Name on Credit Card <font color='red'>*</font></label>
        <div class="col-sm-6">
        <input ng-required="true" type="text" class="form-control" id="inputCreditUser" name="creditUser" placeholder="Name on Credit Card">
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">Credit Card Number <font color='red'>*</font></label>
        <div class="col-sm-6">
        <input ng-required="true" type="text" class="form-control" id="inputCC" name="CC" placeholder="Credit Card Number">
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">Expiration Date <font color='red'>*</font></label>
        <div class="col-sm-6">
            <?php
                echo '<input ng-required="true" required="required" type="date" id="inputExpirationDate" name="expirationDate" value="'.$today.'">';
            ?>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCreditName" class="col-sm-3 col-form-label">CVV <font color='red'>*</font></label>
        <div class="col-sm-2">
        <input ng-required="true" type="text" class="form-control" id="inputCVV" name="CVV" placeholder="CVV">
        </div>
      </div>
      
      <div class="form-group row">
        <div class="offset-sm-3 col-sm-6">
          <input type="submit" value="Continue to Checkout" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>
  </div>
</body>
