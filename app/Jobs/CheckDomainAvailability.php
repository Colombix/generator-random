<?php

namespace App\Jobs;

use App\Models\Domain;
use App\Models\Word;
use Helge\Client\SimpleWhoisClient;
use Helge\Loader\JsonLoader;
use Helge\Service\DomainAvailability;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psy\Util\Str;





//@TODO: domain availability
class CheckDomainAvailability implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected DomainAvailability $domainAvailability;

    public function __construct(protected Word $word)
    {

        $whoisClient = new SimpleWhoisClient();
        $dataLoader = new JsonLoader(base_path('/vendor/helgesverre/domain-availability/src/data/servers.json'));

        $this->domainAvailability = new DomainAvailability($whoisClient, $dataLoader);
    }

    public function handle(): void
    {

//        $extensionfr = Domain::where('extension', 'fr')->first();
//        $extensioncom = Domain::where('extension', 'com')->first();
//
//        // séparer word::all pour reduire le nombre de rêquete avec le if
//
//        foreach (Word::all() as $word) {
//
//            if ($word->domains()->where('status', 'waiting')->exists()) {
//                $this->setStatus($service, $word, $extensioncom);
//                $this->setStatus($service, $word, $extensionfr);
//            }
//        }

        foreach (Domain::cursor() as $domain) {
            $this->processAvailability($this->word, $domain);
        }

    }

    // @TODO: rename --> setStatus
    private function processAvailability(Word $word, Domain $domain)
    {
//        $status = 'failed';
//        $fullDomainName = $word->name . ".$domain->extension";
//
//        if ($service->isAvailable($fullDomainName)) {
//
//            $status = 'success';
//        }
//        $word->save();
//        $domain->words()->updateExistingPivot($word, [
//            'status' => $status
//        ]);

        $fullDomainName = "$word->name.$domain->extension";

        //@TODO: is available --> boolean nullable
        $domain->words()->updateExistingPivot($word, [
            'is_available' => $this->domainAvailability->isAvailable($fullDomainName)
        ]);

    }
}


