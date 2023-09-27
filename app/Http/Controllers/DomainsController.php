<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Domain;


class DomainsController extends Controller
{
    public function index()
    {

        $extensions = Extension::all();

        $domains = Domain::query()
            ->with('extensions' )
            ->paginate(10);

        return view('domains.index', compact('domains','extensions'));
    }

    public function __construct()
    {
        $this->authorizeResource(Domain::class, 'domains');
    }
}

