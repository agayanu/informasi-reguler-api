<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class InfoController extends Controller
{
    public function index($key)
    {
        if($key === 'aga123') {
            $thisYear  = 2026;
            $y2020view = 2025;
            $y2019view = 2024;
            $today     = now()->format('Y-m-d');
            $yest      = now()->subdays(1)->format('Y-m-d');
            $y2020     = now()->subYears(1)->format('Y-m-d');
            $y2019     = now()->subYears(2)->format('Y-m-d');
    
            $daftarr = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Grade','200']])
                ->count();
            $daftarrnow = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Grade','200'],['Reg_Date',$today]])
                ->count();
            $daftarryest = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Grade','200'],['Reg_Date',$yest]])
                ->count();
            $daftarr20 = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2020view],['Grade','200'],['Reg_Date','<=',$y2020],])
                ->count();
            $daftarr20now = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2020view],['Grade','200'],['Reg_Date','=',$y2020],])
                ->count();
            $daftarr19 = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2019view],['Grade','200'],['Reg_Date','<=',$y2019],])
                ->count();
            $daftarr19now = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2019view],['Grade','200'],['Reg_Date','=',$y2019],])
                ->count();
            $bayarr = DB::table('Registration as a')
                ->leftJoin('Registration_Cancel as b', 'a.Reg_No','=','b.Reg_No')
                ->where([['a.Reg_Type','1'],['a.Period',$thisYear],['a.Grade','200'],])
                ->where(function (Builder $query) {
                    $query->where('a.Status','3')
                        ->orWhere('a.Status','9');
                })
                ->whereNull('b.TransDate')
                ->count();
            $bayarrnow = DB::table('Registration')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Grade','200'],])
                ->where(function (Builder $query) {
                    $query->where('Status','3')
                        ->orWhere('Status','9');
                })
                ->whereDate('Register_Date', $today)
                ->count();
            $bayarryest = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Grade','200'],])
                ->where(function (Builder $query) {
                    $query->where('Status','3')
                        ->orWhere('Status','9');
                })
                ->whereDate('Register_Date', $yest)
                ->count();
            $bayarr20 = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2020view],['Status','9'],['Grade','200'],])
                ->whereDate('Register_Date', '<=', $y2020)
                ->count();
            $bayarr20now = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2020view],['Status','9'],['Grade','200'],])
                ->whereDate('Register_Date', '=', $y2020)
                ->count();
            $bayarr19 = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2019view],['Status','9'],['Grade','200'],])
                ->whereDate('Register_Date', '<=', $y2019)
                ->count();
            $bayarr19now = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$y2019view],['Status','9'],['Grade','200'],])
                ->whereDate('Register_Date', '=', $y2019)
                ->count();
            $mundurr = DB::table('Registration_Cancel')
                ->select('Reg_No')
                ->where([['Period',$thisYear],['Grade','200'],])
                ->count();
            $mundurrnow = DB::table('Registration_Cancel')
                ->select('Reg_No')
                ->where([['Period',$thisYear],['Grade','200'],])
                ->whereDate('TransDate', $today)
                ->count();
            $mundurr20 = DB::table('Registration_Cancel')
                ->select('Reg_No')
                ->where([['Period',$y2020view],['Grade','200'],])
                ->whereDate('TransDate', '<=',$y2020)
                ->count();
            $mundurr20now = DB::table('Registration_Cancel')
                ->select('Reg_No')
                ->where([['Period',$y2020view],['Grade','200'],])
                ->whereDate('TransDate', '=',$y2020)
                ->count();
            $mundurr19 = DB::table('Registration_Cancel')
                ->select('Reg_No')
                ->where([['Period',$y2019view],['Grade','200'],])
                ->whereDate('TransDate', '<=',$y2019)
                ->count();
            $mundurr19now = DB::table('Registration_Cancel')
                ->select('Reg_No')
                ->where([['Period',$y2019view],['Grade','200'],])
                ->whereDate('TransDate', '=',$y2019)
                ->count();
    
            return [
                'daftarr' => $daftarr,
                'daftarrnow' => $daftarrnow,
                'daftarryest' => $daftarryest,
                'daftarr20' => $daftarr20,
                'daftarr20now' => $daftarr20now,
                'daftarr19' => $daftarr19,
                'daftarr19now' => $daftarr19now,
                'bayarr' => $bayarr,
                'bayarrnow' => $bayarrnow,
                'bayarryest' => $bayarryest,
                'bayarr20' => $bayarr20,
                'bayarr20now' => $bayarr20now,
                'bayarr19' => $bayarr19,
                'bayarr19now' => $bayarr19now,
                'mundurr' => $mundurr,
                'mundurrnow' => $mundurrnow,
                'mundurr20' => $mundurr20,
                'mundurr20now' => $mundurr20now,
                'mundurr19' => $mundurr19,
                'mundurr19now' => $mundurr19now,
            ];
        }
    }
}
