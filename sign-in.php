<body ng-controller="SignInController">
    <div class="container">
      <h2>Sign-In</h2>
      <p>Please complete the information below to create an account:</p>
      <form role="form" ng-submit="submit()">
        <div class="form-group row">
          <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-6">
            <input type="email" ng-model="user.email" ng-required="true" class="form-control" id="inputEmail" name="email" placeholder="Email">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
          <div class="col-sm-6">
            <input type="password" ng-model="user.password" ng-required="true" class="form-control" id="inputPassword" name="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group row">
          <div class="offset-sm-3 col-sm-6">
            <input type="submit" value="Log In" name="submit" class="btn btn-primary"/>
            {{errCredentials}}
          </div>
        </div>
      </form>
      <p>Don't have an account? <a href="#!sign-up">Sign-up</a>.</p>
    </div>
</body>
</html>
