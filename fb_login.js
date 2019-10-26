window.fbAsyncInit = function() {
FB.init({
    appId      : '351156515444249',
    cookie     : true,
    xfbml      : true,
    version    : 'v3.2'
});
    
FB.AppEvents.logPageView();   
    
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function changeStatus(response) {
    data = 'sAction=load_user&iId='+response.authResponse.userID+'&sStatus='+response.status
    $.ajax({
        url: "login_server.php",
        dataType:"json",
        data: data,
        success: function(oResult){
            if(oResult.sStatus == 'success') {
                console.log('login successful');
                location.reload();
            }
        }
    });
}

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        changeStatus(response);
    });
  }