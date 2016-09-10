<?php $this->assign('title', 'JobFinds | Welcome');?>

<?php echo $this->element('search'); ?>
<br>

<h3>Latest Job Listings</h3>
<ul id="listings">
  <?php foreach ($jobs as $job) : ?>
    <li>
      <div class="type">
        <span style="background:<?php echo $job->type->color; ?>"><?php echo $job->type->name; ?></span>
      </div>
      <div class="description">
        <h5><?php echo $job['title']; ?> (<?php echo $job['city']; ?>, <?php echo $job['state']; ?>)</h5>
        <span id="list_date">
  						<?php echo $this->Time->i18nformat(
                $job['created'],
                [\IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT]
              ); ?>
  			</span>
        <p>
          <?php echo $this->Text->truncate($job['description'],250, array('ellipsis' => '...','exact' => false)); ?>
					<?php echo $this->Html->link('Read More',array('controller' => 'jobs', 'action' => 'view', $job['id'])); ?>
        </p>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
