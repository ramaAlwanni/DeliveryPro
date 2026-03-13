<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';
    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class in app/Services';


    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path('Services');
        $filePath = "{$path}/{$name}.php";

        $content = $this->buildClass($name);

        $this->files->put($filePath, $content);

        $this->info("Service Class '{$name}' created successfully in app/Services.");
        return 0;
    }

    /**
     * بناء محتوى كلاس الخدمة الافتراضي.
     */
    protected function buildClass($name)
    {
        $stub = <<<EOT
        <?php

        namespace App\Services;

        class $name
        {

        }
        EOT;
        return $stub;
    }
}
