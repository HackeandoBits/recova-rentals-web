<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = public_path('sitemap.xml');

        $baseUrl = config('app.url');

        $sitemap = \Spatie\Sitemap\Tags\Url::create($baseUrl)
            ->add(\Spatie\Sitemap\Tags\Url::create($baseUrl . '/'))
            ->add(\Spatie\Sitemap\Tags\Url::create($baseUrl . '/products'))
            ->add(\Spatie\Sitemap\Tags\Url::create($baseUrl . '/gallery'))
            ->add(\Spatie\Sitemap\Tags\Url::create($baseUrl . '/location'))
            ->add(\Spatie\Sitemap\Tags\Url::create($baseUrl . '/about'));

        $sitemap->writeToFile($path);

        $this->info("Sitemap generated at: {$path}");
    }
}
