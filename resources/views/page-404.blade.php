<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
  <style>
    *{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

*::before,
*::after {
    content: '';
  position: absolute;
}

body{
	background: #1B0034;
	background-image: linear-gradient( 135deg, #1B0034 10%, #33265C 100%);
	background-attachment: fixed;
	background-size: cover;

}

.error {
	width: 100%;
	height: auto;
	margin: 50px auto;
	text-align: center;
	margin-bottom: 0;
}

.dracula{
	width: 230px;
	height: 300px;
	display: inline-block;
	margin: auto;
	overflowX: hidden;
}

.error .p {
	height: 100%;
	color: #C0D7DD; 
	font-size: 280px;
	margin: 50px;
	display: inline-block;
	font-family: 'Anton', sans-serif;
	font-family: 'Combo', cursive;
}


.con {
  width: 500px;
  height: 500px;
  position: relative;
  margin: 9% auto 0;
animation: ani9 0.7s ease-in-out infinite  alternate ;}

@keyframes ani9 {
    0%{
    transform: translateY(10px);	
  }
  
  100%{
    transform: translateY(30px);	
  }

}


.con > * {
  position: absolute;
  top: 0; left: 0;
}

.hair{
  top: -20px;
  width: 210px;
  height: 200px;
  background: #C0D7DD;
  border-radius: 0 50% 0 50%;
  transform: rotate(45deg);
  background: #33265C;
}
.hair-r{
  left: 20px;
  width: 210px;
  height: 200px;
  background: #C0D7DD;
  border-radius: 0 50% 0 50%;
  transform: rotate(45deg);
  background: #33265C;

}
.head {
  width: 200px;
  height: 200px;
  background: #C0D7DD;
  border-radius: 0 50% 0 50%;
  transform: rotate(45deg);
}
.eye {
 width: 20px; height:20px;
  background: #111113;
  border-radius: 50%;
  top: 15%; left: 11.5%;
  transition: .3s linear;
}
.eye-r{left: 24%;}

.mouth {
  width: 60px; 
  height: 20px;
  background: #840021;
  top: 20%;
  left: 14%;
  border-radius: 50% / 0 0 100% 100%;
}
.mouth::after{

  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 13px solid #FFFFFF;
  left: 10px;
  
}
.mouth::before{
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 13px solid #FFFFFF;
  left: 40px;
}

.blod {
  width: 8px;
  height: 20px;
  background: #840021;
  top: 23%; left: 17%; 
  border-radius: 20px;
}
.blod::after{
   width: 2px;
  height: 10px;
  background: #FFF;
  top: 20%; left: 10%; 
  border-radius: 20px;
  
}
.blod2 {
  top: 23%; left: 20%;
  width: 13px;
  height: 13px;
  border-radius: 50% 50% 50% 0;
  transform: rotate(130deg);
  animation: blod 2s linear infinite;
  opacity: 0;
}
@keyframes blod {
  0%   {opacity: 1;}  
  100%   {background:red; opacity: 0; top:50%;}
  
  
}



/* page-ms */
.page-ms {transform: translateY(-50px);}

.error p.page-msg {
	text-align: center;
	color: #C0D7DD; 
	font-size: 30px;
	font-family: 'Combo', cursive;
	margin-bottom: 20px;
}
button.go-back {
		font-size: 30px;
    font-family: 'Combo', cursive;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: 0.3s linear;
    z-index: 9;
    border-radius: 10px;
    background: #C0D7DD;
    color: #33265C;
    box-shadow: 0 0 10px 0 #C0D7DD;
	margin-top: 20px;
}
button:hover {box-shadow: 0 0 20px 0 #C0D7DD;}


  </style>
  </head>
  <body class="dark ">
    <div class="container">
	
      <div  class="error">
        <p class="p">4</p>
        <span class="dracula">			
          <div class="con">
            <div class="hair"></div>
            <div class="hair-r"></div>
            <div class="head"></div>
            <div class="eye"></div>
            <div class="eye eye-r"></div>
            <div class="mouth"></div>
            <div class="blod"></div>
            <div class="blod blod2"></div>
          </div>
        </span>
        <p class="p">4</p>
        
        <div class="page-ms">
          <p class="page-msg"> Oops, The page could not be found. </p>
          <button class="go-back" onclick="window.history.back()">Go Back</button>
        </div>
    </div>
      </div>
    
    <iframe style="width:0;height:0;border:0; border:none;" scrolling="no" frameborder="no" allow="autoplay" src="https://instaud.io/_/2Vvu.mp3"></iframe>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    
  </body>
</html>
</body>
</html>