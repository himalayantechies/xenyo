
<div class="row clients">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i><?php echo __('Client'); ?>				</div>
				<div class="tools">
					<a class="collapse" href="javascript:;"> </a>
					<a class="reload" href="javascript:;"> </a>
				</div>
                <div class="actions">
                    <?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['id']), array('class' => 'btn purple')); ?>                </div>                    
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-striped table-bordered">
					<tbody>
                    	<tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($client['Client']['id']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Name'); ?></td>
		<td>
			<?php echo h($client['Client']['name']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Created'); ?></td>
		<td>
			<?php echo h($client['Client']['created']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><?php echo __('Updated'); ?></td>
		<td>
			<?php echo h($client['Client']['updated']); ?>
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

<div class="row clients related">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Related Issues'); ?></div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"> </a>
                    <a class="config" data-toggle="modal" href="#portlet-config"> </a>
                    <a class="reload" href="javascript:;"> </a>
                    <a class="remove" href="javascript:;"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?php if (!empty($client['Issue'])): ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1"> <?php echo __('Id'); ?></th>
                                <th class="col-md-1"> <?php echo __('Key'); ?></th>
                                <th class="col-md-2"> <?php echo __('Description'); ?></th>
                                <th class="col-md-2"> <?php echo __('Business Value'); ?></th>
                                <th class="col-md-2"> <?php echo __('Month Year'); ?></th>
                                <th class="col-md-2"> <?php echo __('Original Contract Hour'); ?></th>
                                <th class="col-md-2"> <?php echo __('Additional Hours'); ?></th>
                                <th class="col-md-2"> <?php echo __('Additional Rate'); ?></th>
                                <th class="col-md-2"> <?php echo __('Issue Type'); ?></th>
                                <th class="col-md-2"> <?php echo __('Issuetype'); ?></th>
                                <th class="col-md-2"> <?php echo __('Assignee'); ?></th>
                                <th class="col-md-2"> <?php echo __('Updated'); ?></th>
                                <th class="col-md-2"> <?php echo __('Status'); ?></th>
                                <th class="col-md-2"> <?php echo __('Project Id'); ?></th>
                                <th class="col-md-1 actions"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($client['Issue'] as $issue): ?>
							<tr>
								<td><?php echo $issue['id']; ?></td>
								<td><?php echo $this->Html->link($issue['key'], 'http://jira.xenyo.net/browse/' . $issue['key'], array('target' => '_blank')); ?></td>
								<td><?php echo $this->Html->link($issue['description'], array('controller' => 'issues', 'action' => 'view', $issue['id'])); ?></td>
								<td><?php echo $issue['business_value']; ?></td>
								<td><?php echo $issue['month_year']; ?></td>
								<td><?php echo $issue['original_contract_hour']; ?></td>
								<td><?php echo $issue['additional_hours']; ?></td>
								<td><?php echo $issue['additional_rate']; ?></td>
								<td><?php echo $issue['issue_type']; ?></td>
								<td><?php echo $issue['issuetype']; ?></td>
								<td><?php echo $issue['assignee']; ?></td>
								<td><?php echo $issue['updated']; ?></td>
								<td><?php echo $issue['status']; ?></td>
								<td><?php echo $issue['project_id']; ?></td>
								<th class="actions">
									<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-share')), array('controller' => 'issues', 'action' => 'view', $issue['id']), array('class' => 'btn default btn-xs green', 'escape' => false)); ?>
									<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), array('controller' => 'issues', 'action' => 'edit', $issue['id']), array('class' => 'btn default btn-xs blue', 'escape' => false)); ?>
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
