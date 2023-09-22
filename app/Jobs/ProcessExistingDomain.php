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

class ProcessExistingDomain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {

    }

    public function handle(): void
    {
        $whoisClient = new SimpleWhoisClient();
        $dataLoader = new JsonLoader(base_path('/vendor/helgesverre/domain-availability/src/data/servers.json'));

        $service = new DomainAvailability($whoisClient, $dataLoader);

        $extensionfr = Domain::where('extension', 'fr')->first();
        $extensioncom = Domain::where('extension', 'com')->first();

        foreach (Word::all() as $word) {

            if ($word->domains()->where('status', 'waiting')->exists()) {
                $this->setStatus($service, $word, $extensioncom);
                $this->setStatus($service, $word, $extensionfr);
            }
        }
    }

    private function setStatus(DomainAvailability $service, Word $word, Domain $domain)
    {
        $status = 'failed';
        $fullDomainName = $word->name . ".$domain->extension";

        if ($service->isAvailable($fullDomainName)) {

            $status = 'success';
        }
        $word->save();
        $domain->words()->updateExistingPivot($word, [
            'status' => $status
        ]);
    }
}


