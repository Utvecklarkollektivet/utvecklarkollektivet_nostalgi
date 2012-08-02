<?php
/**
 * Implements Acl on menu items.
 */
class MenuComponent extends Component {

	/**
	 * Import components
	 */
	public $components = array('Auth', 'Acl');

	/**
	 * Generate menu from array.
	 *
	 * The $menuArray should be an array of the form:
	 *	array(
	 *		'link text' => array(
	 *			'link' => '/link_location/',
	 *			'access' => 'controllers/check_access|true if always access',
	 *			'submenu' => '(optional) array of the same type as this'
	 *		),
	 *		'Next link text' => [...]
	 *
	 * @parem array
	 * @return array This array can be used in the MenuHelper
	 */
	public function generateMenu($menuArray) {

		$menu = array();
		$user = array('model' => 'User', 'foreign_key' => $this->Auth->User('id'));

		foreach ($menuArray as $item => $options) {

			if ($options['access'] === true ||
				$this->Acl->check($user, $options['access'])) {
				
				$submenu = array();
				if (!isset($options['submenu'])) {
					$options['submenu'] = array();
				}

				foreach ($options['submenu'] as $subItem => $subOptions) {
					if ($subOptions['access'] === true ||
						$this->Acl->check($user, $subOptions['access'])) {
						
						$submenu[$subItem] = $subOptions;
					}
				}
			
				$menu[$item] = $options;
				$menu[$item]['submenu'] = $submenu;
			}
		}
		return $menu;
	}

}

?>
