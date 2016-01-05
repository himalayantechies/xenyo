
<div class="row worklogs">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i><?php echo __('Worklog'); ?>				</div>
				<div class="tools">
					<a class="collapse" href="javascript:;"> </a>
					<a class="reload" href="javascript:;"> </a>
				</div>
                <div class="actions">
                    <?php echo $this->Html->link(__('Edit Worklog'), array('action' => 'edit', $worklog['Worklog']['id']), array('class' => 'btn purple')); ?>                </div>                    
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-striped table-bordered">
					<tbody>
                    	<tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['id']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Self'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['self']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Author'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['author']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('UpdateAuthor'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['updateAuthor']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Created'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['created']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Updated'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['updated']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Started'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['started']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('TimeSpentSeconds'); ?></td>
		<td>
			<?php echo h($worklog['Worklog']['timeSpentSeconds']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Issue'); ?></td>
		<td>
			<?php echo $this->Html->link($worklog['Issue']['description'], array('controller' => 'issues', 'action' => 'view', $worklog['Issue']['id'])); ?>
			&nbsp;
		</td>
	</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
