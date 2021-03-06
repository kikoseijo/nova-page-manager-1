<?php

namespace OptimistDigital\NovaPageManager;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaPageManager extends Tool
{
    private static $templates = [];
    private static $locales = [];

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-page-manager', __DIR__ . '/../dist/js/page-manager-tool.js');
        Nova::style('nova-page-manager', __DIR__ . '/../dist/css/page-manager-tool.css');

        Nova::script('nova-locale-parent-field', __DIR__ . '/../dist/js/locale-parent-field.js');
        Nova::style('nova-locale-parent-field', __DIR__ . '/../dist/css/locale-parent-field.css');

        Nova::script('nova-locale-field', __DIR__ . '/../dist/js/locale-field.js');
        Nova::style('nova-locale-field', __DIR__ . '/../dist/css/locale-field.css');

        Nova::script('nova-template-field', __DIR__ . '/../dist/js/template-field.js');
        Nova::style('nova-template-field', __DIR__ . '/../dist/css/template-field.css');

        Nova::script('nova-parent-field', __DIR__ . '/../dist/js/parent-field.js');
        Nova::style('nova-parent-field', __DIR__ . '/../dist/css/parent-field.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-page-manager::navigation');
    }

    public static function configure(array $data = [])
    {
        self::$templates = $data['templates'] ?: [];
        self::$locales = $data['locales'] ?: ['en_US' => 'English'];
    }

    public static function getTemplates(): array
    {
        return array_filter(self::$templates, function ($template) {
            return class_exists($template);
        });
    }

    public static function getLocales(): array
    {
        return self::$locales;
    }
}
