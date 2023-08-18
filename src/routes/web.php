<?php

use Illuminate\Support\Facades\Route;
use ikepu_tp\ShorterUrl\app\Http\Controllers\AccessController;
use ikepu_tp\ShorterUrl\app\Http\Controllers\AssetController;
use ikepu_tp\ShorterUrl\app\Http\Controllers\LinkController;

/**
 * Web Routing
 */
Route::middleware("web")->group(function () {
    Route::group([
        "middleware" => "auth:" . config("shorter-url.guard", "web"),
        "prefix" => config("shorter-url.prefix_web", "shorter-url"),
    ], function () {
        Route::resource("/", LinkController::class)->parameter("", "link")->names("short-url.link");
        Route::get("/{link}/access", [AccessController::class, "index"])->name("short-url.link.access.index");
    });
    Route::prefix(config("shorter-url.prefix_short-url", "sl"))->get("/{link?}", [AccessController::class, "access"])->name("short-url.redirect");
});
/**
 * CSS, JS
 */
Route::prefix(config("shorter-url.prefix_web", "shorter-url"))->get("/assets/{file}", [AssetController::class, "asset"])->name("shorter-url.asset");
