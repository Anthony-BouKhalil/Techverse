    var x = document.getElementById("demo");

    function getLocation() {
      if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    /* utility to build querystring from Object */
    function buildparams(p){
        if( p && typeof( p )==='object' ){
            p=Object.keys( p ).map(function( k ){
                return typeof( p[ k ] )=='object' ? buildparams( p[ k ] ) : [ encodeURIComponent( k ), encodeURIComponent( p[ k ] ) ].join('=')
            }).join('&');
        }
        return p;
    };

    /* ultra basic ajax function that only sends a POST request to nominated URL */
    function ajax(url,params,callback){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if( this.readyState==4 && this.status==200 )callback( this.response );
        }
        xhr.open('POST',url,true );
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
        xhr.send( buildparams( params ) );
    }

    function showPosition( position ) {
        /*
            the callback to the Geolocation request 
            fires the ajax request to whatever backend
            PHP script will process the POST request

            In the PHP script uyou should have access
            to $_POST['lat'] and $_POST['lng']
        */
        //var url='http://localhost/test/SCSStoreWebApp/invoice.php';
        var url=location.href;
        var params={ lat:position.coords.latitude,lng:position.coords.longitude };
        var callback=function(r){
            console.info( r );
            x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
        }

        /* trigger the ajax request */
        ajax( url, params, callback );
    }