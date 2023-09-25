<?php

namespace App\Jobs;

use App\Models\Extension;
use App\Models\Domain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;



//@TODO: changer en unique job (until released)
class ProcessGenerateRandomDomain implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {

    }

    public function handle()
    {

        sleep(20);


        $headers = [
            'authority' => 'feldarkrealms.com',
            'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'accept-language' => 'fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7',
        ];

        $data = [
            'lang' => 'English',
            'words' => '10',
            'length' => '8',
        ];


        $response = Http::withHeaders($headers)->post('https://feldarkrealms.com/src/words.php', $data);

        $content = $response->body();


        $pattern = '/<div class="col-3 mb-3">([^<]+)<\/div>/';
        preg_match_all($pattern, $content, $matches);

        $generatedWords = $matches[1];

        //@TODO: foreach domains
//        $extensionfr = Extension::where('extension', 'fr')->first();
//        $extensioncom = Extension::where('extension', 'com')->first();

        $domains = Extension::all();

        $words = Domain::createMany(
            collect($generatedWords)
                ->map(function ($word) {
                    return ['name' => $word];
                })
        );

        foreach ($words as $word) {


           $word->domains()->attach($domains);


            //@TODO: process le job de take domain
            CheckDomainAvailability::dispatch($word);
        }


    }
}
