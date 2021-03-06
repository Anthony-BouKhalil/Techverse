<body ng-controller="HomeController">
<div class="center">
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
        Filter by Type
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
        <li><a class="dropdown-item" href="" ng-click="type=''">All</a></li>
        <li><a class="dropdown-item" href="" ng-click="type='phones'">Phones</a></li>
        <li><a class="dropdown-item" href="" ng-click="type='laptops'">Laptops</a></li>
        <li><a class="dropdown-item" href="" ng-click="type='tablets'">Tablets</a></li>
        <li><a class="dropdown-item" href="" ng-click="type='accessories'">Accessories</a></li>
    </ul>
    </div>
</div>
    
<div class="album py-3 bg-light">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <div ng-repeat="product in products | filter:{type:type}">
        <div class='col'>
            <div class='card shadow-sm'>
                <img width='100%' height='100%' alt='{{product.name}}' src='{{product.image}}'/>
                <div class='card-body'>
                <div class='card-title'>
                    <b>{{ product.name }}</b>
                </div>
                <p class='card-text'> {{ product.description }} </p>
                <div class='d-flex justify-content-between align-items-center'>
                <div class='btn-group'>
                    <button class='btn btn-sm btn-outline-secondary' ng-click='addToCart(product.product_id)'>Add to Cart</button>
                </div>
                    <small class='text-muted'> ${{ product.unit_price }} CAD</small>
                </div>
        </div>
    </div>
    </div>
</div>
</body>

