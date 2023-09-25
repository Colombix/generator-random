<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <ul>
                            @can('viewAny')
                            @foreach ($domains as $domain)
                                {{ $domain->name . " $domainsFr->extension : " . $domain->domains()->where('domain_id', $domainsFr->getKey())->first()->pivot->status }}

                                {{ $domain->name . " $domainsCom->extension : " . $domain->domains()->where('domain_id', $domainsCom->getKey())->first()->pivot->status }}
                                <br>
                            @endforeach
                            @endcan
                        </ul>
                        {{ $words->links() }}
                        <ul>
                        </ul>
                        <br>
                        <br>
                        <a href="{{ route('dashboard') }}">Return Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
