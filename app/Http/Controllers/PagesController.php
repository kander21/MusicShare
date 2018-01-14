<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome To Music Share';
        //return view('pages.index', compact('title'));
        return view('pages.index', compact('title'))->with('title', $title);
    }

    public function about() {
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function partners() {
        $spotify = new Partner('Sportify', 'https://open.spotify.com/browse/featured');
        $soundCloud = new Partner('Sound Cloud', 'https://soundcloud.com/');
        $appleMusic = new Partner('Apple Music', 'https://www.apple.com/music/');
        $data = array(
            'title' => 'Partners',
            'partners' => [$spotify, $soundCloud, $appleMusic]
        );
        
        return view('pages.services')->with($data);
    }
}

class Partner{
    public $partner;
    public $link;
    function __construct($partner, $link){
        $this->partner = $partner;
        $this->link = $link;
    }
}