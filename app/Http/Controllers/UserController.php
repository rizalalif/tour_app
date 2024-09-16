<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HolidayPackage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        
        $pakets = HolidayPackage::with('category')->get();
        $categories = Category::all();
        return view('welcome', compact('pakets', 'categories'));
    }

    public function packageByCategory(Category $category)
    {
        $packages = $category->packages;
        return view('package', compact('packages'));
    }
    public function allPackages()
    {
        $packages = HolidayPackage::where('status', 'active')->get();
        return view('package', compact('packages'));
    }
    public function packageById(HolidayPackage $package)
    {

        $duration = (int) $package->duration;
        $today = Carbon::today();
        $endYear = Carbon::createFromDate($today->year, 12, 31);;
        $diff = (int)$today->diffInDays($endYear);

        $listDates = [];

        for ($i = 0; $i < $diff; $i++) {
            $deparature = $today->copy()->addDays($i);
            $end = $deparature->copy()->addDays($duration)->format('j F Y');

            // dd($deparature)
            $listDates[] = $deparature->format('j F Y') . ' - ' . $end;
        }

        return view('package.detail-package', compact('package', 'listDates'));
    }
}
