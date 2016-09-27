<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
      <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('icon') ?>

  <?= $this->Html->css('kickstart.css') ?>
  <?= $this->Html->css('style.css') ?>
  <?= $this->Html->script('jquery') ?>
  <?= $this->Html->script('kickstart') ?>



  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
</head>
<body>
<div id="container" class="grid">
	<header>
		<div class="col_4 column">
			<h1><a href="<?php echo $this->request->webroot; ?>"><strong>Job</strong>Finds</a></h1>
		</div>
    <div class="col_6 column right welcome">
					<?php if($userData): ?>
						<h6>Welcome</strong>, <?php echo $userData['username']; ?></h6>
						<a href="<?php echo $this->request->webroot; ?>users/logout">Logout</a>
					<?php endif; ?>
				</div>
		<div class="col_2 column right">
			<form id="add_job_link" action="<?php echo $this->request->webroot; ?>jobs/add">
				<button class="large green"><i class="icon-plus"></i>Add Job</button>
			</form>
		</div>
	</header>

	<div class="col_12 column">
		<!-- Menu Horizontal -->
		<ul class="menu">
		<li <?php echo ($this->request->here == '/jobfinds/' || $this->request->here == '/jobfinds/jobs')? 'class="current"' : ''?>><a href="<?php echo $this->request->webroot; ?>"><i class="icon-home"></i> Home</a></li>
		<li <?php echo ($this->request->here == '/jobfinds/jobs/browse')? 'class="current"' : ''?>><a href="<?php echo $this->request->webroot; ?>jobs/browse"><i class="icon-desktop"></i> Browse Jobs</a></li>
		<li <?php echo ($this->request->here == '/jobfinds/users/register')? 'class="current"' : ''?>><a href="<?php echo $this->request->webroot; ?>users/register"><i class="icon-user"></i> Register</a></li>
		<li <?php echo ($this->request->here == '/jobfinds/users/login')? 'class="current"' : ''?>><a href="<?php echo $this->request->webroot; ?>users/login"><i class="icon-key"></i> Login</a></li>
		</ul>
	</div>



		<div class="col_12 column">
      <?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>

		<div class="clearfix"></div>
		<footer>
			<p>Copyright @copy; 2016, JobFinds, All Rights Reserved</p>
		</footer>
</div> <!-- End Grid -->
</body>
</html>
