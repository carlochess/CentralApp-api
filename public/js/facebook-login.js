
function statusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);
    // The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
		// Logged into your app and Facebook.
	    FB.api('/me', function(user){
            llenarDatos(user.name);
          });
	} else if (response.status === 'not_authorized') {
		// The person is logged into Facebook, but not your app.
	    document.getElementById('status').innerHTML = 'Please log ' +
	    'into this app.';
		} else {
		      // The person is not logged into Facebook, so we're not sure if
		      // they are logged into this app or not.
		      FB.login(function(respons){
		      	onLogin(respons);
		      });
			}
		  
}

function onLogin(response){
	console.log('login');
	console.log(response);
	if (response.status == 'connected') {
		statusChangeCallback(response);
	}else{
		alert("Logueate en Facebook por favor!");
	}
}
		  
// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
	FB.getLoginStatus(function(response) {
	    statusChangeCallback(response);
	    });
}

window.fbAsyncInit = function() {
	FB.init({
	    appId      : '550677245076316',
	    cookie     : true,  // enable cookies to allow the server to access 
	                        // the session
	    xfbml      : true,  // parse social plugins on this page
	    version    : 'v2.1' // use version 2.1
	  });

};

function llenarDatos(user){
  
setTimeout("location.href='https://uvsolving.com/users/facebook/"+user+"'");
}
