<?php 
/* BEGIN PAGE LEVEL PLUGINS */
echo $this->Html->script(array('pages/table-managed'), array('inline' => false));
/* END PAGE LEVEL PLUGINS */
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Epic'); ?></div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="epic-index">
                        <thead>
                            <tr>
                                <th class="col-md-1">Key</th>
                                <th class="col-md-5">Description</th>
                                <th class="col-md-1">Type</th>
                                <th class="col-md-1">Issue</th>
                                <th class="col-md-1">Priority</th>
                                <th class="col-md-1">Assignee</th>
                                <th class="col-md-1">Status</th>
                                <th class="col-md-1">Restore</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($epics as $epic): ?>
							<tr>
								<td><?php echo $epic['Epic']['key']; ?></td>
								<td><?php echo $epic['Epic']['description']; ?></td>
								<td><?php echo $epic['Epic']['issue_type']; ?></td>
								<td><?php echo $epic['Epic']['issuetype']; ?></td>
								<td><?php echo $epic['Epic']['priority']; ?></td>
								<td><?php echo $epic['Epic']['assignee']; ?></td>
								<td><?php echo $epic['Epic']['status']; ?></td>
								<td><?php 
									echo $this->Html->link('Restore', array('controller' => 'epics', 'action' => 'restore', $epic['Epic']['id'])); ?></td>
							</tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Issues'); ?></div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="issue-index">
                        <thead>
                            <tr>
                                <th class="col-md-1">Key</th>
                                <th class="col-md-5">Description</th>
                                <th class="col-md-1">Issue</th>
                                <th class="col-md-1">Priority</th>
                                <th class="col-md-1">Assignee</th>
                                <th class="col-md-2">Status</th>
                                <th class="col-md-1">Restore</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($issues as $issue): ?>
							<tr>
								<td><?php echo $issue['Issue']['key']; ?></td>
								<td><?php echo $issue['Issue']['description']; ?></td>
								<td><?php echo $issue['Issue']['issuetype']; ?></td>
								<td><?php echo $issue['Issue']['priority']; ?></td>
								<td><?php echo $issue['Issue']['assignee']; ?></td>
								<td><?php echo $issue['Issue']['status']; ?></td>
								<td><?php 
									echo $this->Html->link('Restore', array('controller' => 'issues', 'action' => 'restore', $issue['Issue']['id'])); ?></td>
							</tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Worklogs'); ?></div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="worklog-index">
                        <thead>
                            <tr>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-3">Project</th>
                                <th class="col-md-4">Issue</th>
                                <th class="col-md-1">Author</th>
                                <th class="col-md-1">Started</th>
                                <th class="col-md-1">Hours</th>
                                <th class="col-md-1">Restore</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($worklogs as $worklog): //debug($worklog); ?>
							<tr>
								<td><?php echo $worklog['Worklog']['id']; ?></td>
								<td><?php echo $worklog['Project']['name']; ?></td>
								<td><?php echo $worklog['Issue']['description']; ?></td>
								<td><?php echo $worklog['Worklog']['author']; ?></td>
								<td><?php echo date('Y-m-d', strtotime($worklog['Worklog']['started'])); ?></td>
								<td><?php echo $worklog['Worklog']['timeSpentSeconds']/3600; ?></td>
								<td><?php 
									echo $this->Html->link('Restore', array('controller' => 'worklogs', 'action' => 'restore', $worklog['Worklog']['id'])); ?></td>
							</tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function() {    
   TableManaged.epicIndex();
   TableManaged.issueIndex();
   TableManaged.worklogIndex();
});
</script>