<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('purchases.product')
            ->where('role', 'user')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        $topProduct = Product::select('id', 'title', 'image_route')
            ->withCount('purchases')
            ->orderByDesc('purchases_count')
            ->first();

        $topMonth = Purchase::selectRaw("DATE_FORMAT(purchased_at, '%Y-%m') as ym, SUM(products.price)/100 as amount")
            ->join('products', 'purchases.product_id_fk', '=', 'products.id')
            ->groupBy('ym')
            ->orderByDesc('amount')
            ->first();

        $totalRevenue = Purchase::join('products', 'purchases.product_id_fk', '=', 'products.id')
            ->sum(DB::raw('products.price')) / 100;

        $ordersCount = Purchase::count();

        $topMonthLabel = $topMonth
            ? Carbon::createFromFormat('Y-m', $topMonth->ym)->translatedFormat('F Y')
            : null;

        return view('admin.index', [
            'users' => $users,
            'topProduct' => $topProduct,
            'topMonth' => $topMonth,
            'topMonthLabel' => $topMonthLabel,
            'totalRevenue' => $totalRevenue,
            'ordersCount' => $ordersCount,
        ]);
    }
}
