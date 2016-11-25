<?php

namespace App\Http\Controllers;

class AuthBaseController extends Controller
{
    /**
     * Redirect paths of guards
     *
     * @var array
     */
    private $guard_auth_redirect = [
        'web' => [
            'url_segment' => null,
        ],
        'admin' => [
            'url_segment' => 'backend',
        ],
    ];

    /**
     * Create a new authentication controller instance.
     * Make sure the url.intended is valid for current segment
     *
     * E.g.
     *     Assuming that you are logged out.
     *     When you visit '/backend/admin-only', the url.intended is set to '/backend/admin-only'
     *     Then you visit '/login' (the guard of this will be 'web'), so the code below will remove the url.intended in the session because the current url intended is for the guard 'admin'
     *
     * @return void
     */
    public function __construct($guard = null)
    {
        $url_intended = session()->get('url.intended');

        // If url_intended is not set return early
        if (! $url_intended) {
            return;
        }

        // Get intended url segments
        $url_intended = str_replace(url('/'), '', $url_intended);
        $url_intended = trim($url_intended, '/');
        $url_intended_segments = explode('/', $url_intended);

        // Make sure the first url segment is set
        if (! isset($url_intended_segments[0])) {
            $url_intended_segments[0] = '';
        }

        // If guard is null, auto set guard to the default defined in auth config
        if (! $guard) {
            $guard = config('auth.defaults.guard');
        }

        // Get the guard segment
        $guard_url_segment = $this->guard_auth_redirect[$guard]['url_segment'];

        // Get all unique segments of auth
        // Don't include null segments
        $all_url_segments = array_pluck($this->guard_auth_redirect, 'url_segment');
        $all_url_segments = array_unique($all_url_segments);
        $all_url_segments = array_where($all_url_segments, function ($key, $value) {
            return ! is_null($value);
        });

        // If guard url segment is null and the url_intended is a segment for other auth guard
        // Remove the url.intended in session
        if (is_null($guard_url_segment) && in_array($url_intended_segments[0], $all_url_segments)) {
            session()->forget('url.intended');
        }
        // If guard url segment is null, this is already good return early
        elseif (is_null($guard_url_segment)) {
            return;
        }

        // If the guard url segment is not equal to url intended
        // Remove url.intended in session
        if ($guard_url_segment != $url_intended_segments[0]) {
            session()->forget('url.intended');
        }
    }
}
