<?php if($type!='Admin') { ?>
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="dashboard.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="create-position.php">
                        <i class="fa fa-user"></i>
                        <span>Positions</span>
                    </a>
                </li>                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Candidates</span>
                    </a>
                    <ul class="sub">
						<li><a href="create-candidate.php">Add Candidate</a></li>
						<li><a href="manage-candidate.php">Manage Candidate</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-male"></i>
                        <span>Voters</span>
                    </a>
                    <ul class="sub">
                        <li><a href="add-voter.php">Add Voter</a></li>
                        <li><a href="add-bulk-voters.php">Add Bulk Voters</a></li>
                        <li><a href="manage-voter.php">Manage Voters</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-unlock"></i>
                        <span>Activate</span>
                    </a>
                    <ul class="sub">
                        <li><a href="password.php">Activate Matric Number</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-info-circle"></i>
                        <span>Result</span>
                    </a>
                    <ul class="sub">
                        <li><a href="live.php">Live Voting</a></li>
                        <li><a href="result.php?c=0">Results</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>System Users</span>
                    </a>
                    <ul class="sub">
                        <li><a href="add-user.php">Add User</a></li>
                        <li><a href="manage-user.php">Manage Users</a></li>
                    </ul>
                </li>
                <li>
                    <a href="change-password.php">
                        <i class="fa fa-cog"></i>
                        <span>User Change Password</span>
                    </a>
                </li>   
            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<?php }else{ ?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="dashboard.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-male"></i>
                        <span>Voters</span>
                    </a>
                    <ul class="sub">
                        <li><a href="add-voter.php">Add Voter</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-unlock"></i>
                        <span>Activate</span>
                    </a>
                    <ul class="sub">
                        <li><a href="password.php">Activate Matric Number</a></li>
                    </ul>
                </li>
                <li>
                    <a href="change-password.php">
                        <i class="fa fa-cog"></i>
                        <span>User Change Password</span>
                    </a>
                </li>   
            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<?php }?>