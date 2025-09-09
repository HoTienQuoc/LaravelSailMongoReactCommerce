<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;

class AdminController extends Controller
{
    /**
     * Fetch and display today yesterday this month this year orders
     */
    public function index()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $yesterday = Carbon::yesterday();
        $now = Carbon::now();

        // Today's orders (from start of today to start of tomorrow)
        $todayOrders = Order::where('created_at', '>=', $today)
            ->where('created_at', '<', $tomorrow)
            ->get();

        // Yesterday's orders (from start of yesterday to start of today)
        $yesterdayOrders = Order::where('created_at', '>=', $yesterday)
            ->where('created_at', '<', $today)
            ->get();

        // This month's orders
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $monthOrders = Order::where('created_at', '>=', $startOfMonth)
            ->where('created_at', '<=', $endOfMonth)
            ->get();

        // This year's orders
        $startOfYear = $now->copy()->startOfYear();
        $endOfYear = $now->copy()->endOfYear();
        $yearOrders = Order::where('created_at', '>=', $startOfYear)
            ->where('created_at', '<=', $endOfYear)
            ->get();

        return view('admin.index')->with([
            'todayOrders' => $todayOrders,
            'yesterdayOrders' => $yesterdayOrders,
            'monthOrders' => $monthOrders,
            'yearOrders' => $yearOrders,
        ]);
    }


    /**
     * Display the login form
     */
    public function login()
    {
        if (!auth()->guard('admin')->check()) {
            return view('admin.login');
        }
        return redirect()->route('admin.index');
    }

    /**
     * Auth the admin
     */
    public function auth(AuthAdminRequest $request)
    {
        if ($request->validated()) {
            if (
                auth()->guard('admin')->attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ])
            ) {
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('admin.login')->with([
                    'error' => 'These credentials do not match our records'
                ]);
            }
        }
    }

    /**
     * Logout the admin
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.index');
    }

}
