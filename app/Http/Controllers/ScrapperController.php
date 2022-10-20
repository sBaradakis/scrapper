<?php

namespace App\Http\Controllers;

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;



class ScrapperController extends Controller
{

    public function get($endpoint, $headers=[]){

        $client = new Client();


        try {
            $request = [];
            if(count($headers)){
                $request['headers'] = $headers;
            }
            
            $response = $client->request(
                'GET',
                $endpoint,
                $request
            );

            
            return json_decode( $response->getBody()->getContents() );
        } catch (ClientException $exception) {
            dd($exception);
            $response = $exception->getResponse();
            return json_decode($response->getBody()->getContents());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $headers = [
            "accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "cookie" => "_hjSessionUser_1667696=eyJpZCI6IjQ1NDdhNjg1LTFhNDQtNTdjZS1iMDZlLTViNmYxMGIxY2E2OCIsImNyZWF0ZWQiOjE2NDk4NDY5MzQwMzQsImV4aXN0aW5nIjp0cnVlfQ==; policy_level=%7B%22essential%22%3A%22true%22%2C%22performance%22%3A%22true%22%2C%22preference%22%3A%22true%22%2C%22targeting%22%3A%22true%22%7D; _hjSessionUser_1468002=eyJpZCI6IjMyYzViMWE5LTdkYTItNTg4MS04ZWJkLTRhZGJjNDIyN2QwNyIsImNyZWF0ZWQiOjE2NTE4MjgwMTI2MzcsImV4aXN0aW5nIjp0cnVlfQ==; _hjMinimizedPolls=783131%2C704479%2C807685%2C811598; _ga_YRR29R577F=GS1.1.1655197405.1.1.1655197431.0; analytics_session=e2cfe662-90f6-4aaf-b1ba-c072ee067072; __skr_nltcs_ss=%7B%22version%22%3A1%2C%22session%22%3A%22e2cfe662-90f6-4aaf-b1ba-c072ee067072%22%7D; logged_in=true; _hjDonePolls=844912; _ga_EJ59BQVN25=GS1.1.1664360207.2.0.1664360207.0.0.0; _gid=GA1.2.1519853033.1666171092; _gcl_au=1.2.307271412.1666171092; _hjCachedUserAttributes=eyJhdHRyaWJ1dGVzIjp7IkNvdW50cnkiOiJHUiIsIklzQ3lwcnVzIjpmYWxzZSwiSXNHcmVlY2UiOnRydWUsIlNrcm91dHogUGx1cyI6ZmFsc2UsIlNrcm91dHogU3RhZmYiOmZhbHNlLCJVc2VyIFJlc2VhcmNoIjoiIn0sInVzZXJJZCI6ImNlNjJlN2E5ZTZkMTlkMmI3MTRhN2FhZWMyMDZkZDkzMGMyZDRkYjgifQ==; _ga=GA1.1.1306579349.1649846934; _ga_RXGTX5SZLT=GS1.1.1666253857.18.1.1666253877.0.0.0; _ga_52FPR8RB02=GS1.1.1666253857.2.1.1666253877.0.0.0; _helmet_couch=YJ9Cg%2Bblz0kt9zxXVxsL%2FZa1CPsGSCBSdhM3iEqYUZHyqD1MV33g2ZXxOKbEqr1Lc%2BcWaj8XSpiV5eghXm%2FBkjTosee0Tjzt6sR6KVH8PCkfl4e43vhOXg932n%2B5Qt%2B8qMt0NfiuI8OspReEJivzQvAblK%2FYRffjls1XEeqTQmqqghlYpcY%2F2LSKFH4TWkN0k8y5NY2zD0OwLs%2F%2FvcTAkDqqYME9VyYSMrDd4bLDNwQf0SOyC42lS2FBr3Q7wPIzSjoXanoJ%2Fg0GgJTOWSeFQXGVVgOF9N7Ihq2%2B1zr8TFOytjJz54GAMIupMzZVhm9K17kXRhPDo3a5zASVl%2Fb3HaCXhdBstgcH%2FQpjdhFJbi%2Bp9g0qSbHoqLr3VX6MYWQ37NGFa2nW%2BhxYQZq7YXzEtSHkVpWQ7T7OtTVW7MCFbCSRAymdtnKbQm1Ab5q0fZutDZmR3L0eHQxX07e3yPU2kPu%2BZOw7rs0mxDs9fl2r2v4NjdWH88XaRpWUbO50zJ9yEFFFkjDHDKiSNrPHi5UsNKWG5VBlVAK8C1j%2BjOYGPsQzT9SGXhV4DBJvD0I%2F%2B6BGIs7X6DtzeLfy8dXm7roEQ%2FKc5c3nB5rLRD40p5pKFQ%2F7yaOiN5EDfyVn2I9xnNxb5th7PgN4Ln3xITuyEh%2B69hs%2BPR5DlM40lwjKmi6kTbgBGdKHzAFdEaDhX4ydcm4XnuRwFydCDcXl2%2FelbSMtnBFVqa2LZZYPg12rjL0MVoENGQNQwTxKanBmhcUn8jTBVYd3WPZYxM5mx%2BGYkp87sm666xGhh%2BCvzIi3bHnSRSRU0GJX8dOcQOnS2TDIfjjKAKoI--EpUIHlbedK82EB5p--lcqYEudo32ffiI8z8X079w%3D%3D; __cf_bm=_tw5n3zc880SXAqzRuqyWUXmlNQwOoyvZ0s3xioVoSg-1666262487-0-AdkIxnBRSPzq2PFypbGsf1OFQ9uFmFmox8P85mAtfgoq5gPSbmTXWxP56z+NhQ5Q5ZdPlc+KHX4KW8Q9+TXakZA=; data_follow_products=%7B%22slo%22%3A%22popularity%22%2C%22keyphrase%22%3A%22i%20phone%2014%20pro%22%7D; data_follow_ecommerce_cart=%7B%22slo%22%3A%22popularity%22%7D; data_follow_skus=%7B%22slo%22%3A%22popularity%22%2C%22keyphrase%22%3A%22i%20phone%2014%20pro%22%7D"
        ];
    
        $url = 'https://www.skroutz.gr/s/38112472/Apple-iPhone-14-Pro-5G-6GB-256GB-Deep-Purple.html?from=featured&product_id=129261865';

        dd($this->get($url, $headers));
        
        
        // $content = $response->getBody()->getContents();
        // $crawler = new Crawler($content);


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
