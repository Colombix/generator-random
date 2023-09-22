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
                            @foreach ($words as $word)
                                <li>{{ $word->name }}</li>
                            @endforeach
                        </ul>
                        {{ $words->links() }}
                        <br>
                        <br>
                        <ul>
                            @can('viewAny')
                                @foreach ($words as $word)
                                    {{ $word->name . " $domains_fr->extension : " . $word->domains()->where('domain_id', $domains_fr->getKey())->first()->pivot->status }}
                                    {{ $word->name . " $domains_com->extension : " . $word->domains()->where('domain_id', $domains_com->getKey())->first()->pivot->status }}
                                @endforeach
                            @endcan
                        </ul>
                        <br>
                        <br>
                        <ul>
{{--                            @can('viewAny', \App\Models\Domain::class)--}}
{{--                                @foreach($domains_com as $domain)--}}
{{--                                    {{$word->domains->pivot->status}}--}}
{{--                                @endforeach--}}
{{--                            @endcan()--}}
{{--                            {{ $domains_com->links() }}--}}

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
