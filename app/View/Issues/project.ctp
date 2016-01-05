<?php 
/* BEGIN PAGE LEVEL PLUGINS */
echo $this->Html->css(array('../plugins/data-tables/DT_bootstrap'), null, array('inline' => false));
echo $this->Html->script(array( '../plugins/data-tables/jquery.dataTables.min',
                                '../plugins/data-tables/DT_bootstrap.js'), array('inline' => false));
/* END PAGE LEVEL PLUGINS */
?>
<?php echo $this->element('filter-criteria'); ?>
<div class="row issues index">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Issues'); ?></div>
                <div class="actions">
                    <?php echo $this->Html->link(__('Add Issue'), array('action' => 'add'), array('class' => 'btn green')); ?>
                </div>                    
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-2"><?php echo $this->Paginator->sort('project_id'); ?></th>
                                <th class="col-md-2"><?php echo $this->Paginator->sort('epic_name'); ?></th>
                                <th class="col-md-1"><?php echo $this->Paginator->sort('business_value'); ?></th>
                                <th class="col-md-1">Project Budget Hours</th>
                                <th class="col-md-1">Total Hours Spent</th>
                                <th class="col-md-1">Total Hours Remaining</th>
                                <th class="col-md-1">Complete %</th>
                                <th class="col-md-1">Project Rate</th>
                                <th class="col-md-1">Month Hours</th>
                                <th class="col-md-1">Value Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php 
                        	$business_value = $project_budget_hours = $total_hours_spent = $total_hours_remaining = 0;
                        	$project_rate = $month_hours = $value_completed = 0;
							
                        	foreach ($reports as $issue): 
                    			$business_value 		+= $issue['Issue']['business_value'];
                    			$project_budget_hours 	+= $issue['Issue']['project_budget_hours'];
                    			$total_hours_spent 		+= $issue['Issue']['total_hours_spent'];
                    			$total_hours_remaining 	+= $issue['Issue']['total_hours_remaining'];
                    			$project_rate 			+= $issue['Issue']['project_rate'];
                    			$month_hours 			+= $issue['Issue']['month_hours'];
                    			$value_completed 		+= $issue['Issue']['value_completed'];
                        	?>
							<tr>
								<td><?php 
									echo $this->Html->link($issue['Project']['name'], 
														   array('controller' => 'projects', 'action' => 'view', $issue['Project']['id'])); ?>
								</td>
								<td><?php 
									echo $this->Html->link($issue['Issue']['key'] . ' ' . $issue['Issue']['epic_name'], 
														   array('action' => 'view', $issue['Issue']['id'])); ?>
								</td>
								<td class="amount"><?php echo number_format($issue['Issue']['business_value'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Issue']['project_budget_hours'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Issue']['total_hours_spent'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Issue']['total_hours_remaining'], 2); ?></td>
								<td class="amount"><?php echo sprintf("%.2f%%", $issue['Issue']['complete_percentage'] * 100); ?></td>
								<td class="amount"><?php echo number_format($issue['Issue']['project_rate'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Issue']['month_hours'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Issue']['value_completed'], 2); ?></td>
							</tr>
							<?php endforeach; ?>
 							<tr>
 								<th colspan="2"></th>
 								<th class="amount"><?php echo number_format($business_value, 2); ?></th>
 								<th class="amount"><?php echo number_format($project_budget_hours, 2); ?></th>
 								<th class="amount"><?php echo number_format($total_hours_spent, 2); ?></th>
 								<th class="amount"><?php echo number_format($total_hours_remaining, 2); ?></th>
 								<th></th>
 								<th class="amount"><?php echo number_format($project_rate, 2); ?></th>
 								<th class="amount"><?php echo number_format($month_hours, 2); ?></th>
 								<th class="amount"><?php echo number_format($value_completed, 2); ?></th>
 							</tr>
                        </tbody>
                    </table>
                </div>
                <?php /*
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="dataTables_info" id="sample_1_info">
                            <?php echo $this->Paginator->counter(array(
                            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                            )); ?>                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="dataTables_paginate paging_bootstrap">
                            <ul class="pagination"><?php
                                echo $this -> Paginator -> prev(
                                            $this->Html->tag('i', '', array('class' => 'fa fa-angle-left')), 
                                            array('escape' => false, 'tag' => 'li'), 
                                            $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-left')), '#', array('escape' => false)), 
                                            array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));
                                            
                                echo $this -> Paginator -> numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                                
                                echo $this -> Paginator -> next(
                                            $this->Html->tag('i', '', array('class' => 'fa fa-angle-right')), 
                                            array('escape' => false, 'tag' => 'li'), 
                                            $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-right')), '#', array('escape' => false)), 
                                            array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));
                                ?>
							</ul>
                        </div>
                    </div>
                </div>
				*/ ?>
            </div>
        </div>
    </div>
</div>