<div class="row project">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Epic'); ?></div>
                <div class="actions">
                    <?php echo $this->Html->link(__('Add Epic'), array('action' => 'add'), array('class' => 'btn green')); ?>
                </div>                    
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-2">Project</th>
                                <th class="col-md-2">Epic</th>
                                <th class="col-md-1">BV</th>
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
                        	$additional_hours = $month_hours = $value_completed = 0;
							
                        	foreach ($reports as $issue): 
                    			$business_value 		+= $issue['Epic']['business_value'];
                    			$project_budget_hours 	+= $issue['Epic']['project_budget_hours'];
                    			$total_hours_spent 		+= $issue['Epic']['hours_spent'];
                    			$total_hours_remaining 	+= $issue['Epic']['hours_remaining'];
                    			$additional_hours 		+= $issue['Epic']['additional_hours'];
                    			$month_hours 			+= $issue['Epic']['month_hours'];
                    			$value_completed 		+= $issue['Epic']['value_completed'];
                    			$class 					= '';
                    			//if($issue['Epic']['complete_percentage'] == 1) {
                    			if($issue['Epic']['status'] == 'Open') {
                    				if($issue['Epic']['hours_spent'] > $issue['Epic']['project_budget_hours']) {
                    					$class = 'danger';
                    				}
                    			} elseif($issue['Epic']['status'] == 'Closed') {
                    				$class = 'success';
                    			}
                        	?>
							<tr class="<?php echo $class;?>">
								<td><?php 
									echo $this->Html->link($issue['Project']['name'], 
														   array('controller' => 'projects', 'action' => 'view', $issue['Project']['id'])); ?>
								</td>
								<td><?php 
									echo $this->Html->link($issue['Epic']['key'] . ' ' . $issue['Epic']['epic_name'], 
														   array('action' => 'view', $issue['Epic']['id'])); ?>
								</td>
								<td class="amount"><?php 
									echo number_format($issue['Epic']['business_value'], 2);
									if($issue['Epic']['additional_rate'] > 0) {
										echo '<br />(' . number_format($issue['Epic']['additional_rate'], 2) . ')';
									} 
								?></td>
								<td class="amount"><?php echo number_format($issue['Epic']['project_budget_hours'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Epic']['hours_spent'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Epic']['hours_remaining'], 2); ?></td>
								<td class="amount"><?php echo sprintf("%.2f%%", $issue['Epic']['complete_percentage'] * 100); ?></td>
								<td class="amount"><?php echo number_format($issue['Epic']['project_rate'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Epic']['month_hours'], 2); ?></td>
								<td class="amount"><?php echo number_format($issue['Epic']['value_completed'], 2); ?></td>
							</tr>
							<?php endforeach; ?>
 							<tr>
 								<th colspan="2"></th>
 								<th class="amount"><?php echo number_format($business_value, 2); ?></th>
 								<th class="amount"><?php echo number_format($project_budget_hours, 2); ?></th>
 								<th class="amount"><?php echo number_format($total_hours_spent, 2); ?></th>
 								<th class="amount"><?php echo number_format($total_hours_remaining, 2); ?></th>
 								<th></th>
 								<th class="amount"><?php
								if(($total_hours_spent + $total_hours_remaining + $additional_hours) > 0) {
									echo number_format(($business_value + $issue['Epic']['additional_rate'])/($total_hours_spent + $total_hours_remaining + $additional_hours), 2);
								} else {
									echo number_format(0, 2);
								}
 								?></th>
 								<th class="amount"><?php echo number_format($month_hours, 2); ?></th>
 								<th class="amount"><?php echo number_format($value_completed, 2); ?></th>
 							</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>