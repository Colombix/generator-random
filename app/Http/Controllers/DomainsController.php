<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;


class DomainsController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Domain::class, 'domains');
    }

    public function index()
    {


        $user = Auth::user();

        $extensions = Extension::all();

        $domains = Domain::with('extensions')->paginate(10);

        $extensions = $extensions->filter(function ($extension) use ($user) {
            return $user->can('view', $extension);
        });





        return view('domains.index', compact('domains', 'extensions'));
    }

}

