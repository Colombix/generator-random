<?php

namespace App\Jobs;

use App\Models\Domain;
use App\Models\Word;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;


// Changer le naming ProcessGeneraterandomDomain

//@TODO: changer en unique job (until released)
class ProcessGenerateWord implements ShouldQueue, ShouldBeUnique
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

// @TODO: naming pas bon
        //@TODO: generatedWords
        $wordArray = $matches[1];

        // ameliorer le naming exemple : domainFr , domainCom

        //@TODO: foreach domains
//        $extensionfr = Domain::where('extension', 'fr')->first();
//        $extensioncom = Domain::where('extension', 'com')->first();

        $domains = Domain::all();

        $words = Word::createMany(
            collect($wordArray)
                ->map(function ($word) {
                    return ['name' => $word];
                })
        );

        foreach ($words as $word) {


//           $word = Word::create(['name' => $word]);
           $word->domains()->attach($domains);

//            $extensioncom->words()->attach($word, [
//                'status' => 'waiting'
//            ]);
//            $extensionfr->words()->attach($word, [
//                'status' => 'waiting'
//            ]);

            //@TODO: process le job de take domain
            CheckDomainAvailability::dispatch($word);
        }


    }
}
