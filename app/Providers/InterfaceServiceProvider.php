<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class InterfaceServiceProvider extends ServiceProvider
{
    CONST APPLICATION_NAMESPACE = 'App';
    CONST INTERFACE_NAMESPACE = 'Interfaces';
    CONST REPOSITORY_NAMESPACE = 'Repositories';

    /**
     * Register any interfaces and repositories.
     *
     * @return void
     */
    public function register()
    {
        $interfaces = $this->generateListForDirectory(self::INTERFACE_NAMESPACE, 'Interface.php');
        $repositories = $this->generateListForDirectory(self::REPOSITORY_NAMESPACE, 'Repository.php');

        // Create bindings ONLY if we have a matching repository for our interface
        foreach ($interfaces as $interface) {
            $repository_key = array_search($interface, $repositories, true);

            if ($repository_key !== false) {
                $interface_ns = sprintf('%s\%s%sInterface', self::APPLICATION_NAMESPACE, self::INTERFACE_NAMESPACE, $interface);
                $repository_ns = sprintf('%s\%s%sRepository', self::APPLICATION_NAMESPACE, self::REPOSITORY_NAMESPACE, $repositories[$repository_key]);

                $this->app->bind($interface_ns, $repository_ns);
            }
        }
    }

    /**
     * @param $directory
     * @param string $file_suffix
     * @param array $ignored_files
     * @return array
     */
    private function generateListForDirectory($directory, $file_suffix = '.php', $ignored_files = [])
    {
        $discovered_files = [];
        $file_list = Storage::disk('local')->allFiles($directory);

        foreach ($file_list as $file) {
            if (!in_array($file, $ignored_files)) {
                $cleaned_name = str_replace('/', '\\', $file);
                $cleaned_name = str_replace($file_suffix, '', $cleaned_name);
                $cleaned_name = str_replace($directory, '', $cleaned_name);
                array_push($discovered_files, $cleaned_name);
            }
        }

        return $discovered_files;
    }
}