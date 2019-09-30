<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="dashboard.php" class="logo">
       <!--SDA LOGO-->
	<img alt="" src="images/sda.jpg" style="width: auto; height: 50px;" class="img-circle profile-img">
        SDA
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<?php
$xlm = icrypt($_SESSION['alogin'],'d');
	$sql ="SELECT * FROM user WHERE username=:xlm";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':xlm', $xlm, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	{
			foreach($results as $row)
			{
				$photo = $row->photo;
				$type = $row->type;
				$name = $row->name;
	}}
?>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="./user/<?php echo htmlentities($photo);?>">
                <span class="username"><?php echo htmlentities($name);?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->