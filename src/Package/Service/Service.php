<?php

namespace Ababilitworld\FlexThemeInfoByAbabilitworld\Package\Service;

(defined( 'ABSPATH' ) && defined( 'WPINC' )) || die();

use Ababilitworld\{
    FlexTraitByAbabilitworld\Standard\Standard,
    FlexThemeInfoByAbabilitworld\Package\Presentation\Template\Template as ThemeInfoTemplate,
};

if (!class_exists(__NAMESPACE__.'\Service')) 
{
    class Service
    {
        use Standard;
        public static $current_theme;

        /**
         * Constructor.
         */
        public function __construct()
        {
            self::$current_theme = wp_get_theme();
        }
    }		
}