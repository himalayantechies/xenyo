<?php //debug($epics); ?>
<div class="row issues">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="fa fa-reorder"></i><?php echo __('Epic'); ?></div>
                <div class="actions">
                    <?php echo $this->Html->link(__('Edit Epic'), array('action' => 'edit', $epic['Epic']['id']), array('class' => 'btn purple')); ?>
                    <?php echo $this->Html->link(__('Add Epic'), array('action' => 'add'), array('class' => 'btn green')); ?>
                    <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')), array('action' => 'delete', $epic['Epic']['id']), array('class' => 'btn default btn-xs grey', 'escape' => false), __('Are you sure you want to delete # %s?', $epic['Epic']['id'])); ?>
                </div>                    
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-striped table-bordered">
					<tbody>
                    	<tr>
							<td><?php echo __('Key'); ?></td>
							<td><?php echo $this->Html->link($epic['Epic']['key'], 'http://jira.xenyo.net/browse/' . $epic['Epic']['key'], array('target' => '_blank')); ?></td>
							<td><?php echo __('Id'); ?></td>
							<td><?php echo h($epic['Epic']['id']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Description'); ?></td>
							<td colspan="3"><?php echo $epic['Epic']['description']; ?></td>
						</tr>
						<tr>
							<td><?php echo __('Client'); ?></td>
							<td><?php echo $this->Html->link($epic['Client']['name'], array('controller' => 'clients', 'action' => 'view', $epic['Client']['id'])); ?></td>
							<td><?php echo __('Project'); ?></td>
							<td><?php echo $this->Html->link($epic['Project']['name'], array('controller' => 'projects', 'action' => 'view', $epic['Project']['id'])); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Business Value'); ?></td>
							<td colspan="3"><?php echo h($epic['Epic']['business_value']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Original Contract Hour'); ?></td>
							<td colspan="3"><?php echo h($epic['Epic']['original_contract_hour']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Additional Hours'); ?></td>
							<td><?php echo h($epic['Epic']['additional_hours']); ?></td>
							<td><?php echo __('Additional Rate'); ?></td>
							<td><?php echo h($epic['Epic']['additional_rate']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Hours Spent'); ?></td>
							<td><?php echo h($epic['Epic']['hours_spent']); ?></td>
							<td><?php echo __('Hours Remaining'); ?></td>
							<td><?php echo h($epic['Epic']['hours_remaining']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Issue Type'); ?></td>
							<td><?php echo h($epic['Epic']['issuetype']); ?></td>
							<td><?php echo __('Type'); ?></td>
							<td><?php echo h($epic['Epic']['issue_type']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Epic Name'); ?></td>
							<td><?php echo h($epic['Epic']['epic_name']); ?></td>
							<td><?php echo __('Epic Link'); ?></td>
							<td><?php echo h($epic['Epic']['epic_link']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Created'); ?></td>
							<td><?php echo h($epic['Epic']['created']); ?></td>
							<td><?php echo __('Updated'); ?></td>
							<td><?php echo h($epic['Epic']['updated']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Priority'); ?></td>
							<td colspan="3"><?php echo h($epic['Epic']['priority']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Assignee'); ?></td>
							<td colspan="3"><?php echo h($epic['Epic']['assignee']); ?></td>
						</tr>
						<tr>
							<td><?php echo __('Status'); ?></td>
							<td colspan="3"><?php echo h($epic['Epic']['status']); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>

<div class="row issues">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Issues'); ?></div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1"><?php echo 'Key'; ?></th>
                                <th class="col-md-3"><?php echo 'Description'; ?></th>
                                <th class="col-md-3"><?php echo 'Epic'; ?></th>
                                <th class="col-md-1"><?php echo 'Hours Spent'; ?></th>
                                <th class="col-md-1"><?php echo 'Hours Remaining'; ?></th>
                                <th class="col-md-1"><?php echo 'Assignee'; ?></th>
                                <th class="col-md-1"><?php echo 'Status'; ?></th>
                                <th class="col-md-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($issues as $count => $issue): ?>
							<tr>
								<td><?php echo $this->Html->link($issue['Issue']['key'], 'http://jira.xenyo.net/browse/' . $issue['Issue']['key'], array('target' => '_blank')); ?></td>
								<td><?php echo $this->Html->link($issue['Issue']['description'], array('controller' => 'issues', 'action' => 'view', $issue['Issue']['id'])); ?></td>
								<td><?php echo $this->Form->input('Issue.epic_link', array(
												'class' 	=> 'form-control', 
												'label' 	=> false, 
												'div' 		=> false, 
												'options' 	=> $epics,
												'save-link' => $this->Html->url(array('controller' => 'issues', 'action' => 'save', $issue['Issue']['id'])),
												'value' 	=> $issue['Issue']['epic_link'])); ?></td>
								<td><?php echo h($issue['Issue']['hours_spent']); ?></td>
								<td><?php echo h($issue['Issue']['hours_remaining']); ?></td>
								<td><?php echo h($issue['Issue']['assignee']); ?></td>
								<td><?php echo h($issue['Issue']['status']); ?></td>
								<th class="actions">
									<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')), array('controller' => 'issues', 'action' => 'delete', $issue['Issue']['id']), array('class' => 'btn default btn-xs grey', 'escape' => false), __('Are you sure you want to delete # %s?', $issue['Issue']['id'])); ?>
								</th>
							</tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
                    <?php if (!empty($epic['Worklog'])): ?>
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
                       	<?php foreach ($epic['Worklog'] as $worklog): ?>
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
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function() {    
   AccountingPeriod.ChangeEpic();
});
</script>