<?php

namespace App\Http\Controllers;

use DB;
use App\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    /**
     * @var
     */
    protected $auth;

    /**
     *
     */
    function __construct()
    {
        $this->auth = Auth::guard(null)->user();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'goal_price' => 'required|numeric',
            'image_name' => 'required|image',
            'story' => 'required',
            'deadline' => 'required|date',
        ]);

        $data = $request->all();
        $data['user_id'] = $this->auth->id;

        DB::beginTransaction();

        $campaign = Campaign::create($data);

        print_r($campaign->toArray());

        DB::rollBack();
echo ' 1 ';exit;
        DB::commit();

//        print_r($request->all());exit;
        dd($request->all());
    }
}
