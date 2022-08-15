<?php

namespace AniketIN\Settings\Commands;

use AniketIN\Settings\Facades\Settings;
use AniketIN\Settings\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class SettingsCommand extends Command
{
    public $signature = 'settings:load-file';

    public $description = 'Load settings from file, this command is not overriding db values.';

    public function handle(): int
    {
        $settings = Arr::dot(require config_path('settings.php'));
        foreach ($settings as $key => $value) {
            Setting::firstOrCreate([
                'key' => $key,
            ], [
                'value' => $value,
            ]);
        }

        Settings::refreshCache();

        $this->info('Setting file has been loaded successfully.');

        return self::SUCCESS;
    }
}
