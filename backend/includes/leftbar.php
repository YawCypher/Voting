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
<div class="left-sidebar bg-black-300 box-shadow ">
                        <div class="sidebar-content">
                            <div class="user-info closed">
                                <img src="./user/<?php echo htmlentities($photo);?>" alt="Knight Rider" style="width: auto; height: 80px;" class="img-circle profile-img">
                                <h6 class="title"><?php echo htmlentities($name);?></h6>
                                <small class="info"><?php echo htmlentities($type);?></small>
                            </div>
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class="nav-header">
                                        <span class="">Main Category</span>
                                    </li>
                                    <li>
                                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
                                     
                                    </li>

                                    <li class="nav-header">
                                        <span class="">Appearance</span>
                                    </li>
                                    <li class="has-children">
                                        <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Candidates</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="create-candidate.php"><i class="glyphicon glyphicon-user"></i> <span>Add Candidate</span></a></li>
                                            <li><a href="manage-candidate.php"><i class="fa fa fa-users"></i> <span>Manage Candidates</span></a></li>
                                           
                                        </ul>
                                    </li>
  <li class="has-children">
                                        <a href="#"><i class="glyphicon glyphicon-stats"></i> <span>Position</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="create-position.php"><i class="glyphicon glyphicon-briefcase "></i> <span>Create Position</span></a></li>
                                            <li><a href="create-position.php"><i class="glyphicon glyphicon-stats"></i> <span>Manage Positions</span></a></li>
                                        </ul>
                                    </li>
									
									<li class="has-children">
                                        <a href="#"><i class="fa fa-male"></i> <span>Voters</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="add-voter.php"><i class="fa fa-user"></i> <span>Add Voter</span></a></li>
                                            <li><a href="add-bulk-voters.php"><i class="fa fa-users"></i> <span>Add Bulk Voters</span></a></li>
                                            <li><a href="manage-voter.php"><i class="fa fa-users"></i> <span>Manage Voters</span></a></li>                                          
                                        </ul>
                                    </li>
									
   <li class="has-children">
                                        <a href="#"><i class="fa fa-unlock"></i> <span>Passwords</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="password.php"><i class="fa fa-key"></i> <span>Find Passwords</span></a></li>  
                                            <li><a href="generate.php"><i class="fa fa-lock"></i> <span>Generate Passwords</span></a></li>  
                                        </ul>
                                    </li>
<li class="has-children">
                                        <a href="#"><i class="fa fa-info-circle"></i> <span>Result</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="live.php"><i class="glyphicon glyphicon-stats"></i> <span>Live Voting</span></a></li>
											<li><a href="result.php?c=0"><i class="fa fa-bars"></i> <span>Results</span></a></li>
                                        </ul>
                                           
                                    </li>
									   <li class="has-children">
                                        <a href="#"><i class="fa fa-envelope-o"></i> <span>Message</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="sms.php"><i class="fa fa-envelope"></i> <span>Send Passwords</span></a></li>
                                        </ul>
										<li><a href="change-password.php"><i class="fa fa fa-server"></i> <span> Admin Change Password</span></a></li>
                                    </li>
                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>