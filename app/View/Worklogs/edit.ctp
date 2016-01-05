<div class="row worklogs form">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i><?php echo __('Edit Worklog'); ?>                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"> </a>
                    <a class="config" data-toggle="modal" href="#portlet-config"> </a>
                    <a class="reload" href="javascript:;"> </a>
                    <a class="remove" href="javascript:;"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php echo $this->Form->create('Worklog', array('class' => 'form-horizontal', 
                                                                                   'inputDefaults' => array('div' => false,
                                                                                                            'label' => false, 
                                                                                                            'class' => 'form-control'))); ?>
                <div class="form-body">
                    <div class='form-group'>
	<label class='col-md-3 control-label'>id</label>
	<div class='col-md-4'>
		<?php echo $this->Form->input('id'); ?>
	</div>
</div>
<div class='form-group'>
	<label class='col-md-3 control-label'>self</label>
	<div class='col-md-4'>
		<?php echo $this->Form->input('self'); ?>
	</div>
</div>
<div class='form-group'>
	<label class='col-md-3 control-label'>author</label>
	<div class='col-md-4'>
		<?php echo $this->Form->input('author'); ?>
	</div>
</div>
<div class='form-group'>
	<label class='col-md-3 control-label'>updateAuthor</label>
	<div class='col-md-4'>
		<?php echo $this->Form->input('updateAuthor'); ?>
	</div>
</div>
<div class='form-group'>
	<label class='col-md-3 control-label'>started</label>
	<div class='col-md-4'>
		<?php echo $this->Form->input('started'); ?>
	</div>
</div>
<div class='form-group'>
	<label class='col-md-3 control-label'>timeSpentSeconds</label>
	<div class='col-md-4'>
		<?php echo $this->Form->input('timeSpentSeconds'); ?>
	</div>
</div>
<div class='form-group'>
	<label class='col-md-3 control-label'>issue_id</label>
	<div class='col-md-4'>
		<?php echo $this->Form->input('issue_id'); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Worklog.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Worklog.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Worklogs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
