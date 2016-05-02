<?php 
/* BEGIN PAGE LEVEL PLUGINS */
echo $this->Html->script(array('pages/table-managed'), array('inline' => false));
/* END PAGE LEVEL PLUGINS */
?>
<div class="row">
    <div class="col-md-12">
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-equalizer font-green-haze"></i>
					<span class="caption-subject font-green-haze bold uppercase">Filter Criteria</span>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
	            <?php echo $this->Form->create('Epic', array('class' => 'form-horizontal', 
	                                                          'inputDefaults' => array('div' => false, 'label' => false, 'class' => 'form-control'))); ?>
					<div class="form-body">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label col-md-3">Type</label>
									<div class="col-md-9">
							            <?php echo $this->Form->input('Epic.issue_type', array(
							            					'empty'		=> '(Unassigned)',
							            					'options' 	=> array('%'	   => '--All--',
							            										 'Project' => 'Project', 
							            										 'Support' => 'Support',
							            										 'Xenyo'   => 'Xenyo'))); ?>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label col-md-3">Client</label>
									<div class="col-md-9">
							            <?php echo $this->Form->input('Epic.client_id', array('empty' => '(All)', 'options' => $clients)); ?>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-5">
								<button class="btn green pull-right" type="submit">Filter Results</button>
							</div>
						</div>
					</div>
					<!--/row-->
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
</div>

<div class="row epic-update">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Epic'); ?></div>
                <div class="actions">
                    <?php echo $this->Html->link(__('Add Epic'), array('action' => 'add'), array('class' => 'btn green')); ?>
                    <?php echo $this->Html->link(__('Sync Epics'), array('controller' => 'projects', 'action' => 'updateProjectIssues'), array('class' => 'btn yellow')); ?>
                </div>                    
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="epic-index">
                        <thead>
                            <tr>
                                <th class="col-md-3">Epic Name</th>
                                <th class="col-md-1">Type</th>
                                <th class="col-md-3">Client</th>
                                <th class="col-md-1">Month-Year</th>
                                <th class="col-md-1">Business <br />Value</th>
                                <th class="col-md-1">Original <br/>Contract <br />Hours</th>
                                <th class="col-md-1">Additional <br />Hours</th>
                                <th class="col-md-1">Additional <br />Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php 
                        	foreach ($epics as $epic):
	                        	$save_link = $this->Html->url(array('action' => 'index', $epic['Epic']['id']));
								$month_year = '';
								if(!is_null($epic['Epic']['month_year']) && $epic['Epic']['month_year'] != '') {
									$month_year = date('M-Y', strtotime($epic['Epic']['month_year']));
								} 
                        	?>
							<tr>
								<td><?php 
									echo $this->Html->link($epic['Epic']['key'] . ' ' . $epic['Epic']['epic_name'], 
														   array('action' => 'view', $epic['Epic']['id'])); ?></td>
								<td><?php echo $this->Form->input('Epic.issue_type', 
															array('label' => false, 'div' => false, 'class' => 'form-control',
																  'save-link' => $save_link,
																  'value' 	=> $epic['Epic']['issue_type'],
																  'empty'	=> '',
																  'options' => array('Project' => 'Project', 
																  					 'Support' => 'Support',
							            										 	 'Xenyo'   => 'Xenyo')));?></td>
								<td><?php echo $this->Form->input('Epic.client_id', 
															array('label' => false, 'div' => false, 'class' => 'form-control',
																  'save-link' => $save_link,
    															  'options' => $clients, 'empty' => '',
																  'value' => $epic['Epic']['client_id'])); ?></td>
								<td><?php echo $this->Form->input('Epic.month_year', array(
				                                    				'type' => 'text', 'label' => false, 'div' => false, 
				                                    				'class' => 'form-control date-picker',
																	'save-link' => $save_link,
																	'value' => $month_year)); ?></td>
								<td><?php echo $this->Form->input('Epic.business_value', 
															array('label' => false, 'div' => false, 'class' => 'form-control amount',
																  'type' => 'text',
																  'save-link' => $save_link,
																  'value' => $epic['Epic']['business_value'])); ?></td>
								<td><?php echo $this->Form->input('Epic.original_contract_hour', 
															array('label' => false, 'div' => false, 'class' => 'form-control amount',
																	'type' => 'text', 'save-link' => $save_link,
																  'value' => $epic['Epic']['original_contract_hour'])); ?></td>
								<td><?php echo $this->Form->input('Epic.additional_hours', 
															array('label' => false, 'div' => false, 'class' => 'form-control amount',
																	'type' => 'text', 'save-link' => $save_link,
																  'value' => $epic['Epic']['additional_hours'])); ?></td>
								<td><?php echo $this->Form->input('Epic.additional_rate', 
															array('label' => false, 'div' => false, 'class' => 'form-control amount',
																	'type' => 'text', 'save-link' => $save_link,
																  'value' => $epic['Epic']['additional_rate'])); ?></td>
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
   AccountingPeriod.SaveEpic();
});
</script>