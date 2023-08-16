<?php

namespace ikepu_tp\ShorterUrl\app\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ikepu_tp\ShorterUrl\app\Http\Requests\StoreRequest;
use ikepu_tp\ShorterUrl\app\Http\Requests\UpdateRequest;
use ikepu_tp\ShorterUrl\app\Models\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view("ShorterUrl::link.index", [
            "links" => Link::where('user_id', $request->user()->id)
                ->withCount("accesses")
                ->paginate(30),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $linkOk = true;
        $linkIds = $this->getLinkIds();
        $linkId = "";
        while ($linkOk) {
            $linkId = Str::random(10);
            $linkOk = !$this->checkLinkId($linkId, $linkIds);
        }
        return view("ShorterUrl::link.store", [
            "edit" => false,
            "link" => [
                "linkId" => $linkId,
                "name" => "",
                "link" => "",
            ]
        ]);
    }

    public function checkLinkId(string $linkId, array $linkIds = null): bool
    {
        if (is_null($linkIds)) $linkIds = $this->getLinkIds();
        return !in_array($linkId, $linkIds);
    }

    function getLinkIds(): array
    {
        return  array_column(Link::select("linkId")->get()->toArray(), "linkId");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $link = new Link();
        $link->fill($storeRequest->validated());
        $link->forceFill(["user_id" => $storeRequest->user()->id]);
        if (!$link->save()) throw new Exception("リンクの登録に失敗しました");
        return redirect(route("link.index"))->with("message", "リンクを登録しました");
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        return view("ShorterUrl::link.store", [
            "edit" => true,
            "link" => $link->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, Link $link)
    {
        $link->fill($updateRequest->validated());
        if (!$link->save()) throw new Exception("リンクの変更に失敗しました");
        return redirect(route("link.index"))->with("message", "リンクを変更しました");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }
}
