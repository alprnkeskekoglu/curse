<?php

namespace Curse\Providers;

use Curse\App\Curse;
use Illuminate\Support\ServiceProvider;

class CurseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $file = $this->app['files']->files(__DIR__ . '/../Config/app.php');
        $filename = $this->getConfigBasename($file);
        $this->mergeConfig($file, $filename);

        $this->app->bind('Curse', function () {
            return new Curse();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { }


    private function getConfigBasename($file)
    {
        $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($file));

        $filename = $name;

        return $filename;
    }

    protected function mergeConfig($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        foreach (require $path as $k => $v) {
            $config[$k] = array_merge($config[$k], $v);
        }
        $this->app['config']->set($key, $config);
    }
}
