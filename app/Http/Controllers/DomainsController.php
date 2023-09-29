<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;


class DomainsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->authorizeResource(Domain::class, 'domains');
    }

    public function index()
    {

        $user = Auth::user();

        $extensions = Extension::when($user->canAny(['view extensions', 'view public extensions']), function ($query) use ($user) {
            if ($user->can('view extensions')) {
                return $query;
            } elseif ($user->can('view public extensions')) {


                return $query->where('is_private', false);
            } else {
                return $query->limit(0);
            }
        })->get();

        $domains = Domain::with(['extensions' => function ($query) use ($user) {
            if ($user->can('view extensions')) {

                return $query;
            } elseif ($user->can('view public extensions')) {
                return $query->where('is_private', false);
            } else {
                return $query->limit(0);
            }

        }])->paginate(10);

        return view('domains.index', compact('domains', 'extensions'));
    }



    public function show (){


        $this->authorize('view own extensions');

        return view('domains.show');

    }
}

