<?php
/**
 * This helper creates a menu from MenuComponent::generateMenu() array.
 */
class MenuHelper extends AppHelper {

	/**
	 * Generate the menu in html.
	 *
	 * @param array $menuArray Array from MenuComponent::generateMenu()
	 * @return string
	 */
	public function generate($menuArray, $class = null) {
		if($class == null)
			$html = '<ul>';
		else
			$html = '<ul class="' . $class . '">';
		
		foreach ($menuArray as $item => $options) {
			$html .= sprintf('<li><a href="%s">%s</a>', $options['link'], $item);

			if (isset($options['submenu']) && is_array($options['submenu'])) {
				$html .= '<ul>';
				foreach ($options['submenu'] as $subItem => $subOptions) {
					$html .= sprintf(
						'<li><a href="%s">%s</a></li>', 
						$subOptions['link'], 
						$subItem
					);
				}
				$html .= '</ul>';
			}
			$html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}
	
	
	public function generateMain($menuArray) {
		
		$html = '<ul id="menu" class="nav nav-pills menu">';
		
		foreach ($menuArray as $item => $options) {
			if(isset($options['hasSubmenu']) && $options['hasSubmenu'])
				$html .= sprintf('<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="%s">%s</a>', $options['link'], $item);
			else
				$html .= sprintf('<li><a href="%s">%s</a>', $options['link'], $item);

			if( isset($options['hasSubmenu']) && $options['hasSubmenu']) {
				$html .= '<ul class="dropdown-menu submenu">';
				foreach ($options['submenu'] as $subItem => $subOptions) {
					$html .= sprintf(
						'<li><a href="%s">%s</a></li>', 
						$subOptions['link'], 
						$subItem
					);
				}
				$html .= '</ul>';
			}
			$html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}
}

?>
