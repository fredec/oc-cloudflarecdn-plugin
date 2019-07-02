<?php namespace Diveramkt\Cloudflarecdn;

use System\Classes\PluginBase;
use DiveraMkt\CloudFlareCDN\Models\Settings;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'CloudFlare CDN',
                'description' => 'Manage the CloudFlare CD integration',
                'category'    => 'DiveraMkt',
                'icon'        => 'icon-cloud',
                'class'       => 'DiveraMkt\CloudFlareCDN\Models\Settings',
                'order'       => 500,
                'keywords'    => 'cloudflare cloud cdn media scripts images',
                'permissions' => ['cloudflarecdn.manage_cloudflarecdn']
            ]
        ];
    }

    /**
     * Returns plain PHP functions.
     *
     * @return array
     */
    private function getPhpFunctions()
    {
        return [
            'mediacdn' => function ($string) {
            	if (Settings::instance()->enabled == true && Settings::instance()->local_url != $_SERVER['HTTP_HOST'] && Settings::instance()->media_url != '') {
	            	$search = [$_SERVER['HTTP_HOST']];
	                return str_replace($search, Settings::instance()->media_url, $string);
	            } else
	            	return $string;
            },
            'scriptscdn' => function ($string) {
            	if (Settings::instance()->enabled == true && Settings::instance()->local_url != $_SERVER['HTTP_HOST'] && Settings::instance()->scripts_url != '') {
	            	$search = [$_SERVER['HTTP_HOST']];
	                return str_replace($search, Settings::instance()->scripts_url, $string);
	            } else
	            	return $string;
            },
            'csscdn' => function ($string) {
            	if (Settings::instance()->enabled == true && Settings::instance()->local_url != $_SERVER['HTTP_HOST'] && Settings::instance()->css_url != '') {
	            	$search = [$_SERVER['HTTP_HOST']];
	                return str_replace($search, Settings::instance()->css_url, $string);
	            } else
	            	return $string;
            },
        ];
    }

    /**
     * Add Twig extensions.
     *
     * @see Text extensions http://twig.sensiolabs.org/doc/extensions/text.html
     * @see Intl extensions http://twig.sensiolabs.org/doc/extensions/intl.html
     * @see Array extension http://twig.sensiolabs.org/doc/extensions/array.html
     * @see Time extension http://twig.sensiolabs.org/doc/extensions/date.html
     *
     * @return array
     */
    public function registerMarkupTags()
    {
        $filters = [];
        // add PHP functions
        $filters += $this->getPhpFunctions();

        return [
            'filters'   => $filters,
        ];
    }
}
