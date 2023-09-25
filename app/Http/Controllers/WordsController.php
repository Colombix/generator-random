<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Domain;
use Illuminate\Http\Request;


class WordsController extends Controller
{
    public function index()
    {
        // naming domainsCom , domainsFr

        $words = Domain::paginate(10);
        $domains_com = Extension::where('extension','com')->first();
        $domains_fr = Extension::where('extension','fr')->first();

        return view('word.index', compact('words', 'domains_fr','domains_com'));
    }

    public function __construct() {
        $this->authorizeResource(Domain::class, 'word');
    }
}

