<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Logged In Header</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
</head>


<body>
   <nav>
      <ul class="topnav" id="myTopnav">
         <li class="businesslogo"><a href="../myDashboard.php">BusyBODIES</a></li>
        <li class="nonlogo"><a href="../myDashboard.php">DASHBOARD</a></li>
        <li class="nonlogo"><a href="../myAccount.php">ACCOUNT</a></li>
        <li class="nonlogo"><a href="../logout.php">LOG OUT</a></li>
        <li class="icon">
          <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
        </li>
      </ul>
    </nav>
</body>

</html>