<?php
/**
 * Controller bake template file
 *
 * Allows templating of Controllers generated from bake.
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
 * @subpackage    cake.
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

echo "<?php\n";
?>
class <?php echo $controllerName; ?>Controller extends <?php echo $plugin; ?>AppController {

	var $name = '<?php echo $controllerName; ?>';
<?php if ($isScaffold): ?>
	var $scaffold;
<?php else: ?>
<?php
if (count($helpers)):
	echo "\tvar \$helpers = array(";
	for ($i = 0, $len = count($helpers); $i < $len; $i++):
		if ($i != $len - 1):
			echo "'" . Inflector::camelize($helpers[$i]) . "', ";
		else:
			echo "'" . Inflector::camelize($helpers[$i]) . "'";
		endif;
	endfor;
        
        if (!in_array('Filebinder.Label', $helpers)){
            echo "'Filebinder.Label'";
        }
        
	echo ");\n";
        
        else:
            echo "\tvar \$helpers = array('Filebinder.Label');\n\n";
            
endif;

if (count($components)):
	echo "\tvar \$components = array(";
	for ($i = 0, $len = count($components); $i < $len; $i++):
		if ($i != $len - 1):
			echo "'" . Inflector::camelize($components[$i]) . "', ";
		else:
			echo "'" . Inflector::camelize($components[$i]) . "'";
		endif;
	endfor;
        
        if (!in_array('Filebinder.Ring', $components)) {
            echo "'Filebinder.Ring'";
        }
        
        if (!in_array('Transition', $components)) {
            echo "'Transition'";
        }
        
	echo ");\n";
        else:
            echo "\tvar \$components = array('Filebinder.Ring',\n\t\t'Transition');\n\n";
endif;

echo $actions;

endif; ?>

}
