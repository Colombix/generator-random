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
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th>Mot</th>
                                <th>Status</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach ($domains as $domain)
                                <tr>
                                    <td>{{ $domain->name }} </td>


                                    <td> - {{ "  " . $domain->extensions()->where('extension','fr')->first()->pivot->is_available }}</td>
                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                        {{ $domains->links() }}
                        <br>
                        <br>
                        <a href="{{ route('dashboard') }}">Return Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



