<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Visitor;
use App\Services\VisitorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LinkController extends Controller
{
    public function __construct(VisitorService $visitor)
    {
        $this->visitor = $visitor;
    }

    /**
     * Variable to hold information about the visitor.
     *
     * @var \App\Services\VisitorService
     */
    private $visitor;


    private const SORT = 'created_at';
    private const ORDER = 'desc';

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['string', 'filled'],
            'sort' => ['string', 'in:created_at,address,destination'],
            'order' => ['string', 'in:desc,asc'],
        ]);

        $sort = $request['sort'] ?? self::SORT;
        $order = $request['order'] ?? self::ORDER;

        $links = Link::where('user_id', Auth::id());
                     
        if ($request->filled('search')) {
            $links->whereLike(['ending', 'destination'], $request['search']);
        }

        return Inertia::render('Links/Index', [
            'filters' => $request->all('search', 'sort', 'order'),
            'links' => $links->orderBy($sort, $order)
                             ->paginate(20)
                             ->withQueryString()
        ]);
    }

    /**
     * Redirect a visitor to the real link.
     *
     * @param $ending
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($ending)
    {
        $link = Link::where('ending', $ending)
                    ->firstOrFail();

        Visitor::create([
            "link_id" => $link->id,
            "ip" => $this->visitor->ip(),
            "country" => $this->visitor->country(),
            "browser" => $this->visitor->browser(),
            "referer" => $this->visitor->referer(),
            "platform" => $this->visitor->platform()
        ]);

        return redirect()
             ->away($link->destination);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'destination' => ['string', 'required'],
            'description' => ['nullable', 'string', 'max:512']
        ]);

        Link::create([
            'user_id' => Auth::id(),
            'ending' => str_random(8),
            'destination' => $request['destination'],
            'description' => $request['description']
        ]);

        return redirect()->back()->with('success', 'Link created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Link $link
     * @return \Inertia\Response
     */
    public function show(Link $link)
    {
        $metrics = collect([
            "country",
            "browser",
            "referer",
            "platform",
        ])->mapWithKeys(function ($item) use ($link) {
            return [$item => $link->metrics($item)];
        });

        $metrics['click'] = $link->metrics('created_at', true);
        $link['metrics'] = $metrics;

        return Inertia::render('Links/Show', compact(["link"]));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Link $link)
    {
        $link->update(
            $request->validate([
                'destination' => ['string', 'required'],
                'description' => ['string', 'max:512']
            ])
        );

        return redirect()->back()->with('success', 'Link updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->back()->with('success', 'Link deleted.');
    }
}
