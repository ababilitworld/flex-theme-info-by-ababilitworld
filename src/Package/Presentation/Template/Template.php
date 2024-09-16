<?php
namespace Ababilitworld\FlexThemeInfoByAbabilitworld\Package\Presentation\Template;

(defined('ABSPATH') && defined('WPINC')) || die();

use Ababilitworld\{
    FlexTraitByAbabilitworld\Standard\Standard,
    FlexThemeInfoByAbabilitworld\Package\Service\Service as Service,
    FlexThemeInfoByAbabilitworld\Package\Package as Package,
};

if (!class_exists(__NAMESPACE__.'\Template')) 
{
    class Template 
    {
        use Standard;
        private $template_url;
        private $asset_url;

        public function __construct() 
        {
            $this->asset_url = $this->get_url('Asset/');
            Service::instance();
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts' ) );
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts' ) );
        }

        public function enqueue_scripts()
        {
            if (!wp_style_is('flex-theme-info-by-ababilitworld-template-style', 'enqueued')) 
            {
                wp_enqueue_style(
                    'flex-theme-info-by-ababilitworld-template-style', 
                    $this->asset_url.'css/style.css',
                    array(), 
                    time()
                );
            }

            if (!wp_script_is('flex-theme-info-by-ababilitworld-template-script', 'enqueued')) 
            {
                wp_enqueue_script(
                    'flex-theme-info-by-ababilitworld-template-script', 
                    $this->asset_url.'js/script.js',
                    array(), 
                    time(), 
                    true
                );
            }
        }

        public static function default_template(array $data) 
        {
            if (isset(Service::$current_theme) && is_object(Service::$current_theme)) 
            {
                $theme_info = Service::$current_theme;

                // Output theme information in table format
                ?>
                <div class="theme-info-container">
                    <table class="theme-info-table">
                        <tr>
                            <th><?php esc_html_e('Theme Name', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('Name')); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('Theme Description', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('Description')); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('Version', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('Version')); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('Author', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('Author')); ?></td>
                        </tr>
                        <?php if (!empty($theme_info->get('AuthorURI'))): ?>
                        <tr>
                            <th><?php esc_html_e('Author URI', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><a href="<?php echo esc_url($theme_info->get('AuthorURI')); ?>" target="_blank"><?php echo esc_html($theme_info->get('AuthorURI')); ?></a></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?php esc_html_e('Theme URI', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('ThemeURI')); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('Tags', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html(implode(', ', $theme_info->get('Tags'))); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('Text Domain', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('TextDomain')); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('License', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('License')); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('License URI', 'flex-theme-info-by-ababilitworld'); ?></th>
                            <td><?php echo esc_html($theme_info->get('LicenseURI')); ?></td>
                        </tr>
                    </table>
                </div>
                <?php
            }
        }

    }
}