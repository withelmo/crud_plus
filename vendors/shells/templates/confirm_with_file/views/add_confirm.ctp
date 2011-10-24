<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="<?php echo $pluralVar;?> form">
	<fieldset>
		<legend><?php printf("<?php __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></legend>
                <dl><?php echo "<?php \$i = 0; \$class = ' class=\"altrow\"';?>\n";?>
                <?php
		foreach ($fields as $field) {
			if (strpos($action, 'add_confirm') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                            echo "\t\t<dt<?php if (\$i % 2 == 0) echo \$class;?>><?php __('" . Inflector::humanize($field) . "'); ?></dt>\n";
                            echo "\t\t<dd<?php if (\$i++ % 2 == 0) echo \$class;?>>\n\t\t\t<?php echo \$data['{$modelClass}']['{$field}']; ?>\n\t\t\t&nbsp;\n\t\t</dd>\n";
			}
		}
?>
                
<?php 
                echo "\t\t<dt<?php if (\$i % 2 == 0) echo \$class;?>><?php __('File'); ?></dt>\n";
                echo "<?php \t\tif (!empty(\$data['{$modelClass}']['file'])) {\n";
                echo "       echo \$this->Label->image(\$data['{$modelClass}']['file'], array('target' => '_balank'));\n";
                echo "}?>";
?>                
                
<?php		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
?>
        </dl>
	</fieldset>
<?php echo "<?php echo \$this->Form->create('{$modelClass}');?>\n";?>
<?php echo "\t\t<?php echo \$this->Form->input('dummy',array('type' => 'hidden')); ?>\n"; ?>
<button type="button" onclick="location.href='<?php echo "<?php echo \$this->Html->url(array('action' => 'add'));?>"; ?>'">
    <?php echo "<?php echo __('Back');?>"; ?>
</button>
<?php
	echo "<?php echo \$this->Form->end(__('Submit', true));?>\n";
?>
</div>
<div class="actions">
	<h3><?php echo "<?php __('Actions'); ?>"; ?></h3>
	<ul>

<?php if (strpos($action, 'add') === false): ?>
		<li><?php echo "<?php echo \$this->Html->link(__('Delete', true), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, sprintf(__('Are you sure you want to delete # %s?', true), \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>";?></li>
<?php endif;?>
		<li><?php echo "<?php echo \$this->Html->link(__('List " . $pluralHumanName . "', true), array('action' => 'index'));?>";?></li>
<?php
		$done = array();
		foreach ($associations as $type => $data) {
			foreach ($data as $alias => $details) {
				if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
					echo "\t\t<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "', true), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
					echo "\t\t<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "', true), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
					$done[] = $details['controller'];
				}
			}
		}
?>
	</ul>
</div>