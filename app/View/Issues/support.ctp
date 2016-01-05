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
                                <th class="col-md-1">Contract Hours</th>
                                <th class="col-md-1">Total Hours Worked</th>
                                <th class="col-md-1">Hours Worked in Month</th>
                                <th class="col-md-1">Value Charged</th>
                                <th class="col-md-1">Average Rate</th>
                                <th class="col-md-1">Value Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
                        	$total_business_value = $total_contract_hours = $total_total_hours_worked = 0;
                        	$total_hours_worked = $total_value_charged = $total_average_rate = $total_value_completed = 0;
                        	foreach ($reports as $issue):
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
								<td class="amount"><?php
									$total_business_value += $issue['Issue']['business_value'];
									echo number_format($issue['Issue']['business_value'], 2); ?></td>
								<td class="amount"><?php 
									$total_contract_hours += $issue['Issue']['contract_hours'];
									echo number_format($issue['Issue']['contract_hours'], 2); ?></td>
								<td class="amount"><?php 
									$total_total_hours_worked += $issue['Issue']['total_hours_worked'];
									echo number_format($issue['Issue']['total_hours_worked'], 2); ?></td>
								<td class="amount"><?php 
									$total_hours_worked += $issue['Issue']['hours_worked'];
									echo number_format($issue['Issue']['hours_worked'], 2); ?></td>
								<td class="amount"><?php 
									$total_value_charged += $issue['Issue']['value_charged'];
									echo number_format($issue['Issue']['value_charged'], 2); ?></td>
								<td class="amount"><?php 
									$total_average_rate += $issue['Issue']['average_rate'];
									echo number_format($issue['Issue']['average_rate'], 2); ?></td>
								<td class="amount"><?php 
									$total_value_completed += $issue['Issue']['value_completed'];
									echo number_format($issue['Issue']['value_completed'], 2); ?></td>
							</tr>
							<?php endforeach; ?>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="amount"><?php echo number_format($total_business_value, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_contract_hours, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_total_hours_worked, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_hours_worked, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_value_charged, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_average_rate, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_value_completed, 2); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>