<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css">
</head>
<body class="bg-gray-100">
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-4 px-6">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            Nom de domain
        </h2>
    </div>
</header>

<main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div>
                    <table class="table-auto w-full border">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 border">Mot</th>
                            @foreach($extensions as $extension)
                                <th class="px-4 py-2 border">{{$extension->extension}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>

                        </a>
                        @foreach ($domains as $domain)
                            <tr>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('domains.show', ['domain' => $domain->id]) }}">
                                        {{ $domain->name }}
                                    </a>

                                </td>
                                @foreach ($extensions as $extension)
                                    <td class="px-4 py-2 border">
                                        {{ $domain->extensions()->where('extension',$extension->extension)->first()?->pivot->is_available}}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $domains->links() }}
                    <br>
                    <br>
                    <a href="{{ route('dashboard') }}" class="text-blue-500">Retour au tableau de bord</a>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
