<?php
$admin_path = TEMPLATEPATH . '/admin/';
$includes_path = TEMPLATEPATH . '/includes/';

//Redirect admin to theme option upon activated
require_once $admin_path . 'admin-setup.php';

//Theme Options
require_once $admin_path . 'admin-options.php';

//Theme init
require_once $includes_path . 'theme-init.php';

//Widget and Sidebar
require_once $includes_path . 'sidebar-init.php';

require_once $includes_path . 'register-widgets.php';

//Additional function
require_once $includes_path . 'theme-function.php';

//Additional function
require_once $includes_path . 'shortcode.php';

//Additional function
require_once $includes_path . 'property-init.php';

//Built-in Plugin
require_once $includes_path . 'ts-display/ts-display.php';
require_once $includes_path . 'ts-thinkbox/ts-thinkbox.php';

//Loading jQuery
require_once $includes_path . 'theme-scripts.php';
?>
