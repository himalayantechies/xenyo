<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php
        echo "<?php \n";
        echo "/* BEGIN PAGE LEVEL PLUGINS */\n";
        echo "echo \$this->Html->css(array( '../plugins/data-tables/DT_bootstrap'), null, array('inline' => false));\n";
        echo "echo \$this->Html->script(array( '../plugins/data-tables/jquery.dataTables.min',
                                        '../plugins/data-tables/DT_bootstrap.js'), array('inline' => false));\n";
        echo "/* END PAGE LEVEL PLUGINS */\n";
        echo "?>";
?>

<?php //$counter = $this -> Paginator -> counter(array('format' => __('{:start}'))); ?>
<div class="row <?php echo $pluralVar; ?> index">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"> </a>
                    <a class="config" data-toggle="modal" href="#portlet-config"> </a>
                    <a class="reload" href="javascript:;"> </a>
                    <a class="remove" href="javascript:;"> </a>
                </div>
                <div class="actions">
                    <?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'), array('class' => 'btn purple')); ?>"; ?>
                </div>                    
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1"> # </th>
                                <?php foreach ($fields as $field): ?>
                                <th class="col-md-2"> <?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
                                <?php endforeach; ?>
                                <th class="col-md-1 actions"> <?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
                        	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
                        	echo "\t<tr>\n";
                                //echo "\t\t<th>" . $counter++ . "</th>\n";
                                echo "\t\t<th></th>\n";
                        		foreach ($fields as $field) {
                        			$isKey = false;
                        			if (!empty($associations['belongsTo'])) {
                        				foreach ($associations['belongsTo'] as $alias => $details) {
                        					if ($field === $details['foreignKey']) {
                        						$isKey = true;
                        						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
                        						break;
                        					}
                        				}
                        			}
                        			if ($isKey !== true) {
                        				echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
                        			}
                        		}
                        
                        		echo "\t\t<th class=\"actions\">\n";
                        		echo "\t\t\t<?php echo \$this->Html->link(\$this->Html->tag('i', '', array('class' => 'fa fa-share')) . ' ' . __('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn default btn-xs green', 'escape' => false)); ?>\n";
                        		echo "\t\t\t<?php echo \$this->Html->link(\$this->Html->tag('i', '', array('class' => 'fa fa-edit')) . ' ' . __('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn default btn-xs blue', 'escape' => false)); ?>\n";
                        		echo "\t\t\t<?php echo \$this->Form->postLink(\$this->Html->tag('i', '', array('class' => 'fa fa-trash-o')) . ' ' . __('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn default btn-xs grey', 'escape' => false), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
                        		echo "\t\t</th>\n";
                        	echo "\t</tr>\n";
                        
                        	echo "<?php endforeach; ?>\n";
                        	?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="dataTables_info" id="sample_1_info">
                            <?php echo "<?php echo \$this->Paginator->counter(array(
                            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                            )); ?>"; ?>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="dataTables_paginate paging_bootstrap">
                            <ul class="pagination"><?php
                                echo "<?php\n
                                echo \$this -> Paginator -> prev(
                                            \$this->Html->tag('i', '', array('class' => 'fa fa-angle-left')), 
                                            array('escape' => false, 'tag' => 'li'), 
                                            \$this->Html->link(\$this->Html->tag('i', '', array('class' => 'fa fa-angle-left')), '#', array('escape' => false)), 
                                            array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));
                                            
                                echo \$this -> Paginator -> numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                                
                                echo \$this -> Paginator -> next(
                                            \$this->Html->tag('i', '', array('class' => 'fa fa-angle-right')), 
                                            array('escape' => false, 'tag' => 'li'), 
                                            \$this->Html->link(\$this->Html->tag('i', '', array('class' => 'fa fa-angle-right')), '#', array('escape' => false)), 
                                            array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));
                                ?>\n";
                            ?></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="actions">
	<h3><?php echo "<?php echo __('Actions'); ?>"; ?></h3>
	<ul>
		<li><?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add')); ?>"; ?></li>
<?php
	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "\t\t<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
				echo "\t\t<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
				$done[] = $details['controller'];
			}
		}
	}
?>
	</ul>
</div>
