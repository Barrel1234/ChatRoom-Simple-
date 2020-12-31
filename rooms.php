<?php
$roomname=$_GET['roomname'];

$con=mysqli_connect('localhost','root','','chatroom');
if($con==false)
{
 echo 'connection is not done';
}

$sql="SELECT * FROM rooms WHERE roomname='$roomname'";
$result=  mysqli_query($con, $sql);
if($result)
{
    if(mysqli_num_rows($result)==0)
    {
          $message="this room does not exist";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
    }
}
else
{
    echo "ERROR:".mysqli_error($con);
}
echo "lets chat now";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap core CSS -->
   <<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

 <!-- Custom styles for this template -->
 <link href="css/product.css" rel="stylesheet">

  
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass
{
    height: 300px;
    overflow-y: scroll;
}

</style>
</head>
<body>
<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <p class="h5 my-0 me-md-auto fw-normal">Chat_Elpmis.com</p>
  <nav class="my-2 my-md-0 me-md-3">
    <a class="p-2 text-dark" href="#">Home</a>
    <a class="p-2 text-dark" href="#">About</a>
    <a class="p-2 text-dark" href="#">Contact</a>
  </nav>
</header>

<h2>Chat Messages - <?php echo $roomname; ?></h2>

<div class="container">
    <div class="anyClass">
 
</div>
</div>






<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="add msg"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">SEND</button>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>    
<script type="text/javascript">
// Check for new messages every 1 second
setInterval(runFunction,1000);
function runFunction()
{
    $.post("htcont.php",{room:'<?php echo $conroomname ?>'},
    function(data,status)
    {
        document.get1elementsByClassName('anyClass')[0].innerHTML = data;
    }
    )
}

//Using enter key to submit. Credits: w3schools
var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
});


// If user submits the form
           $("#submitmsg").click(function(){
            var clientmsg=$("#usermsg").val();
  $.POST("postmsg.php", {text: clientmsg, room:'<?php echo $roomname; ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR'];?>'},
 function(data,status){
     document.getElementsByClassName('anyClass')[0].innerHTML=data;});
     $("#usermsg").val("");
 return false;
 });
</body>
</html>


