<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function indexWithTrucks()
    {
        $trucks = Truck::simplePaginate(25);
        return view('levels.level1', ['trucks' => $trucks]);
    }


    public function truck1()
    {
        $reports = Report::all();
        return view('dropdown.truck1', compact('reports'));
    }

    public function truck2()
    {
        $reports = Report::all();
        return view('dropdown.truck2', compact('reports'));
    }

    public function truck3()
    {
        $reports = Report::all();
        return view('dropdown.truck3', compact('reports'));
    }

    public function truck4()
    {
        $reports = Report::all();
        return view('dropdown.truck4', compact('reports'));
    }

    public function truck5()
    {
        $reports = Report::all();
        return view('dropdown.truck5', compact('reports'));
    }
}



