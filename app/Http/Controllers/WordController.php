<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Word;
use Illuminate\Http\Request;


// wordcontroller rajoute du " s "
class WordController extends Controller
{
    public function index()
    {
        // naming domainsCom , domainsFr

        $words = Word::paginate(10);
        $domains_com = Domain::where('extension','com')->first();
        $domains_fr = Domain::where('extension','fr')->first();

        return view('word.index', compact('words', 'domains_fr','domains_com'));
    }

    public function __construct() {
        $this->authorizeResource(Word::class, 'word');
    }
}

