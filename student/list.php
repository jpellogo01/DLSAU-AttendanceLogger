<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
	redirect(web_root . "index.php");
}

?>

<style>
	.btn-dark-gray {
		background-color: #333;
		/* Dark gray color */
		color: white;
		/* White text color */
		border: none;
		/* Remove default border */
	}

	.btn-dark-gray:hover {
		background-color: #444;
		/* Slightly lighter gray for hover effect */
	}

	.btn-group {
		margin-bottom: 15px;
		/* Adjust the bottom margin as needed */
	}
</style>


<section id="feature" class="transparent-bg">
	<div class="container">
		<div class="center wow fadeInDown">
			<h2 class="page-header">STUDENT MANAGEMENT SYSTEM - PELLOGO </h2>
			<!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
		</div>
		<div class="btn-group">
			<a href="index.php?view=add" class="btn btn-dark-gray">ADD STUDENT</a>
		</div>


		<div class="row">
			<div class="features">
				<form class=" wow fadeInDown" action="controller.php?action=delete" Method="POST">
					<table id="dash-table" class="table table-striped table-bordered table-hover " style="font-size:12px" cellspacing="0">

						<thead style="background-color: #393e46; color: white; font-weight: bold;">
							<tr>
								<th>#</th>
								<th>STUDENT ID</th>
								<th>Name</th>
								<th>Sex</th>
								<!-- <th>Age</th> -->
								<th>Address</th>
								<th>Cell No.</th>
								<th>Course</th>
								<!-- <th>Status</th> -->
								<th width="18%">Action</th>

							</tr>
						</thead>
						<tbody>
							<?php

							$mydb->setQuery("SELECT * FROM `tblstudent` s,`tblcourse` c WHERE s.`CourseID`=c.`CourseID`");

							$cur = $mydb->loadResultList();

							foreach ($cur as $result) {

								echo '<tr>';
								echo '<td style="font-weight: bold;">' . $result->ID . '</a></td>';
								echo '<td style="font-weight: bold;">' . $result->StudentID . '</a></td>';
								echo '<td style="font-weight: bold;">' . $result->Firstname . ',' . $result->Lastname . ' ' . $result->Middlename . '</td>';
								echo '<td style="font-weight: bold;">' . $result->Gender . '</td>';
								echo '<td style="font-weight: bold;">' . $result->Address . '</td>';
								echo '<td style="font-weight: bold;">' . $result->ContactNo . '</td>';
								echo '<td style="font-weight: bold;">' . $result->CourseCode . '-' . $result->Description . '</a></td>';

								echo '<td style="font-weight: bold;" align="center">';
								echo '<a title="View Information" href="index.php?view=view&id=' . $result->ID . '" class="btn btn-info btn-xs">View <span class="fa fa-info-circle fw-fa"></span></a>';
								echo '<a title="Update Students" href="index.php?view=edit&id=' . $result->ID . '" class="btn btn-info btn-xs">Edit <span class="fa fa-pencil fw-fa"></span></a>';

								// Delete button
								echo '<a title="Delete Student" href="delete_student.php?id=' . $result->ID . '" class="btn btn-danger btn-xs" onclick="return confirm(\'Are you sure you want to delete this student?\');">Delete <span class="fa fa-trash fw-fa"></span></a>';
								echo '</td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>

			</div>
			</form>
		</div><!--/.services-->
	</div><!--/.row-->
	</div><!--/.container-->
</section><!--/#feature-->