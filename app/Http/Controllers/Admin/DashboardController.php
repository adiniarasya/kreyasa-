<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders  = Order::count();
        $activeOrders = Order::where('status', '!=', 'Bimbingan Selesai')->count();
        $revenue      = Order::sum('amount_paid');
        $inGuidance   = Order::where('status', 'Masa Bimbingan')->count();
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'activeOrders',
            'revenue',
            'inGuidance',
            'recentOrders'
        ));
    }
}