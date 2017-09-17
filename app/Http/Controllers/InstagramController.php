<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InstagramController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public static $username = "cristiano";

    public static $limit = 6;

    public function index(Request $request)
    {
        $items = [];

        $client = new \GuzzleHttp\Client;
        $url = sprintf('https://www.instagram.com/%s/media', $this->username);
        $response = $client->get($url);
        $items = json_decode((string) $response->getBody(), true)['items'];


        foreach($items as $item) {
            echo '<img src="'.$item['images']['thumbnail']['url'].'" style="width: 120px; height: auto; float: left" >';
        }
    }
    public static function getInstaImages()
    {
        $client = new \GuzzleHttp\Client;
        $url = sprintf('https://www.instagram.com/%s/media', self::$username);
        $response = $client->get($url);
        $items = json_decode((string) $response->getBody(), true)['items'];
        $images = [];
        $increment = 0;
        foreach($items as $item) {
            if($increment == self::$limit) {
                break;
            }
            $increment++;
            $images[]  = $item['images']['thumbnail']['url'];
        }
        return $images;
    }
}