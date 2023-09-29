<?php

namespace App\Jobs;

use App\Models\Extension;
use App\Models\Domain;
use Helge\Client\SimpleWhoisClient;
use Helge\Loader\JsonLoader;
use Helge\Service\DomainAvailability;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDomainAvailability implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected DomainAvailability $domainAvailability;

    public function __construct(protected Domain $domain)
    {

    }

    public function handle(): void
    {


        $whoisClient = new SimpleWhoisClient();
        $dataLoader = new JsonLoader(app_path('../vendor/helgesverre/domain-availability/src/data/servers.json'));


        $this->domainAvailability = new DomainAvailability($whoisClient, $dataLoader);


        foreach (Extension::query()->cursor() as $extension) {

            $this->checkDomainAvailabilityForExtension($this->domain, $extension);


        }
    }

    private function checkDomainAvailabilityForExtension(Domain $domain, Extension $extension)
    {

        $fullDomainName = "$domain->name.$extension->extension";


        $extension->domains()->attach($domain, ['is_available' => $this->domainAvailability->isAvailable($fullDomainName)]);
    }
}


