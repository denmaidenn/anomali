<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fish;
use App\Models\Product;
use App\Models\Training;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page');

        switch($page) {
            case 'users.index':
                $results = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->get();
                break;

            case 'dashboard':
                // Sesuaikan dengan data yang ingin dicari di dashboard
                $results = [];
                break;

            case 'fishpedia.index':
                $results = Fish::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('scientific_name', 'LIKE', "%{$query}%")
                    ->orWhere('category', 'LIKE', "%{$query}%")
                    ->get();
                break;

            case 'fishmart.index':
                $results = Product::where('nama_produk', 'LIKE', "%{$query}%")
                    ->orWhere('deskripsi_produk', 'LIKE', "%{$query}%")
                    ->get();
                break;

            case 'training.index':
                $results = Training::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();
                break;

            default:
                $results = [];
        }

        return response()->json($results);
    }
}
