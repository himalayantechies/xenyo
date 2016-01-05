<?php 
/* BEGIN PAGE LEVEL PLUGINS */
echo $this->Html->css(array('../plugins/data-tables/DT_bootstrap',
							'../plugins/bootstrap-datepicker/css/datepicker'), null, array('inline' => false));
echo $this->Html->script(array( '../plugins/data-tables/jquery.dataTables.min',
                                '../plugins/data-tables/DT_bootstrap.js',
								'../plugins/bootstrap-datepicker/js/bootstrap-datepicker'), array('inline' => false));
/* END PAGE LEVEL PLUGINS */
//debug($monthlyCells);
?>
<div class="row">
    <div class="col-md-12">
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-equalizer font-green-haze"></i>
					<span class="caption-subject font-green-haze bold uppercase">Filter Criteria</span>
				</div>
				<div class="tools">
					<a class="collapse" href="" data-original-title="" title=""> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
	            <?php echo $this->Form->create('Issue', array('class' => 'form-horizontal', 
	                                                          'inputDefaults' => array('div' => false, 'label' => false, 'class' => 'form-control'))); ?>
					<div class="form-body">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label col-md-3">Type</label>
									<div class="col-md-9">
							            <?php echo $this->Form->input('Issue.issue_type', array(
							            					'empty'		=> '(All)',
							            					'options' 	=> array('Project' => 'Project', 
							            										 'Support' => 'Support',
							            										 'Xenyo'   => 'Xenyo'))); ?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label col-md-3">Start</label>
									<div class="col-md-9">
		                                <div data-date-format="yyyy-mm-dd" class="input-group date date-picker">
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
		                                <div data-date-format="yyyy-mm-dd" class="input-group date date-picker">
		                                    <?php echo $this->Form->input('Worklog.end', array('type' => 'text')); ?>
		                                    <span class="input-group-btn">
		                                        <button type="button" class="btn default"><i class="fa fa-calendar"></i></button>
		                                    </span>
		                                </div>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn green" type="submit">Filter Results</button>
									</div>
								</div>
							</div>
							<div class="col-md-6"></div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
</div>

<div class="row issues index">
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
                        <thead>
                        	<?php echo $this->Html->tableHeaders($monthlyHeader); ?>
                        </thead>
                        <tbody>
                        	<?php echo $this->Html->tableCells($monthlyCells); ?>
                        	<tr><?php foreach($monthlyFooter as $footer): ?>
								<th class="amount"><?php echo is_numeric($footer)? number_format($footer, 2): ''; ?></th>
							<?php endforeach; ?></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
if (jQuery().datepicker) {
    $('.date-picker').datepicker({
        autoclose: true
    });
}
</script>
