<!--header start-->
<header class="header fixed-top clearfix">
<div class="brand">

    <a href="dashboard.php" class="logo">
	<img alt="" src="images/tamalepoly.png" style="width: auto; height: 40px;" class="img-circle profile-img">
        School
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center"><?php echo htmlentities("Total Voters : ".TotalVoters()); ?></a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center"><?php echo htmlentities("Total Voters voted : ".VVOTED()); ?></a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center"><?php echo htmlentities("Total Undervotes : ".UnderVotes()); ?></a></li>
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->