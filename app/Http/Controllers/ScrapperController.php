<?php

namespace App\Http\Controllers;

use App\Models\Scrapper;
use App\Http\Requests\StoreScrapperRequest;
use App\Http\Requests\UpdateScrapperRequest;
use Symfony\Component\DomCrawler\Crawler;


class ScrapperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $html = <<<'HTML'
        <!DOCTYPE html>
        <html>
            <body>
                <p class="message">Hello World!</p>
                <p>Hello Crawler!</p>
            </body>
        </html>
        HTML;

        $crawler = new Crawler($html);
        
        foreach ($crawler as $domElement) {
            var_dump($domElement->nodeName);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScrapperRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScrapperRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scrapper  $scrapper
     * @return \Illuminate\Http\Response
     */
    public function show(Scrapper $scrapper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scrapper  $scrapper
     * @return \Illuminate\Http\Response
     */
    public function edit(Scrapper $scrapper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScrapperRequest  $request
     * @param  \App\Models\Scrapper  $scrapper
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScrapperRequest $request, Scrapper $scrapper)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scrapper  $scrapper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scrapper $scrapper)
    {
        //
    }
}
