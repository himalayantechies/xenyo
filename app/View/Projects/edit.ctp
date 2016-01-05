<div class="row projects form">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i><?php echo __('Edit Project'); ?></div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php echo $this->Form->create('Project', array('class' => 'form-horizontal', 
                                                               'inputDefaults' => array('div' => false,
                                                                                        'label' => false, 
                                                                                        'class' => 'form-control'))); ?>
                <div class="form-body">
					<div class='form-group'>
						<label class='col-md-3 control-label'>Name</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('id'); ?>
							<?php echo $this->Form->input('name'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Key</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('key'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Self</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('self'); ?>
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
