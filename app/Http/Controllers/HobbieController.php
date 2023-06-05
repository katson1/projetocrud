<?php

namespace App\Http\Controllers;

use App\Models\Hobbie;
use Illuminate\Http\Request;

class HobbieController extends Controller
{
    public function index()
    {
        $hobbies = Hobbie::all();
        return view('hobbies.index', compact('hobbies'));
    }

    public function show(Hobbie $hobbie)
    {
        return view('hobbies.show', compact('hobbie'));
    }
}
