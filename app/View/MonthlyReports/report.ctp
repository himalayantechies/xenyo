<?php 
/* BEGIN PAGE LEVEL PLUGINS */
echo $this->Html->script(array( '../plugins/flot/jquery.flot.min', '../plugins/flot/jquery.flot.axislabels',
								'pages/charts-flotcharts'), array('inline' => false));
/* END PAGE LEVEL PLUGINS */
$chart = array();
?>
<div class="row">
    <div class="col-md-12">
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-equalizer font-green-haze"></i>
					<span class="caption-subject font-green-haze bold uppercase">Filter Criteria</span>
				</div>
				<div class="tools"><a class="collapse" href="" data-original-title="" title=""></a></div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
	            <?php echo $this->Form->create('Issue', array('class' => 'form-horizontal', 
	                                                          'inputDefaults' => array('div' => false, 'label' => false, 'class' => 'form-control'))); ?>
					<div class="form-body">
						<div class="row">
							<?php if($this->Session->read('Auth.User.role') != 'Support') { ?>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label col-md-3">Type</label>
									<div class="col-md-9">
							            <?php echo $this->Form->input('MonthlyReport.type', array(
							            					'empty'		=> '(All)',
							            					'options' 	=> array('Project' => 'Project', 
							            										 'Support' => 'Support',
							            										 'Xenyo'   => 'Xenyo'))); ?>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label col-md-3">Start</label>
									<div class="col-md-9">
		                                <div class="input-group date date-picker-month">
		                                    <?php echo $this->Form->input('Worklog.start', array('type' => 'text')); ?>
		                                    <span class="input-group-btn">
		                                        <button type="button" class="btn default"><i class="fa fa-calendar"></i></button>
		                                    </span>
		                                </div>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label col-md-3">End</label>
									<div class="col-md-9">
		                                <div class="input-group date date-picker-month">
		                                    <?php echo $this->Form->input('Worklog.end', array('type' => 'text')); ?>
		                                    <span class="input-group-btn">
		                                        <button type="button" class="btn default"><i class="fa fa-calendar"></i></button>
		                                    </span>
		                                </div>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-3">
								<button class="btn green pull-right" type="submit">Filter Results</button>
							</div>
						</div>
						<!--/row-->
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Issues'); ?></div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"></a>
                    <a class="config" data-toggle="modal" href="#portlet-config"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                        	<?php 
                        	$header_row_1 = $header_row_2 = $footer_row = '';
                        	foreach($authors as $key => $value) {
                        		$header_row_1 .= $this->Html->tag('th', $value, array('colspan' => 4, 'class' => 'text-center'));
								$header_row_2 .= $this->Html->tag('th', 'Hours');
								$header_row_2 .= $this->Html->tag('th', 'Total');
								$header_row_2 .= $this->Html->tag('th', '');
								$header_row_2 .= $this->Html->tag('th', 'Average');
								$chart[$key]['label'] = $value;
								$chart[$key]['lines'] = array('lineWidth' => 1);
								$chart[$key]['shadowSize'] = 0;
							}
                        	?>
                        	<tr>
                        		<th rowspan="2" class="text-center">Time</th>
                        		<th colspan="3" class="text-center">Summary</th>
                        		<?php echo $header_row_1; ?>
                        	</tr>
                        	<tr>
                        		<th>Monthly Total HRs</th>
                        		<th>Monthly Total</th>
                        		<th>Avg Monthly Rate</th>
                        		<?php echo $header_row_2; ?>
                        	</tr>
                    	<?php
                    	$total_hours = $total_monthly = 0; 
                    	foreach($reports as $date => $report) {
                    		$total_hours += $report['total_hours'];
							$total_monthly += $report['total_monthly'];
                    	?>
                        	<tr>
                        		<td><?php echo $date; ?></td>
                        		<td class="amount"><?php echo number_format($report['total_hours'], 2); ?></td>
                        		<td class="amount"><?php echo number_format($report['total_monthly'], 2); ?></td>
                        		<td class="amount"><?php echo number_format($report['monthly_average'], 2); ?></td>
	                    	<?php 
	                    	foreach($authors as $key => $value) {
	                    		if(!isset($footer_row[$key]['month_hours'])) {
	                    			$footer_row[$key]['month_hours'] = 0;
	                    		} 
	                    		if(!isset($footer_row[$key]['value_completed'])) {
	                    			$footer_row[$key]['value_completed'] = 0;
	                    		} 
	                    		if(!isset($footer_row[$key]['hours_worked'])) {
	                    			$footer_row[$key]['hours_worked'] = 0;
	                    		} 
	                    	?>
		                    	<td class="amount"><?php
		                    	if($report[$key] != $value) {
		                    		echo number_format($report[$key]['month_hours'], 2);
									$footer_row[$key]['month_hours'] += $report[$key]['month_hours'];
		                    	} else {
		                    		echo number_format(0.00, 2);
		                    	}
		                    	?></td>
		                    	<td class="amount"><?php
		                    	if($report[$key] != $value) {
		                    		echo number_format($report[$key]['value_completed'], 2);
									$footer_row[$key]['value_completed'] += $report[$key]['value_completed'];
		                    	} else {
		                    		echo number_format(0.00, 2);
		                    	}
		                    	?></td>
		                    	<td class="amount"><?php
		                    	if($report[$key] != $value) {
		                    		echo number_format($report[$key]['hours_worked'], 2);
									$footer_row[$key]['hours_worked'] += $report[$key]['hours_worked'];
		                    	} else {
		                    		echo number_format(0.00, 2);
		                    	}
		                    	?></td>
		                    	<td class="amount"><?php
		                    	if($report[$key] != $value) {
		                    		$monthly_average = $report[$key]['monthly_average'];
		                    	} else {
		                    		$monthly_average = 0.00;
		                    	}
	                    		echo number_format($monthly_average, 2);
								//strtotime($date)
								//substr($date, 0, 3)
		                    	$chart[$key]['data'][substr($date, 0, 3)] = $monthly_average;
		                    	?></td>
	                    	<?php } ?>
                    		</tr>
	                    <?php } ?>
	                    	<tr>
                        		<th></th>
                        		<?php 
                    			echo $this->Html->tag('th', number_format($total_hours, 2), array('class' => 'amount'));
                    			echo $this->Html->tag('th', number_format($total_monthly, 2), array('class' => 'amount'));
                    			echo $this->Html->tag('th', number_format($total_monthly/$total_hours, 2), array('class' => 'amount'));
                        		foreach($footer_row as $row) {
                        			echo $this->Html->tag('th', number_format($row['month_hours'], 2), array('class' => 'amount'));
                        			echo $this->Html->tag('th', number_format($row['value_completed'], 2), array('class' => 'amount'));
                        			echo $this->Html->tag('th', number_format($row['hours_worked'], 2), array('class' => 'amount'));
									$average = 0;
									if($row['hours_worked'] > 0) {
										$average = $row['value_completed']/$row['hours_worked'];
									}
                        			echo $this->Html->tag('th', number_format($average, 2), array('class' => 'amount'));
                        		} ?>
	                    	</tr>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
		<!-- BEGIN INTERACTIVE CHART PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Interactive Chart
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="#portlet-config" data-toggle="modal" class="config"> </a>
				</div>
			</div>
			<div class="portlet-body">
				<div id="monthly_report" class="chart"></div>
			</div>
		</div>
		<!-- END INTERACTIVE CHART PORTLET-->
    </div>
</div>
<?php
$count = count($chart);
$chart_data  = '[';
foreach($chart as $key => $value) {
	$chart_data .= '{label:"' . $value['label'] . '",lines:{lineWidth:' . $value['lines']['lineWidth'] . '},shadowSize:' . $value['shadowSize'] . ',';
	$averge_data  = 'data:[';
	$countAvg = count($value['data']);
	$datacount = 0;
	$labels = '[';
	foreach($value['data'] as $id => $average) {
		$labels 	 .= '[' . $datacount . ',"' . $id . '"]'; 
		$averge_data .= '[' . $datacount++ . ',' . round($average, 2) . ']';
		if($countAvg-- > 1) {
			$labels 	 .= ',';
			$averge_data .= ',';
		}
	}
	$averge_data .= ']}';
	$chart_data .= $averge_data;
	if($count-- > 1) {
		$chart_data .= ',';
	}
	$labels .= ']';
}
$chart_data .= ']';
?>
<script>
var chart_data = <?php echo $chart_data; ?> ;
var xaxis_label = <?php echo $labels; ?> ;

jQuery(document).ready(function() {    
   AccountingPeriod.initDatePicker();
   ChartsFlotcharts.init();
   ChartsFlotcharts.initCharts(chart_data, xaxis_label);
});
</script>
