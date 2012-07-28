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
    public function generate($menuArray) {
        $html = '<ul>';
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
}

?>
