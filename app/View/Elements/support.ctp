<div class="row support">
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
                                <th class="col-md-2">Project</th>
                                <th class="col-md-2">Epic</th>
                                <th class="col-md-1">BV</th>
                                <th class="col-md-1">Invoiced Value</th>
                                <th class="col-md-1">Contract Hours</th>
                                <th class="col-md-1">Total Hours Worked</th>
                                <th class="col-md-1">Hours Worked in Month</th>
                                <th class="col-md-1">Average Rate</th>
                                <th class="col-md-1">Value Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
                        	$total_business_value = $total_contract_hours = $total_hours_worked = 0;
                        	$total_month_hours = $total_invoiced_value = $total_average_rate = $total_value_completed = 0;
                        	foreach ($reports as $epic):
                        	?>
							<tr>
								<td><?php 
									echo $this->Html->link($epic['Project']['name'], 
														   array('controller' => 'projects', 'action' => 'view', $epic['Project']['id'])); ?>
								</td>
								<td><?php 
									echo $this->Html->link($epic['Epic']['key'] . ' ' . $epic['Epic']['epic_name'], 
														   array('action' => 'view', $epic['Epic']['id'])); ?>
								</td>
								<td class="amount"><?php
									$total_business_value += $epic['Epic']['business_value'];
									echo number_format($epic['Epic']['business_value'], 2); ?></td>
								<td class="amount"><?php 
									$total_invoiced_value += $epic['Epic']['invoiced_value'];
									echo number_format($epic['Epic']['invoiced_value'], 2); ?></td>
								<td class="amount"><?php 
									$total_contract_hours += $epic['Epic']['contract_hours'];
									echo number_format($epic['Epic']['contract_hours'], 2); ?></td>
								<td class="amount"><?php 
									$total_hours_worked += $epic['Epic']['hours_worked'];
									echo number_format($epic['Epic']['hours_worked'], 2); ?></td>
								<td class="amount"><?php 
									$total_month_hours += $epic['Epic']['month_hours'];
									echo number_format($epic['Epic']['month_hours'], 2); ?></td>
								<td class="amount"><?php 
									$total_average_rate += $epic['Epic']['average_rate'];
									echo number_format($epic['Epic']['average_rate'], 2); ?></td>
								<td class="amount"><?php 
									$total_value_completed += $epic['Epic']['value_completed'];
									echo number_format($epic['Epic']['value_completed'], 2); ?></td>
							</tr>
							<?php endforeach; ?>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="amount"><?php echo number_format($total_business_value, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_invoiced_value, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_contract_hours, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_hours_worked, 2); ?></th>
                                <th class="amount"><?php echo number_format($total_month_hours, 2); ?></th>
                                <th class="amount"><?php
                                if($total_hours_worked > 0) {
                                	echo number_format($total_invoiced_value/$total_hours_worked, 2);
                                } else {
                                	echo number_format(0, 2);
                                }
                                ?></th>
                                <th class="amount"><?php echo number_format($total_value_completed, 2); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>