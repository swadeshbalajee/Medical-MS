<?php
include('connect.php');
if(isset($_POST['login'])){
    $id=$_POST['id'];
    $pass=$_POST['pass'];

    $_SESSION['id']=$id;

    $sql = "select * from login where doc_id = $id and password='$pass'";
    $query = oci_parse($conn,$sql);
    if(oci_execute($query)){
      $numrows = oci_fetch_all($query, $res);

      if($numrows >0){
          header('location:doc.php');
      }
      else{
        sleep(2);
      }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">


<link rel="stylesheet" media="screen" href="css/file1.css" />
<link href='css/file2.css' rel='stylesheet'>


<style>
    html { font-size: 15px; }
    html, body { margin: 0; padding: 0; min-height: 100%; }
    body { height:100%; display: flex; flex-direction: column; }
    .referer-warning {
      background: black;
      box-shadow: 0 2px 5px rgba(0,0,0, 0.5);
      padding: 0.75em;
      color: white;
      text-align: center;
      font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif;
      line-height: 1.2;
      font-size: 1rem;
      position: relative;
      z-index: 2;
    }
    .referer-warning h1 { font-size: 1.2rem; margin: 0; }
    .referer-warning a { color: #56bcf9; } /* $linkColorOnBlack */
  </style>
</head>
<body class="">

<div id="result-iframe-wrap" role="main">
<iframe id="result" srcdoc="
<!DOCTYPE html>
<html lang=&quot;en&quot; >

<head>

  <meta charset=&quot;UTF-8&quot;>

<style>
@import url(https://fonts.googleapis.com/css?family=Dancing+Script|Roboto);
*, *:after, *:before {
  box-sizing: border-box;
}

body {
  background: #cc3367;
  text-align: center;
  font-family: 'Roboto', sans-serif;
}

.panda {
  position: relative;
  width: 200px;
  margin: 50px auto;
}

.face {
  width: 200px;
  height: 200px;
  background: #fff;
  border-radius: 100%;
  margin: 50px auto;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
  z-index: 50;
  position: relative;
}

.ear, .ear:after {
  position: absolute;
  width: 80px;
  height: 80px;
  background: #000;
  z-index: 5;
  border: 10px solid #fff;
  left: -15px;
  top: -15px;
  border-radius: 100%;
}
.ear:after {
  content: '';
  left: 125px;
}

.eye-shade {
  background: #000;
  width: 50px;
  height: 80px;
  margin: 10px;
  position: absolute;
  top: 35px;
  left: 25px;
  -webkit-transform: rotate(220deg);
  transform: rotate(220deg);
  border-radius: 25px/20px 30px 35px 40px;
}
.eye-shade.rgt {
  -webkit-transform: rotate(140deg);
  transform: rotate(140deg);
  left: 105px;
}

.eye-white {
  position: absolute;
  width: 30px;
  height: 30px;
  border-radius: 100%;
  background: #fff;
  z-index: 500;
  left: 40px;
  top: 80px;
  overflow: hidden;
}
.eye-white.rgt {
  right: 40px;
  left: auto;
}

.eye-ball {
  position: absolute;
  width: 0px;
  height: 0px;
  left: 20px;
  top: 20px;
  max-width: 10px;
  max-height: 10px;
  -webkit-transition: 0.1s;
  transition: 0.1s;
}
.eye-ball:after {
  content: '';
  background: #000;
  position: absolute;
  border-radius: 100%;
  right: 0;
  bottom: 0px;
  width: 20px;
  height: 20px;
}

.nose {
  position: absolute;
  height: 20px;
  width: 35px;
  bottom: 40px;
  left: 0;
  right: 0;
  margin: auto;
  border-radius: 50px 20px/30px 15px;
  -webkit-transform: rotate(15deg);
  transform: rotate(15deg);
  background: #000;
}

.body {
  background: #fff;
  position: absolute;
  top: 200px;
  left: -20px;
  border-radius: 100px 100px 100px 100px/126px 126px 96px 96px;
  width: 250px;
  height: 282px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
}

.hand, .hand:after, .hand:before {
  width: 40px;
  height: 30px;
  border-radius: 50px;
  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.15);
  background: #000;
  margin: 5px;
  position: absolute;
  top: 70px;
  left: -25px;
}
.hand:after, .hand:before {
  content: '';
  left: -5px;
  top: 11px;
}
.hand:before {
  top: 26px;
}
.hand.rgt, .rgt.hand:after, .rgt.hand:before {
  left: auto;
  right: -25px;
}
.hand.rgt:after, .hand.rgt:before {
  left: auto;
  right: -5px;
}

.foot {
  top: 360px;
  left: -80px;
  position: absolute;
  background: #000;
  z-index: 1400;
  box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
  border-radius: 40px 40px 39px 40px/26px 26px 63px 63px;
  width: 82px;
  height: 120px;
}
.foot:after {
  content: '';
  width: 55px;
  height: 65px;
  background: #222;
  border-radius: 100%;
  position: absolute;
  bottom: 10px;
  left: 0;
  right: 0;
  margin: auto;
}
.foot .finger, .foot .finger:after, .foot .finger:before {
  position: absolute;
  width: 25px;
  height: 35px;
  background: #222;
  border-radius: 100%;
  top: 10px;
  right: 5px;
}
.foot .finger:after, .foot .finger:before {
  content: '';
  right: 30px;
  width: 20px;
  top: 0;
}
.foot .finger:before {
  right: 55px;
  top: 5px;
}
.foot.rgt {
  left: auto;
  right: -80px;
}
.foot.rgt .finger, .foot.rgt .finger:after, .foot.rgt .finger:before {
  left: 5px;
  right: auto;
}
.foot.rgt .finger:after {
  left: 30px;
  right: auto;
}
.foot.rgt .finger:before {
  left: 55px;
  right: auto;
}

form {
  display: none;
  max-width: 400px;
  padding: 20px 40px;
  background: #fff;
  height: 300px;
  margin: auto;
  display: block;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
  -webkit-transition: 0.3s;
  transition: 0.3s;
  position: relative;
  -webkit-transform: translateY(-100px);
  transform: translateY(-100px);
  z-index: 500;
  border: 1px solid #eee;
}
form.up {
  -webkit-transform: translateY(-180px);
  transform: translateY(-180px);
}

h1 {
  color: #FF4081;
  font-family: 'Dancing Script', cursive;
}

.btn {
  background: #fff;
  padding: 5px;
  width: 150px;
  height: 35px;
  border: 1px solid #FF4081;
  margin-top: 25px;
  cursor: pointer;
  -webkit-transition: 0.3s;
  transition: 0.3s;
  box-shadow: 0 50px #FF4081 inset;
  color: #fff;
}
.btn:hover {
  box-shadow: 0 0 #FF4081 inset;
  color: #FF4081;
}
.btn:focus {
  outline: none;
}

.form-group {
  position: relative;
  font-size: 15px;
  color: #666;
}
.form-group + .form-group {
  margin-top: 30px;
}
.form-group .form-label {
  position: absolute;
  z-index: 1;
  left: 0;
  top: 5px;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}
.form-group .form-control {
  width: 100%;
  position: relative;
  z-index: 3;
  height: 35px;
  background: none;
  border: none;
  padding: 5px 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
  border-bottom: 1px solid #777;
  color: #555;
}
.form-group .form-control:invalid {
  outline: none;
}
.form-group .form-control:focus, .form-group .form-control:valid {
  outline: none;
  box-shadow: 0 1px #FF4081;
  border-color: #FF4081;
}
.form-group .form-control:focus + .form-label, .form-group .form-control:valid + .form-label {
  font-size: 12px;
  color: #FF4081;
  -webkit-transform: translateY(-15px);
  transform: translateY(-15px);
}

.alert {
  position: absolute;
  color: #f00;
  font-size: 16px;
  right: -180px;
  top: -300px;
  z-index: 200;
  padding: 30px 25px;
  background: #fff;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
  border-radius: 50%;
  opacity: 0;
  -webkit-transform: scale(0, 0);
  transform: scale(0, 0);
  -moz-transition: linear 0.4s 0.6s;
  -o-transition: linear 0.4s 0.6s;
  -webkit-transition: linear 0.4s;
  -webkit-transition-delay: 0.6s;
  -webkit-transition: linear 0.4s 0.6s;
  transition: linear 0.4s 0.6s;
}
.alert:after, .alert:before {
  content: '';
  position: absolute;
  width: 25px;
  height: 25px;
  background: #fff;
  left: -19px;
  bottom: -8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  border-radius: 50%;
}
.alert:before {
  width: 15px;
  height: 15px;
  left: -35px;
  bottom: -25px;
}

.wrong-entry {
  -webkit-animation: wrong-log 0.3s;
  animation: wrong-log 0.3s;
}
.wrong-entry .alert {
  opacity: 1;
  -webkit-transform: scale(1, 1);
  transform: scale(1, 1);
}
@-webkit-keyframes eye-blink {
  to {
    height: 30px;
  }
}
@keyframes eye-blink {
  to {
    height: 30px;
  }
}
@-webkit-keyframes wrong-log {
  0%, 100% {
    left: 0px;
  }
  20% , 60% {
    left: 20px;
  }
  40% , 80% {
    left: -20px;
  }
}
@keyframes wrong-log {
  0%, 100% {
    left: 0px;
  }
  20% , 60% {
    left: 20px;
  }
  40% , 80% {
    left: -20px;
  }
}
</style>

  


</head>

<body translate=&quot;no&quot; >
  <div class=&quot;panda&quot;>
  <div class=&quot;ear&quot;></div>
  <div class=&quot;face&quot;>
    <div class=&quot;eye-shade&quot;></div>
    <div class=&quot;eye-white&quot;>
      <div class=&quot;eye-ball&quot;></div>
    </div>
    <div class=&quot;eye-shade rgt&quot;></div>
    <div class=&quot;eye-white rgt&quot;>
      <div class=&quot;eye-ball&quot;></div>
    </div>
    <div class=&quot;nose&quot;></div>
    <div class=&quot;mouth&quot;></div>
  </div>
  <div class=&quot;body&quot;> </div>
  <div class=&quot;foot&quot;>
    <div class=&quot;finger&quot;></div>
  </div>
  <div class=&quot;foot rgt&quot;>
    <div class=&quot;finger&quot;></div>
  </div>
</div>
<form method = &quot;post&quot; action=&quot;doctors.php&quot;>
  <div class=&quot;hand&quot;></div>
  <div class=&quot;hand rgt&quot;></div>
  <h1>Doctor Login</h1>
  <div class=&quot;form-group&quot;>
    <input required=&quot;required&quot; class=&quot;form-control&quot; name=&quot;id&quot;/>
    <label class=&quot;form-label&quot;>Doctor ID </label>
  </div>
  <div class=&quot;form-group&quot;>
    <input id=&quot;password&quot; type=&quot;password&quot; required=&quot;required&quot; class=&quot;form-control&quot; name=&quot;pass&quot;/>
    <label class=&quot;form-label&quot;>Password</label>
    <p class=&quot;alert&quot;>Invalid Credentials..!!</p>
   <button type=&quot;submit&quot; class=&quot;btn&quot; name=&quot;login&quot;>Login </button> 
  </div>
</form>
    <script src=&quot;https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js&quot;></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  
      <script id=&quot;rendered-js&quot; >
$('#password').focusin(function () {
  $('form').addClass('up');
});
$('#password').focusout(function () {
  $('form').removeClass('up');
});

// Panda Eye move
$(document).on(&quot;mousemove&quot;, function (event) {
  var dw = $(document).width() / 15;
  var dh = $(document).height() / 15;
  var x = event.pageX / dw;
  var y = event.pageY / dh;
  $('.eye-ball').css({
    width: x,
    height: y });

});

// validation


$('.btn').click(function () {
  $('form').addClass('wrong-entry');
  setTimeout(function () {
    $('form').removeClass('wrong-entry');
  }, 3000);
});
//# sourceURL=pen.js
    </script>

  
  

</body>

</html>
 
" sandbox="allow-forms allow-modals allow-pointer-lock allow-popups allow-presentation allow-same-origin allow-scripts" allow="accelerometer; ambient-light-sensor; camera; encrypted-media; geolocation; gyroscope; microphone; midi; payment; vr" allowTransparency="true" allowpaymentrequest="true" allowfullscreen="true" class="result-iframe">
      </iframe>
</div>
</body>
</html>
