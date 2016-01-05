<div class="row users form">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i><?php echo __('Add User'); ?>                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"> </a>
                    <a class="config" data-toggle="modal" href="#portlet-config"> </a>
                    <a class="reload" href="javascript:;"> </a>
                    <a class="remove" href="javascript:;"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 
	                                                       'inputDefaults' => array('div' => false,
	                                                                                'label' => false, 
	                                                                                'class' => 'form-control'))); ?>
                <div class="form-body">
                    <div class='form-group'>
						<label class='col-md-3 control-label'>Name</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('name'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Username</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('username'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Password</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('password'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Email</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('email'); ?>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-3 control-label'>Role</label>
						<div class='col-md-4'>
							<?php echo $this->Form->input('role', array('options' => array( 'Admin' 	=> 'Admin', 
																							'Author' 	=> 'Author', 
																							'Developer' => 'Developer', 
																							'Member' 	=> 'Member',
																							'Support' 	=> 'Support'))); ?>
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
