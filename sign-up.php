<body ng-controller="SignUpController">
  <div class="container">
    <h2>Sign Up</h2>
    <p>Please complete the information below to create an account:</p>
      <form role="form" ng-submit="submit()">
      <div class="form-group row">
        <label for="inputEmail" class="col-sm-3 col-form-label">Email <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="email" ng-model="user.email" ng-required="true" class="form-control" id="inputEmail" name="email" placeholder="Email">
          {{errEmail}}
        </div>
      </div>
      <div class="form-group row">
        <label for="inputUser" class="col-sm-3 col-form-label">User Name <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" ng-model="user.name" ng-required="true" class="form-control" id="inputUser" name="user" placeholder="Username">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label">Password <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="password" ng-model="user.password" ng-required="true" class="form-control" id="inputPassword" name="password" placeholder="Password">
          {{errPass}}
        </div>
      </div>
      <div class="form-group row">
      <label for="inputPhone" class="col-sm-3 col-form-label">Phone Number <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" ng-model="user.phone" ng-required="true" id="inputPhone" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" placeholder="416-000-0000">
        </div>
      </div>
      <div class="form-group row">
      <label for="inputAddress" class="col-sm-3 col-form-label">Address <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" ng-model="user.address" ng-required="true" id="inputAddress" class="form-control" name="address" placeholder="Street Address">
        </div>
      </div>
      <div class="form-group row">
      <label for="inputCityCode" class="col-sm-3 col-form-label">City Code <font color='red'>*</font></label>
        <div class="col-sm-6">
          <input type="text" ng-model="user.city" ng-required="true" id="inputCityCode" class="form-control" name="city-code" placeholder="TO">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-3 col-sm-6">
          <input type="submit" value="Sign Up" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>
    <p>Already have an account? <a href="#!sign-in">Sign-in</a>.</p>
  </div>
</body>
