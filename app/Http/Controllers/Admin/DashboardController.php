<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'revenue' => (int) Order::where('status', '!=', 'cancelled')->sum('total'),
            'orderCount' => Order::count(),
            'productCount' => Product::count(),
            'unread' => Inquiry::where('is_read', false)->count(),
            'recentOrders' => Order::latest()->take(6)->get(),
            'lowStock' => Product::where('stock', '<=', 5)->orderBy('stock')->take(5)->get(),
            'customerCount' => User::where('role', 'customer')->count(),
        ]);
    }
}
