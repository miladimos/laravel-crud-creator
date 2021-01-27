<?php namespace Miladimos\CrudCreator\Traits;

use InvalidArgumentException;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;


trait validateModel
{

    protected function ensureControllerDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getControllerNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
    }

    protected function ensureApiControllerDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getApiControllerDefaultNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
    }

    protected function ensureApiResourceDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getApiResourceDefaultNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
    }

    protected function ensureRequestDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getRequestDefaultNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
    }


    public function createRequest()
    {
        if (!is_dir($directory = app_path('Http/Controllers/Request'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem;

        collect($filesystem->allFiles(__DIR__ . '/../stubs/Auth'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Auth/' . Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });
    }

    public function createResource()
    {
        if (!is_dir($directory = app_path('Http/Controllers/Resource'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem;

        collect($filesystem->allFiles(__DIR__ . '/../stubs/Auth'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Auth/' . Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });
    }

}
