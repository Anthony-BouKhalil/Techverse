<body ng-controller="ReviewsController">
  <div class="container">
    <h2>Reviews</h2>
    <p>Please complete the information below to review a product:</p>
    <form role="form" ng-submit="submit()">
      <div class="form-group row">
      <label for="inputProduct" class="col-sm-3 col-form-label">Select a Product <font color='red'>*</font></label>
        <div class="col-sm-3">
          <select ng-model="review.product" ng-required="true" id="inputProduct" class="form-control" name="product">
            <option value="1">iPhone 11</option>
            <option value="2">AirPods Pro</option>
            <option value="3">Samsung Galaxy S22</option>
            <option value="4">Beats Studio3 Wireless Headphones</option>
            <option value="5">MacBook Air</option>
            <option value="6">iPad mini</option>
            <option value="7">Nikon Z6 II</option>
            <option value="8">Google Pixel 6</option>
            <option value="9">Dell XPS 15</option>
            <option value="10">Amazon Kindle Paperwhite</option>                    
            <option value="11">Microsoft Surface Pro 7</option>                    
            <option value="12">iPad Pro</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputRating" class="col-sm-3 col-form-label">Select a Rating <font color='red'>*</font></label>
        <div class="col-sm-3">
          <select ng-model="review.rating" ng-required="true" id="inputRating" class="form-control" name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
      <label for="inputReview" class="col-sm-3 col-form-label">Enter a Review <font color='red'>*</font></label>
        <div class="col-sm-12">
          <?php 
            echo '<textarea ng-model="review.text" ng-required="true" id="inputReview" class="form-control" name="review" rows="10"></textarea>';
          ?>
        </div>
      </div>
      <?php
        //if (isset($_SESSION['user'])) {
            echo "<div class='form-group row'>
                  <div class='offset-sm-3 col-sm-6'>
                    <input type='submit' value='Submit' name='submit' class='btn btn-primary'/>
                  </div>
                  </div>";
          //}
          //else {
          //      echo "<font color='red'>You must be signed in to checkout</font>";
          //}
      ?>
    </form>
</div>
  <table>
    <col style="width:20%">
    <col style="width:80%">
    <tr class="review-row" ng-repeat="product in products">
      <td class="review">
        <img width='100%' height='100%' alt='{{product[0].name}}' src='{{product[0].image}}'/>
      </td>
      <td class="review">
        <b>{{product[0].name}}</b>
        <br>
        <p>Total Reviews ({{product[0].TotalReviews}})</p>
        <p>Average Rating: {{product[0].AverageRating}} Stars</p>
        <p ng-repeat="review in product[1]"><b>{{review.stars}} Star Review:</b> <br> {{review.text}}</p>
      </td>
    </tr>
  </table>
</body>
