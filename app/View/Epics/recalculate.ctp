<div class="row">
    <div class="col-md-12">
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-equalizer font-green-haze"></i>
					<span class="caption-subject font-green-haze bold uppercase">Recalculate</span>
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
									<label class="control-label col-md-3">Start</label>
									<div class="col-md-9">
		                                <div class="input-group date date-picker-month">
		                                    <?php echo $this->Form->input('Epic.monthstart', array('type' => 'text')); ?>
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
		                                    <?php echo $this->Form->input('Epic.monthend', array('type' => 'text')); ?>
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
									<label class="control-label"><?php echo $message; ?></label>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-3">
								<button class="btn green pull-right" type="submit">Recalculate</button>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
					</div>
				</form>
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