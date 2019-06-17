<?php

namespace App\Http\Controllers\Xhr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Tightenco\Collect\Support\Collection;
use Rodenastyle\StreamParser\StreamParser;

class UploadController extends Controller
{
    public function xml()
    {
        // $file = File::get(public_path().'\xml\7FAB34B1-9749-482C-B034-2EAEA13BE2C7.xml');
        StreamParser::xml(public_path().'\xml\7FAB34B1-9749-482C-B034-2EAEA13BE2C7.xml')->each(function (Collection $xml) {
            dump($xml);

            // dump($xml->get('cfdi:Receptor')->toArray());
        });
    }
}
