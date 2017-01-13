<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function create()
    {
        return view('campaigns.create');
    }
}
