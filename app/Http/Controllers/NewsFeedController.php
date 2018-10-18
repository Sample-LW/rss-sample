<?php
namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Feed;

class NewsFeedController extends Controller
{


    /**
     * Show the application layout
     *
     * @return \Illuminate\Http\Response
     */
    public function newsFeed()
    {
        $feeds = Feed::all()->pluck('url', 'id');

        return view('news-feed')->with('feeds', $feeds);
    }


    /**
     * Get Ajax Request and restun Data
     * TODO error handler
     *
     * @return \Illuminate\Http\Response
     */
    public function newsFeedAjax($id)
    {
        $feed = Feed::find($id);
        $xml = "";
        if (!empty($feed)) {
            $xml = $feed->url;
        }
        $HTMLNewsFeed = '';

        $xmlDoc = new \DOMDocument();
        $xmlDoc->load($xml);

        // get elements from "<channel>"
        $channel = $xmlDoc->getElementsByTagName('channel')->item(0);
        $channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
        $channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
        $channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

        //output elements from "<channel>"
        $HTMLNewsFeed .= "<p><a href='" . $channel_link
          . "'>" . $channel_title . "</a>";
        $HTMLNewsFeed .= "<br>";
        $HTMLNewsFeed .= $channel_desc . "</p>";

        // get and output "<item>" elements
        $x = $xmlDoc->getElementsByTagName('item');
        for ($i=0; $i<=2; $i++) {
            $item_title = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
            $item_link = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
            $item_desc = $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

            $HTMLNewsFeed .= "<p><a href='" . $item_link . "'>" . $item_title . "</a>";
            $HTMLNewsFeed .= "<br>";
            $HTMLNewsFeed .= $item_desc . "</p>";
        }

        return $HTMLNewsFeed; 
    }

}
