    <?php
		if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
			session_start(); 
		}
		
		$permission = $_SESSION['permission'];
		$employeeCode = $_SESSION['employeeCode'];
	
		$PROTOCOL = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
		$DOC_ROOT = $PROTOCOL.'://'.$_SERVER['SERVER_NAME'];
		
		$projectRoot = dirname($DOC_ROOT.$_SERVER['SCRIPT_NAME']).'/';
		while(substr($projectRoot, -9) != 'HRSystem/'){
			$projectRoot = dirname($projectRoot).'/';
		}
	?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= $projectRoot ?>index.php">Firezetta HR System</a>
    </div>
    <!-- /.navbar-header -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
				<li>
                    <a href="<?= $projectRoot ?>Profile"><i class="fa fa-table fa-fw"></i>Profile</a>
                </li>
				 <li>
                    <a href="<?= $projectRoot ?>HolidaySchedule"><i class="fa fa-table fa-fw"></i> Holiday Schedule</a>
                </li>
				<?php
					if(in_array('1', $permission)
						|| in_array('2', $permission)
						|| in_array('3', $permission)):
				?>
                <li>
					<a href="<?= $projectRoot ?>Employee"><i class="fa fa-table fa-fw"></i> Employee </a>
                </li>
				<?php
					endif;
				?>
				 <li>
                    <a href="#"><i class="fa fa-table fa-fw"></i> Personal Leave <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
						<?php
							if(in_array('4', $permission)):
						?>
						<li>
                            <a href="<?= $projectRoot ?>LeaveApplication">Leave Application</a>
                        </li>
						<?php
							endif;
						?>
						<li>
                            <a href="<?= $projectRoot ?>PLeaveEntitlement">Personal Leave Entitlement</a>
                        </li>
                    </ul>
                </li>
				<?php
					if(in_array('9', $permission)
						|| in_array('10', $permission)
						|| in_array('11', $permission)
						|| in_array('5', $permission)
						|| in_array('6', $permission)
						|| in_array('8', $permission)
						|| in_array('20', $permission)
						|| in_array('13', $permission)):
				?>
                <li>
                    <a href="#"><i class="fa fa-table fa-fw"></i> Leave Management <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
						<?php
							if(in_array('9', $permission)
								|| in_array('10', $permission)
								|| in_array('11', $permission)):
						?>
						<li>
                            <a href="<?= $projectRoot ?>LeaveType">Leave Type</a>
                        </li>
                        <?php
							endif;
							if(in_array('5', $permission)
								|| in_array('6', $permission)):
						?>
						<li>
                            <a href="<?= $projectRoot ?>LeaveApproval">Leave Approval</a>
                        </li>
						<?php
							endif;
							if(in_array('8', $permission)
								|| in_array('20', $permission)):
						?>
						<li>
                            <a href="<?= $projectRoot ?>LeaveEntitlement">Leave Entitlement</a>
                        </li>
						<?php
							endif;
							if(in_array('13', $permission)):
						?>
						<li>
                            <a href="<?= $projectRoot ?>CFLeave">CF Leave</a>
                        </li>
						<?php
							endif;
						?>
                    </ul>
                </li>
				<?php
					endif;
					if(in_array('17', $permission)
						|| in_array('18', $permission)
						|| in_array('19', $permission)
						|| in_array('21', $permission)
						|| in_array('22', $permission)
						|| in_array('23', $permission)):
				?>
				<li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Management <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
						<?php
							if(in_array('17', $permission)
								|| in_array('18', $permission)
								|| in_array('19', $permission)):
						?>
						<li>
                            <a href="<?= $projectRoot ?>Role">Role</a>
                        </li>
						<?php
							endif;
							if(in_array('21', $permission)
								|| in_array('22', $permission)
								|| in_array('23', $permission)):
						?>
                        <li>
                            <a href="<?= $projectRoot ?>Account">Account</a>
                        </li>
						<?php
							endif;
						?>
                    </ul>
                </li>
				<?php
					endif;
				?>
                <li>
                    <a href="<?= $projectRoot ?>Password"><i class="fa fa-wrench fa-fw"></i> Change Password</a>
                </li>
                 <li>
                    <a href="<?= $projectRoot ?>Login/logout.php"><i class="fa fa-wrench fa-fw"></i> Logout </a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
