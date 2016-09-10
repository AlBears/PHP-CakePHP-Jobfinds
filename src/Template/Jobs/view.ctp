<?php $this->assign('title', $job[0]['title']);?>

<h3><?php echo $job[0]['title']; ?></h3>
			<ul>
				<li><strong>Location:</strong> <?php echo $job[0]['city']; ?>, <?php echo $job[0]['state']; ?></li>
				<li><strong>Job Type:</strong> <?php echo $job[0]['type']['name']; ?></li>
				<li><strong>Description:</strong>  <?php echo $job[0]['description']; ?></li>
				<li><strong>Contact Email:</strong> <a href="<?php echo $job[0]['contact_email']; ?>?Subject=Job%20Applicant" target="_top">employer@somecompany.com</a></li>
			</ul>
			<p><a href="<?php echo $this->request->webroot; ?>jobs/browse">Back To Jobs</a></p>
