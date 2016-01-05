<div class="row issues form">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i><?php echo __('Edit Epic'); ?>                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"> </a>
                    <a class="config" data-toggle="modal" href="#portlet-config"> </a>
                    <a class="reload" href="javascript:;"> </a>
                    <a class="remove" href="javascript:;"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php echo $this->Form->create('Epic', array('class' => 'form-horizontal', 
                                                           'inputDefaults' => array('div' => false,
                                                                                    'label' => false, 
                                                                                    'class' => 'form-control'))); ?>
                <div class="form-body">
                    <div class='form-group'>
						<label class='col-md-3 control-label'>Key</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('key'); ?>
							<?php echo $this->Form->input('self', array('type' => 'hidden', 'value' => '')); ?>
							<?php echo $this->Form->input('subtask', array('type' => 'hidden', 'value' => '')); ?>
							<?php echo $this->Form->input('worklog', array('type' => 'hidden', 'value' => '0')); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Description</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('description'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Project</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('project_id'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Client</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('client_id'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Issue Type</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('issuetype', array('type' => 'hidden', 'value' => 'Epic')); ?>
							<?php
							$options = array('Project' => 'Project', 'Support' => 'Support', 'Xenyo' => 'Xenyo');
							echo $this->Form->input('issue_type', array('options' => $options, 'empty' => true)); 
							?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Priority</label>
						<div class='col-md-4'>
							<?php
							$options = array('Major' => 'Major', 'Critical' => 'Critical', 'Minor' => 'Minor');
							echo $this->Form->input('priority', array('options' => $options, 'empty' => true)); 
							?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Assignee</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('assignee'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Status</label>
						<div class='col-md-4'>
							<?php
							$options = array('Open' => 'Open', 'Closed' => 'Closed', 'NEED CLARIFICATION' => 'NEED CLARIFICATION',
											 'Reopened' => 'Reopened', 'Ready for Testing' => 'Ready for Testing', 'In Progress' => 'In Progress');
							echo $this->Form->input('status', array('options' => $options, 'empty' => true)); 
							?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Business Value</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('business_value'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Month Year</label>
						<div class='col-md-1'>
							<?php echo $this->Form->input('month_year', array('type' => 'text', 'class' => 'form-control date-picker-month')); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Original Contract Hour</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('original_contract_hour'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Additional Hours</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('additional_hours'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Additional Rate</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('additional_rate'); ?>
						</div>
					</div>
                    <div class="form-actions right">
                        <button class="btn green" type="submit">Submit</button>
                        <button class="btn default" type="button">Cancel</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function() {    
   AccountingPeriod.initDatePicker();
});
</script>