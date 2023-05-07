<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index() {
        $data = Item::whereNull("parent")->with('items')->get();
        return view('test.index', compact('data'));
    }
}
