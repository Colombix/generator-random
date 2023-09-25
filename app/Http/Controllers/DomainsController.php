<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Domain;


class DomainsController extends Controller
{
    public function index()
    {

        $domains = Extension::paginate(10);
        $domainsCom = Extension::where('extension','com')->first();
        $domainsFr = Extension::where('extension','fr')->first();

        return view('word.index', compact('domains', 'domainsFr','domainsCom'));
    }

    public function __construct() {
        $this->authorizeResource(Domain::class, 'word');
    }
}

