<?php namespace Diveramkt\CloudFlareCDN\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'cloudflarecdn_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}
