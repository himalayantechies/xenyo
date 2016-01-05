<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
			<li class="sidebar-toggler-wrapper margin-bottom-30">
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<div class="sidebar-toggler"></div>
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			</li>

            <!-- Reports -->
            <?php
			$parentlinkselected = $this->Html->tag('span', ' ', array('class' => 'selected')) . 
                                  $this->Html->tag('span', ' ', array('class' => 'arrow open'));
            ?>
            <li class="active start margin-top-20">
                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-shopping-cart')) . 
                                             $this->Html->tag('span', ' Reports', array('class' => 'title')) .
                                             $parentlinkselected, 
                                             'javascript:;',
                                             array('escape' => false)); ?>
                <ul class="sub-menu">
                    <li <?php echo ($this->request->controller == 'epics' && $this->request->action == 'report' && $this->request->pass[0] == 'Project')? 'class="active"': '';?>>
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . ' Projects', 
                                                     array('controller' => 'epics', 'action' => 'report', 'Project'),
                                                     array('escape' => false)); ?>
                    </li>
                    <li <?php echo ($this->request->controller == 'epics' && $this->request->action == 'report' && $this->request->pass[0] == 'Support')? 'class="active"': '';?>>
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . ' Support', 
                                                     array('controller' => 'epics', 'action' => 'report', 'Support'),
                                                     array('escape' => false)); ?>
                    </li>
		            <li <?php echo ($this->request->controller == 'monthly_reports' && $this->request->action == 'report')? 'class="active"': '';?>>
		                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . 
		                                             $this->Html->tag('span', ' Monthly Report', array('class' => 'title')), 
		                                             array('controller' => 'monthly_reports', 'action' => 'report'),
		                                             array('escape' => false)); ?>
		            </li>
		            <li <?php echo ($this->request->controller == 'epics' && $this->request->action == 'recalculate')? 'class="active"': '';?>>
		                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . 
		                                             $this->Html->tag('span', ' Monthly Recalculate', array('class' => 'title')), 
		                                             array('controller' => 'epics', 'action' => 'recalculate'),
		                                             array('escape' => false)); ?>
		            </li>
                </ul>
            </li>

            <!-- Administration -->
            <li class="active last">
                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-shopping-cart')) . 
                                             $this->Html->tag('span', ' Administration', array('class' => 'title')) .
                                             $parentlinkselected, 
                                             'javascript:;',
                                             array('escape' => false)); ?>
                <ul class="sub-menu">
		            <li <?php echo ($this->request->controller == 'epics' && $this->request->action == 'index')? 'class="active"': '';?>>
		                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-home')) . 
		                                             $this->Html->tag('span', ' Epic List', array('class' => 'title')), 
		                                             array('controller' => 'epics', 'action' => 'index'),
		                                             array('escape' => false)); ?>
		            </li>
		            <li <?php echo ($this->request->controller == 'projects')? 'class="active"': '';?>>
		                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . 
		                                             $this->Html->tag('span', ' Project List', array('class' => 'title')), 
		                                             array('controller' => 'projects', 'action' => 'index'),
		                                             array('escape' => false)); ?>
		            </li>
		            <li <?php echo ($this->request->controller == 'clients')? 'class="active"': '';?>>
		                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . 
		                                             $this->Html->tag('span', ' Clients', array('class' => 'title')), 
		                                             array('controller' => 'clients', 'action' => 'index'),
		                                             array('escape' => false)); ?>
		            </li>
		            <li <?php echo ($this->request->controller == 'users')? 'class="active"': '';?>>
		                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . 
		                                             $this->Html->tag('span', ' Users', array('class' => 'title')), 
		                                             array('controller' => 'users', 'action' => 'index'),
		                                             array('escape' => false)); ?>
		            </li>
		            <li <?php echo ($this->request->controller == 'pages')? 'class="active"': '';?>>
		                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart-o')) . 
		                                             $this->Html->tag('span', ' Deleted Items', array('class' => 'title')), 
		                                             array('controller' => 'pages', 'action' => 'deleted_list'),
		                                             array('escape' => false)); ?>
		            </li>
                </ul>
            </li>
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->