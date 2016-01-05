<!-- BEGIN USER LOGIN DROPDOWN -->
<li class="dropdown dropdown-user">
	<?php echo $this->Html->link(
                $this->Html->tag('i', '', array('class' => 'fa fa-key')) . ' Log Out', 
                array('controller' => 'users', 'action' => 'logout'),
                array('escape' => false)
    ); ?>
</li>
<!-- END USER LOGIN DROPDOWN -->
