	<nav class="navbar top-navbar bg-white box-shadow">
		<div class="container-fluid">
			<div class="row">
		 <!-- /.navbar-header -->
				<div class="collapse navbar-collapse" id="navbar-collapse-1">
					<ul class="nav navbar-nav" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<li class="hidden-sm hidden-xs"><a href="dashboard.php" class="color-danger text-center"> Back <span class="btn-label btn-label-right"><i class="fa fa-arrow-left"></i></span> </a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center">|</a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center"><?php echo htmlentities("Total Voters : ".TotalVoters()); ?></a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center">|</a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center"><?php echo htmlentities("Total Voters voted : ".VVOTED()); ?></a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center">|</a></li>
						<li class="hidden-sm hidden-xs"><a href="#" class="color-info text-center"><?php echo htmlentities("Total Undervotes : ".UnderVotes()); ?></a></li>
					</ul>
					<!-- /.nav navbar-nav -->
					<ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<li><a href="logout.php" class="color-danger text-center"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
					<!-- /.nav navbar-nav navbar-right -->
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.row -->
		</div>
      <!-- /.container-fluid -->
	</nav>
