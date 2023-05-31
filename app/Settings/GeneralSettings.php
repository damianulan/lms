<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;
    public ?string $site_logo;
    public string $theme;
    public bool $debug;
    public string $locale;
    public string $timezone;
    public int $build;
    public string $release;

    public static function group(): string
    {
        return 'general';
    }
}