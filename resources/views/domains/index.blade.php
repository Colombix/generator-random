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

{{--                                    {{ $domain->name . " $extensionFr->extension : " . $domain->extensions()->where('extension_id', $extensionFr->getKey())->first()->pivot->is_available }}--}}


                                    {{ $domain->name . "  " . $domain->extensions()->first()->pivot->is_available }}
                                    <br>
                                @endforeach
                            @endcan
                        </ul>
                        {{ $domains->links() }}
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
