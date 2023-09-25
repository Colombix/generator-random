<?php

namespace App\Jobs;

use App\Models\Extension;
use App\Models\Domain;
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

    public function __construct(protected Domain $word)
    {

        $whoisClient = new SimpleWhoisClient();
        $dataLoader = new JsonLoader(base_path('/vendor/helgesverre/domain-availability/src/data/servers.json'));

        $this->domainAvailability = new DomainAvailability($whoisClient, $dataLoader);
    }

    public function handle(): void
    {
        foreach (Extension::cursor() as $domain) {
            $this->processAvailability($this->word, $domain);
        }

    }

    // @TODO: rename --> setStatus
    private function processAvailability(Domain $word, Extension $domain)
    {

        $fullDomainName = "$word->name.$domain->extension";

        //@TODO: is available --> boolean nullable
        $domain->words()->updateExistingPivot($word, [
            'is_available' => $this->domainAvailability->isAvailable($fullDomainName)
        ]);

    }
}


