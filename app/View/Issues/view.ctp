<div class="row issues">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="fa fa-reorder"></i><?php echo __('Issue'); ?></div>
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-striped table-bordered">
					<tbody>
                    	<tr>
							<td><?php echo __('Key'); ?></td>
							<td><?php echo $this->Html->link($issue['Issue']['key'], 'http://jira.xenyo.net/browse/' . $issue['Issue']['key'], array('target' => '_blank')); ?></td>
							<td><?php echo __('Id'); ?></td>
							<td><?php echo h($issue['Issue']['id']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Description'); ?></td>
							<td><?php echo $issue['Issue']['description']; ?></td>
							<td><?php echo __('Project'); ?></td>
							<td><?php echo $this->Html->link($issue['Project']['name'], array('controller' => 'projects', 'action' => 'view', $issue['Project']['id'])); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Business Value'); ?></td>
							<td colspan="3"><?php echo h($issue['Issue']['business_value']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Original Contract Hour'); ?></td>
							<td colspan="3"><?php echo h($issue['Issue']['original_contract_hour']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Additional Hours'); ?></td>
							<td><?php echo h($issue['Issue']['additional_hours']); ?></td>
							<td><?php echo __('Additional Rate'); ?></td>
							<td><?php echo h($issue['Issue']['additional_rate']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Hours Spent'); ?></td>
							<td><?php echo h($issue['Issue']['hours_spent']); ?></td>
							<td><?php echo __('Hours Remaining'); ?></td>
							<td><?php echo h($issue['Issue']['hours_remaining']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Issue Type'); ?></td>
							<td><?php echo h($issue['Issue']['issuetype']); ?></td>
							<td><?php echo __('Type'); ?></td>
							<td><?php echo h($issue['Issue']['issue_type']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Epic Name'); ?></td>
							<td><?php echo h($issue['Issue']['epic_name']); ?></td>
							<td><?php echo __('Epic Link'); ?></td>
							<td><?php echo h($issue['Issue']['epic_link']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Created'); ?></td>
							<td><?php echo h($issue['Issue']['created']); ?></td>
							<td><?php echo __('Updated'); ?></td>
							<td><?php echo h($issue['Issue']['updated']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Priority'); ?></td>
							<td colspan="3"><?php echo h($issue['Issue']['priority']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Assignee'); ?></td>
							<td colspan="3"><?php echo h($issue['User']['name']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Status'); ?></td>
							<td colspan="3"><?php echo h($issue['Issue']['status']); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>

<div class="row issues related">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Related Worklogs'); ?></div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"> </a>
                    <a class="config" data-toggle="modal" href="#portlet-config"> </a>
                    <a class="reload" href="javascript:;"> </a>
                    <a class="remove" href="javascript:;"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?php if (!empty($issue['Worklog'])): ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1"> <?php echo __('Id'); ?></th>
                                <th class="col-md-1"> <?php echo __('Author'); ?></th>
                                <th class="col-md-1"> <?php echo __('UpdateAuthor'); ?></th>
                                <th class="col-md-2"> <?php echo __('Started'); ?></th>
                                <th class="col-md-2"> <?php echo __('Time Spent'); ?></th>
                                <th class="col-md-1 actions"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                       	<?php
                       	$totalTimeSpent = 0; 
                       	foreach ($issue['Worklog'] as $worklog):
                       		$totalTimeSpent += $worklog['timeSpentSeconds']/3600;
                       	?>
							<tr>
								<td><?php echo $worklog['id']; ?></td>
								<td><?php echo $worklog['author']; ?></td>
								<td><?php echo $worklog['updateAuthor']; ?></td>
								<td><?php echo $worklog['started']; ?></td>
								<td><?php echo $worklog['timeSpentSeconds']/3600; ?></td>
								<th class="actions">
									<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-share')), array('controller' => 'worklogs', 'action' => 'view', $worklog['id']), array('class' => 'btn default btn-xs green', 'escape' => false)); ?>
									<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')), array('controller' => 'worklogs', 'action' => 'delete', $worklog['id']), array('class' => 'btn default btn-xs grey', 'escape' => false), __('Are you sure you want to delete # %s?', $worklog['id'])); ?>
								</th>
							</tr>
						<?php endforeach; ?>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><?php echo $totalTimeSpent; ?></td>
								<th class="actions"></th>
							</tr>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
