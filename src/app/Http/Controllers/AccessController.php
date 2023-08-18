<?php

namespace ikepu_tp\ShorterUrl\app\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use ikepu_tp\ShorterUrl\app\Models\Access;
use ikepu_tp\ShorterUrl\app\Models\Link;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Link $link)
    {
        $devices = array_column($link->accesses()->select('device')->distinct('device')->get()->toArray(), "device");
        $devices_total = [];
        foreach ($devices as $device) {
            $devices_total[$device] = $link->accesses()->where('device', $device)->count();
        }
        $referers = array_column($link->accesses()->select('referer')->distinct('referer')->get()->toArray(), "referer");;
        $referers_total = [];
        foreach ($referers as $referer) {
            $referers_total[$referer] = $link->accesses()->where('referer', $referer)->count();
        }
        return view("ShorterUrl::link.access", [
            "link" => $link,
            "summary" => [
                "total" => $link->accesses()->count(),
                "devices" => $devices_total,
                "referers" => $referers_total,
            ]
        ]);
    }

    /**
     * リダイレクトメソッド
     *
     * @param Request $request
     * @param Link $link
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function access(Request $request, Link $link)
    {
        if (!$link->id) abort(404);
        $agent = new Agent();
        $fill = [
            "link_id" => $link->id,
        ];
        $fill['referer'] = $request->query("referer", "");
        $fill["ip"] = $request->ip();
        $fill["user_agent"] = $request->userAgent();
        $fill["device"] = $agent->device();
        $fill["browser"] = $agent->browser();
        $access = new Access();
        $access->fill($fill);
        if (!$access->save()) throw new Exception("リダイレクトできません");
        return redirect($link->link);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Access $access)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Access $access)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Access $access)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Access $access)
    {
        //
    }
}
