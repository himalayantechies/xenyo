<?php //debug($project); ?>
<div class="row projects">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="fa fa-reorder"></i><?php echo __('Project'); ?></div>
                <div class="actions">
                    <?php echo $this->Html->link(__('Edit Project'), 
                    							 array('action' => 'edit', $project['Project']['id']), 
                    							 array('class' => 'btn purple')); ?>
                </div>                    
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-striped table-bordered">
					<tbody>
                    	<tr>
							<td><?php echo __('Id'); ?></td>
							<td><?php echo h($project['Project']['id']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Name'); ?></td>
							<td><?php echo h($project['Project']['name']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Key'); ?></td>
							<td><?php echo h($project['Project']['key']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Self'); ?></td>
							<td><?php echo h($project['Project']['self']); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>

<div class="row projects related">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Related Epics'); ?></div>
                <div class="actions">
                	<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-pencil')) . ' ' . __('New Epic'), 
                                                              array('controller' => 'epics', 'action' => 'add'), 
                                                              array('class' => 'btn blue', 'escape' => false)); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?php if (!empty($project['Epic'])): ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1"> <?php echo __('Key'); ?></th>
                                <th class="col-md-2"> <?php echo __('Description'); ?></th>
                                <th class="col-md-1"> <?php echo __('Type'); ?></th>
                                <th class="col-md-1"> <?php echo __('BV'); ?></th>
                                <th class="col-md-1"> <?php echo __('Month'); ?></th>
                                <th class="col-md-1"> <?php echo __('Original Contract Hrs'); ?></th>
                                <th class="col-md-1"> <?php echo __('Additional Hrs'); ?></th>
                                <th class="col-md-1"> <?php echo __('Additional Rate'); ?></th>
                                <th class="col-md-1"> <?php echo __('Assigned To'); ?></th>
                                <th class="col-md-1 actions"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                       	<?php foreach ($project['Epic'] as $issue): ?>
							<tr>
								<td><?php echo $this->Html->link($issue['key'], 'http://jira.xenyo.net/browse/' . $issue['key'], array('target' => '_blank')); ?></td>
								<td><?php echo $this->Html->link($issue['description'], array('controller' => 'epics', 'action' => 'view', $issue['id']), array('escape' => false)); ?></td>
								<td><?php echo $issue['issue_type']; ?></td>
								<td><?php echo $issue['business_value']; ?></td>
								<td><?php echo $issue['month_year']; ?></td>
								<td><?php echo $issue['original_contract_hour']; ?></td>
								<td><?php echo $issue['additional_hours']; ?></td>
								<td><?php echo $issue['additional_rate']; ?></td>
								<td><?php echo $issue['assignee']; ?></td>
								<th class="actions">
									<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), array('controller' => 'epics', 'action' => 'edit', $issue['id']), array('class' => 'btn default btn-xs blue', 'escape' => false)); ?>
									<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')), array('controller' => 'epics', 'action' => 'delete', $issue['id']), array('class' => 'btn default btn-xs grey', 'escape' => false), __('Are you sure you want to delete # %s?', $issue['id'])); ?>
								</th>
							</tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
