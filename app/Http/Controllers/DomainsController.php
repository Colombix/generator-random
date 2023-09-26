<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Domain;


class DomainsController extends Controller
{
    public function index()
    {
//        $domains = Domain::paginate(10);
//        //@TODO: where com / where fr a bannir + 1 seule requête
//        $extensionCom = Extension::where('extension', 'com')->first();
//        $extensionFr = Extension::where('extension', 'fr')->first();

        $domains = Domain::query()
            ->with('extensions' )
            ->paginate(10);

        return view('domains.index', compact('domains'));
    }

    public function __construct()
    {
        $this->authorizeResource(Domain::class, 'domains');
    }
}

