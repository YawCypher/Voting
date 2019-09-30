<?php
session_start();
error_reporting(0);
include('includes/config.php');
?> 
 <nav class="navbar top-navbar bg-white box-shadow">
            	<div class="container-fluid">
                    <div class="row">
                        <div class="navbar-header no-padding">
                			<a class="navbar-brand" href="dashboard.php">
                			    SRMS | Admin
                			</a>
                            <span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-outdent"></i></span>
                			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                				<span class="sr-only">Toggle navigation</span>
                				<i class="fa fa-ellipsis-v"></i>
                			</button>
                            <button type="button" class="navbar-toggle mobile-nav-toggle" >
                				<i class="fa fa-bars"></i>
                			</button>
                		</div>
                        <!-- /.navbar-header -->

<div >
                           
<div style="padding: 9px";>
   <div class="col-md-6">
    <div >                                  
     <div >
<form  action="result-vet.php" method="POST">
 <div class="form-group">
 <div class="col-sm-3">
 <select name="class" class="form-control clid" id="classid" required="required">
<option value="">Select Class</option>
<?php $sql = "SELECT * from tblclasses";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Form-<?php echo htmlentities($result->Section); ?></option>
<?php }} ?>
 </select>
  </div>
  
</div>

<div class="form-group">
       <div class="col-sm-3">
		 <select name="yearr" class="form-control" id="year" required="required" >
			<option value="">Select Year</option>
			<option value= "1">1</option>
			<option value= "2">2</option>
			<option value= "3">3</option>
		 </select>
		</div>	
</div>
												
<div class="form-group">
       <div class="col-sm-3">
		 <select name="term" class="form-control" id="term" required="required">
			<option value="">Select Term</option>
			<option value= "FIRST">FIRST</option>
			<option value= "SECOND">SECOND</option>
			<option value= "THIRD">THIRD</option>
		 </select>
		</div>	
</div>
	                                                  
<div class="form-group">
<div class="col-sm-2">
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Vet Results</button>
 </div>
</div>
</form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
</div>
						
                		<div class="collapse navbar-collapse" id="navbar-collapse-1">
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
