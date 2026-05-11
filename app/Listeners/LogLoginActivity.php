<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogLoginActivity
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Handle Successful Logins
     */
    public function handleLogin(Login $event) {
        DB::table('login_activities')->insert([
            'email'         => $event->user->email,
            'ip_address'    => $this->request->ip(),
            'user_agent'    => $this->request->userAgent(),
            'is_successful' => true,
            'guard'         => $event->guard ?? 'web',
            // Removed updated_at to match your database schema
            'created_at'    => Carbon::now('Asia/Kathmandu'),
        ]);
    }

    /**
     * Handle Failed Login Attempts
     */
    public function handleFailed(Failed $event) {
        DB::table('login_activities')->insert([
            'email'         => $event->credentials['email'] ?? 'unknown',
            'ip_address'    => $this->request->ip(),
            'user_agent'    => $this->request->userAgent(),
            'is_successful' => false,
            'guard'         => 'web',
            // Removed updated_at to match your database schema
            'created_at'    => Carbon::now('Asia/Kathmandu'),
        ]);
    }
}