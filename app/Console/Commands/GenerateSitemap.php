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

        $sitemap = \Spatie\Sitemap\Sitemap::create()
            ->add(\Spatie\Sitemap\Tags\Url::create('https://recovarentals.com.ar/'))
            ->add(\Spatie\Sitemap\Tags\Url::create('https://recovarentals.com.ar/products'))
            ->add(\Spatie\Sitemap\Tags\Url::create('https://recovarentals.com.ar/gallery'))
            ->add(\Spatie\Sitemap\Tags\Url::create('https://recovarentals.com.ar/location'))
            ->add(\Spatie\Sitemap\Tags\Url::create('https://recovarentals.com.ar/about'));

        $sitemap->writeToFile($path);

        $this->info("Sitemap generated at: {$path}");
    }
}
