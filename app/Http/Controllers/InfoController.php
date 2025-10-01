<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function index()
    {
        $thisYear = 2026;

        $daftarr = DB::table('Registration')
            ->select('Reg_No')
            ->where([['Reg_Type','1'],['Period',$thisYear],['Grade','200'],])
            ->count();

        return [
            'daftarr' => $daftarr
        ];
    }
}
