<button type="button" onClick="logInWithFacebook()">
	Entrar com Facebook
</button>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId: '2079156488976765',
      cookie: false, // This is important, it's not enabled by default
      version: 'v2.2'
    });
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
      	token = response.authResponse.accessToken;

      	window.location =  '../usuarios/token.json?access_token=' + token;

        console.log('You are logged in &amp; cookie set!', token);
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };

</script>