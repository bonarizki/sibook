<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Detail;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $tables = Table::with('Order')->get();
        $categories = Category::with('Menu')->get();
        return view('user.index',compact('tables','categories'));
    }

    public function detailTable(Table $table)
    {
        return response()->json(["status" => "message", "data" => $table]);
    }

    public function booking(Request $request)
    {
        DB::transaction(function () use($request) {
            $order = Order::create([
                "table_id" => $request->table_id,
                "seats" => $request->seats,
                "hours" => $request->hours,
                "booking_code" => "WTSH". Str::random(10),
                "user_id" => Auth::user()->id,
            ]);

            $detail = $this->makeArrayDetail($request,$order->id);
            Detail::insert($detail);
        });

        return back()->with('order','Order Success! ');
    }

    public function makeArrayDetail($request,$order_id)
    {
        $array = [];
        for ($i=0; $i < count($request->menu_id); $i++) { 
            $array[] = [
                "menu_id" => $request->menu_id[$i],
                "qty" => $request->qty_menu[$i],
                "order_id" => $order_id,
            ];
        }

        return $array;
    }
}
