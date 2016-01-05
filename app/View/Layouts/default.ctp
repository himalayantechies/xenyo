<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php //echo $cakeDescription ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all');
        
        echo $this->Html->css(array('../plugins/font-awesome/css/font-awesome.min',
                                    '../plugins/bootstrap/css/bootstrap.min',
									'../plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
									'../plugins/bootstrap-datepicker/css/datepicker'));
                                    
        echo $this->fetch('css');
        echo $this->Html->css(array('components', 'plugins', 'layout'));
        echo $this->Html->css('themes/default', array('id' => 'style_color'));
        echo $this->Html->css('custom');

        /* START CORE PLUGINS */
        echo $this->Html->script(array('../plugins/respond.min',
                                       '../plugins/excanvas.min',
                                       '../plugins/jquery-1.11.0.min',
                                       '../plugins/jquery-migrate-1.2.1.min',
                                       '../plugins/bootstrap/js/bootstrap.min',
                                       '../plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min',
                                       '../plugins/jquery-slimscroll/jquery.slimscroll.min',
                                       '../plugins/jquery.blockui.min',
                                       '../plugins/jquery.cokie.min',
                                       '../plugins/datatables/media/js/jquery.dataTables.min',
									   '../plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
									   '../plugins/bootstrap-datepicker/js/bootstrap-datepicker'));
        /* END CORE PLUGINS */
                
        /* BEGIN PAGE LEVEL SCRIPTS */
        echo $this->fetch('script');
        
        echo $this->Html->script(array('layout/metronic', 'layout/layout', 'pages/accounting-period'));

		echo $this->fetch('meta');
	?>
</head>
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed">
    <?php echo $this->element('header'); ?>
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<?php echo $this->element('sidebar'); ?>
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN BREADCRUMBS -->
					<?php echo $this->element('breadcrumb'); ?>
					<!-- END BREADCRUMBS -->
					<div class="clearfix"></div>
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
				</div>
			</div>
			<!-- END CONTENT -->
		</div>
		<!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php echo $this->element('footer'); ?>
    <?php echo $this->element('sql_dump'); ?>
    <!-- END FOOTER -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   AccountingPeriod.updateProjectIssues('<?php echo Router::url('/projects/updateProjectIssues'); ?>',
                                              '<?php echo Router::url('/worklogs/updateWorkLogs'); ?>');
   
   //AccountingPeriod.updateIssueWorklogs('<?php echo Router::url('/worklogs/updateWorkLogs'); ?>');
});
</script>
</body>
</html>
