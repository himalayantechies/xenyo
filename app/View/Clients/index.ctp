<?php 
/* BEGIN PAGE LEVEL PLUGINS */
/* END PAGE LEVEL PLUGINS */
?>
<div class="row clients index">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-cogs"></i><?php echo __('Clients'); ?></div>
                <div class="tools">
                    <a class="collapse" href="javascript:;"> </a>
                    <a class="config" data-toggle="modal" href="#portlet-config"> </a>
                </div>
                <div class="actions">
                    <?php echo $this->Html->link(__('New Client'), array('action' => 'add'), array('class' => 'btn purple')); ?>
                </div>                    
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1"> <?php echo $this->Paginator->sort('id'); ?></th>
                                <th class="col-md-5"> <?php echo $this->Paginator->sort('name'); ?></th>
                                <th class="col-md-2"> <?php echo $this->Paginator->sort('created'); ?></th>
                                <th class="col-md-2"> <?php echo $this->Paginator->sort('updated'); ?></th>
                                <th class="col-md-2 actions"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($clients as $client): ?>
							<tr>
								<td><?php echo h($client['Client']['id']); ?>&nbsp;</td>
								<td><?php echo h($client['Client']['name']); ?>&nbsp;</td>
								<td><?php echo h($client['Client']['created']); ?>&nbsp;</td>
								<td><?php echo h($client['Client']['updated']); ?>&nbsp;</td>
								<th class="actions">
									<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-share')) . ' ' . __('View'), array('action' => 'view', $client['Client']['id']), array('class' => 'btn default btn-xs green', 'escape' => false)); ?>
									<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')) . ' ' . __('Edit'), array('action' => 'edit', $client['Client']['id']), array('class' => 'btn default btn-xs blue', 'escape' => false)); ?>
									<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')) . ' ' . __('Delete'), array('action' => 'delete', $client['Client']['id']), array('class' => 'btn default btn-xs grey', 'escape' => false), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?>
								</th>
							</tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="dataTables_info" id="sample_1_info">
                            <?php echo $this->Paginator->counter(array(
                            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                            )); ?>                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="dataTables_paginate paging_bootstrap">
                            <ul class="pagination"><?php
                            echo $this -> Paginator -> prev(
                                        $this->Html->tag('i', '', array('class' => 'fa fa-angle-left')), 
                                        array('escape' => false, 'tag' => 'li'), 
                                        $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-left')), '#', array('escape' => false)), 
                                        array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));
                                        
                            echo $this -> Paginator -> numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                            
                            echo $this -> Paginator -> next(
                                        $this->Html->tag('i', '', array('class' => 'fa fa-angle-right')), 
                                        array('escape' => false, 'tag' => 'li'), 
                                        $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-right')), '#', array('escape' => false)), 
                                        array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));
                            ?></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
