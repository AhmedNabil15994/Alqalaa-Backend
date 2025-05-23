<?php

namespace Modules\Core\Listeners;

use Illuminate\Console\Application;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModuleMaked
{
    protected $paths = [
        'controller' => 'Modules/::module/Http/Controllers/::folder/::moduleController.php',
        'request' => 'Modules/::module/Http/Requests/::folder/::moduleRequest.php',
        'repository' => 'Modules/::module/Repositories/::folder/::moduleRepository.php',
        'resource' => 'Modules/::module/Transformers/::folder/::moduleResource.php',
    ];

    protected $class_names = [
        'controller' => '::moduleController',
        'request' => '::moduleRequest',
        'repository' => '::moduleRepository',
        'resource' => '::moduleResource',
    ];

    protected $nameSpaces = [
        'controller' => 'Modules\::module\Http\Controllers\::folder',
        'request' => 'Modules\::module\Http\Requests\::folder',
        'repository' => 'Modules\::module\Repositories\::folder',
        'resource' => 'Modules\::module\Transformers\::folder',
    ];

    protected $routes = [
        'dashboard' => 'Modules/::module/Routes/dashboard/routes.php',
    ];

    protected $module;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return mixed
     */
    protected function getModuleName()
    {
        return $this->module;
    }

    /**
     * @param $name
     */
    protected function setModuleName($name)
    {
        $this->module = Str::ucfirst($name);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStubDir()
    {
        return base_path() . '/Modules/Core/stubs/dashboard';
    }

    /**
     * @param $name
     * @return string
     */
    protected function getStub($name)
    {
        return $this->getStubDir() . '/' . $name . '.stub';
    }

    /**
     * @param $folder
     * @param $file
     * @return string
     */
    protected function getNewPath($folder, $file)
    {
        $path = array_key_exists($file, $this->paths) ?
            base_path(Str::replace(['::module', '::folder'], [$this->module, $folder], $this->paths[$file])) : '';

        return $path;
    }

    /**
     * @param $folder
     * @param $file
     * @return string
     */
    protected function getNameSpace($folder, $file)
    {
        $nameSpace = array_key_exists($file, $this->nameSpaces) ?
            Str::replace(['::module', '::folder'], [$this->module, $folder], $this->nameSpaces[$file]) : '';

        return $nameSpace;
    }

    protected function getPaths($folder)
    {
        $paths = [];

        foreach ($this->paths as $file => $path) {
            $paths += [$file => $this->getNewPath($folder, $file)];
        }

        return $paths;
    }

    protected function getNameSpaces($folder)
    {
        $nameSpaces = [];

        foreach ($this->nameSpaces as $file => $nameSpace) {
            $nameSpaces += [$file => $this->getNameSpace($folder, $file)];
        }

        return $nameSpaces;
    }

    protected function getClassNames()
    {
        $classes = [];

        foreach ($this->class_names as $file => $class_name) {
            $classes += [$file => Str::replace('::module', $this->getModuleName(), $class_name)];
        }

        return $classes;
    }

    protected function getRoutesNames()
    {
        $routes = [];

        foreach ($this->routes as $folder => $path) {
            $routes += [$folder => Str::replace('::module', $this->getModuleName(), $path)];
        }

        return $routes;
    }

    protected function buildClass($folder, $nameSpace, $class)
    {
        $stub = File::get($this->getStub($folder));
        return Str::replace(['{{ namespace }}', '{{ class }}'], [$nameSpace, $class], $stub);
    }

    protected function buildRoute($folder, $controller, $route)
    {
        $stub = File::get($this->getStub($folder));
        return Str::replace(['{{ route }}', '{{ controller }}'], [$route, $controller], $stub);
    }

    private function run($name){
        $this->setModuleName($name);
        $paths = $this->getPaths('Dashboard');
        $namesPaces = $this->getNameSpaces('Dashboard');
        $classes = $this->getClassNames();
        $routes = $this->getRoutesNames();

        foreach ($paths as $key => $path) {
            $fileContent = $this->buildClass($key, $namesPaces[$key], $classes[$key]);
            File::put($path,$fileContent);
        }

        foreach ($routes as $folder => $path) {
            $fileContent = $this->buildRoute('routes',$classes['controller'],Str::plural(Str::lower($this->getModuleName())));
            File::put($path,$fileContent);
        }

    }

    /**
     * @param CommandFinished $event
     */
    public function handle(CommandFinished $event)
    {
        $command = $event->command;

        if($command == 'module:make'){
            $moduleName = $event->input->getArgument('name')[0];
            $this->run($moduleName);
        }
    }
}
