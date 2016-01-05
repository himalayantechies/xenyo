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
                                    '../plugins/select2/select2',
                                    '../plugins/select2/select2-metronic'));

        echo $this->Html->css(array('pages/login', 'components', 'plugins', 'layout'));
        
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
                                       '../plugins/jquery.cokie.min'));
        /* END CORE PLUGINS */
        /* BEGIN PAGE LEVEL PLUGINS */
        echo $this->Html->script(array( '../plugins/jquery-validation/js/jquery.validate.min',
                                        '../plugins/select2/select2.min'));
        /* END PAGE LEVEL PLUGINS */
        /* BEGIN PAGE LEVEL SCRIPTS */
        echo $this->Html->script(array('layout/metronic', 'layout/layout', 'pages/login'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<?php echo $this->Html->link($this->Html->image('logo.png', array('height' => 60)), '/', array('escape' => false)); ?>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
     <?php echo date('Y') ?> &copy; Xenyo. Admin Dashboard.
</div>
<!-- END COPYRIGHT -->
<script>
    jQuery(document).ready(function() {     
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
    });
    </script>
<!-- END JAVASCRIPTS -->
<span role="status" aria-live="polite" class="select2-hidden-accessible"></span>
</body>
</html>
