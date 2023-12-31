<?php

namespace App\Jobs;

use App\Models\Domain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;


class GenerateRandomDomain implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {

    }

    public function handle()
    {

        $headers = [
            'authority' => 'feldarkrealms.com',
            'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'accept-language' => 'fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7',
        ];

        $randomLength = rand(3, 8);

        $data = [
            'lang' => 'English',
            'words' => '10',
            'length' => $randomLength,
        ];


        $response = Http::withHeaders($headers)->asForm()->post('https://feldarkrealms.com/src/words.php', $data);

        $content = $response->body();

        $pattern = '/<div class="col-3 mb-3">([^<]+)<\/div>/';
        preg_match_all($pattern, $content, $matches);

        $generatedWords = $matches[1];


        foreach ($generatedWords as $generatedWord) {
            $domain = Domain::create(
                ['name' => $generatedWord]
            );

            CheckDomainAvailability::dispatch($domain);
        }
    }
}
