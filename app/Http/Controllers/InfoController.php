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
            $d1        = now()->subDays(1)->format('Y-m-d');
            $d2        = now()->subDays(2)->format('Y-m-d');
            $d3        = now()->subDays(3)->format('Y-m-d');
            $dafuldate = '2026-06-01';
    
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
            $siswar = DB::table('Master_Student')
                ->select('Reg_No')
                ->where([['Levels',10],['Grade','200'],])
                ->count();
            $kas = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$thisYear],['a.Trans_Type','C'],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $tf = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$thisYear],['a.Trans_Type','B'],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $kasnow = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$thisYear],['a.Trans_Type','C'],['a.Trans_Date',$today],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $tfnow = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$thisYear],['a.Trans_Type','B'],['a.Trans_Date',$today],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $kas20 = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2020view],['a.Trans_Type','C'],['a.Trans_Date','<=',$y2020],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $tf20 = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2020view],['a.Trans_Type','B'],['a.Trans_Date','<=',$y2020],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $kas20now = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2020view],['a.Trans_Type','C'],['a.Trans_Date','=',$y2020],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $tf20now = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2020view],['a.Trans_Type','B'],['a.Trans_Date','=',$y2020],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $kas19 = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2019view],['a.Trans_Type','C'],['a.Trans_Date','<=',$y2019],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $tf19 = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2019view],['a.Trans_Type','B'],['a.Trans_Date','<=',$y2019],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $kas19now = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2019view],['a.Trans_Type','C'],['a.Trans_Date','=',$y2019],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $tf19now = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$y2019view],['a.Trans_Type','B'],['a.Trans_Date','=',$y2019],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $lunas = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$thisYear],['a.Balance_Amount','0.00'],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $cicil = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([
                    ['b.Period',$thisYear],
                    ['a.Balance_Amount','!=','0.00'],
                ])
                ->whereNotIn('a.ID_No', function ($query) use ($thisYear){
                    $query->select('c.ID_No')
                        ->from('Costs as c')
                        ->join('Costs_Control as d', 'c.Reg_No','=','d.Reg_No')
                        ->where([
                            ['d.Period',$thisYear],
                            ['c.Balance_Amount','=','0.00'],
                        ])
                        ->groupBy('c.ID_No','c.Grade','c.Major','d.Period');
                })
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->get();
            $lunasnow = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([['b.Period',$thisYear],['a.Balance_Amount','0.00'],['a.Trans_Date',$today],])
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $cicilnow = DB::table('Costs as a')
                ->join('Costs_Control as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.ID_No')
                ->where([
                    ['b.Period',$thisYear],
                    ['a.Balance_Amount','!=','0.00'],
                    ['a.Trans_Date',$today],
                ])
                ->whereNotIn('a.ID_No', function ($query) use ($today,$thisYear){
                    $query->select('c.ID_No')
                        ->from('Costs as c')
                        ->join('Costs_Control as d', 'c.Reg_No','=','d.Reg_No')
                        ->where([
                            ['d.Period',$thisYear],
                            ['c.Balance_Amount','=','0.00'],
                            ['c.Trans_Date',$today],
                        ])
                        ->groupBy('c.ID_No','c.Grade','c.Major','d.Period');
                })
                ->groupBy('a.ID_No','a.Grade','a.Major','b.Period')
                ->count();
            $diterima = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Status','2'],['Grade','200'],])
                ->count();
            $diterimanow = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Status','2'],['Grade','200'],])
                ->whereDate('Receipt_Date', $today)
                ->count();
            $diterima1 = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Status','2'],['Grade','200'],])
                ->whereDate('Receipt_Date', $d1)
                ->count();
            $diterima2 = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Status','2'],['Grade','200'],])
                ->whereDate('Receipt_Date', $d2)
                ->count();
            $diterima3 = DB::table('Registration')
                ->select('Reg_No')
                ->where([['Reg_Type','1'],['Period',$thisYear],['Status','2'],['Grade','200'],])
                ->whereDate('Receipt_Date', $d3)
                ->count();
            $wawancara = DB::table('Registration as a')
                ->join('Registration_Score_Interview as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.Reg_No')
                ->where([['a.Reg_Type','1'],['a.Period',$thisYear],['a.Grade','200'],])
                ->whereNotNull('b.Int_StatusID')
                ->count();
            $wawancaranow = DB::table('Registration as a')
                ->join('Registration_Score_Interview as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.Reg_No')
                ->where([['a.Reg_Type','1'],['a.Period',$thisYear],['a.Grade','200'],])
                ->whereDate('b.Int_Date', $today)
                ->whereNotNull('b.Int_StatusID')
                ->count();
            $wawancara1 = DB::table('Registration as a')
                ->join('Registration_Score_Interview as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.Reg_No')
                ->where([['a.Reg_Type','1'],['a.Period',$thisYear],['a.Grade','200'],])
                ->whereDate('b.Int_Date', $d1)
                ->whereNotNull('b.Int_StatusID')
                ->count();
            $wawancara2 = DB::table('Registration as a')
                ->join('Registration_Score_Interview as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.Reg_No')
                ->where([['a.Reg_Type','1'],['a.Period',$thisYear],['a.Grade','200'],])
                ->whereDate('b.Int_Date', $d2)
                ->whereNotNull('b.Int_StatusID')
                ->count();
            $wawancara3 = DB::table('Registration as a')
                ->join('Registration_Score_Interview as b', 'a.Reg_No','=','b.Reg_No')
                ->select('a.Reg_No')
                ->where([['a.Reg_Type','1'],['a.Period',$thisYear],['a.Grade','200'],])
                ->whereDate('b.Int_Date', $d3)
                ->whereNotNull('b.Int_StatusID')
                ->count();
            $daful10 = DB::table('Costs_Monthly_ReReg as a')
                ->join('Costs_Monthly_Bill as b', 'a.ID_No','=','b.ID_No')
                ->select('a.ID_No', 'a.F_Name', 'b.Class')
                ->where([['b.Period_Year',$thisYear], ['b.TransType','500'], ['a.TransDate','>',$dafuldate], ['b.Levels','10']])
                ->whereRaw('a.Amount_Bill=b.Amount_Bill')
                ->groupBy('a.ID_No', 'a.F_Name', 'b.Class')
                ->count();
            $daful11 = DB::table('Costs_Monthly_ReReg as a')
                ->join('Costs_Monthly_Bill as b', 'a.ID_No','=','b.ID_No')
                ->select('a.ID_No', 'a.F_Name', 'b.Class')
                ->where([['b.Period_Year',$thisYear], ['b.TransType','500'], ['a.TransDate','>',$dafuldate], ['b.Levels','11']])
                ->whereRaw('a.Amount_Bill=b.Amount_Bill')
                ->groupBy('a.ID_No', 'a.F_Name', 'b.Class')
                ->count();
            $daful10now = DB::table('Costs_Monthly_ReReg as a')
                ->join('Costs_Monthly_Bill as b', 'a.ID_No','=','b.ID_No')
                ->select('a.ID_No', 'a.F_Name', 'b.Class')
                ->where([['b.Period_Year',$thisYear], ['b.TransType','500'], ['a.TransDate',$today], ['b.Levels','10']])
                ->whereRaw('a.Amount_Bill=b.Amount_Bill')
                ->groupBy('a.ID_No', 'a.F_Name', 'b.Class')
                ->count();
            $daful11now = DB::table('Costs_Monthly_ReReg as a')
                ->join('Costs_Monthly_Bill as b', 'a.ID_No','=','b.ID_No')
                ->select('a.ID_No', 'a.F_Name', 'b.Class')
                ->where([['b.Period_Year',$thisYear], ['b.TransType','500'], ['a.TransDate',$today], ['b.Levels','11']])
                ->whereRaw('a.Amount_Bill=b.Amount_Bill')
                ->groupBy('a.ID_No', 'a.F_Name', 'b.Class')
                ->count();
            $daful10lunas = DB::table('Costs_Monthly_ReReg as a')
                ->join('Costs_Monthly_Bill as b', 'a.ID_No','=','b.ID_No')
                ->select('a.ID_No', 'a.F_Name', 'b.Class')
                ->where([['b.Period_Year',$thisYear], ['b.TransType','500'], ['a.TransDate','>',$dafuldate], ['b.Levels','10'], ['a.Amount_Balance','0.00']])
                ->whereRaw('a.Amount_Bill=b.Amount_Bill')
                ->groupBy('a.ID_No', 'a.F_Name', 'b.Class')
                ->count();
            $daful11lunas = DB::table('Costs_Monthly_ReReg as a')
                ->join('Costs_Monthly_Bill as b', 'a.ID_No','=','b.ID_No')
                ->select('a.ID_No', 'a.F_Name', 'b.Class')
                ->where([['b.Period_Year',$thisYear], ['b.TransType','500'], ['a.TransDate','>',$dafuldate], ['b.Levels','11'], ['a.Amount_Balance','0.00']])
                ->whereRaw('a.Amount_Bill=b.Amount_Bill')
                ->groupBy('a.ID_No', 'a.F_Name', 'b.Class')
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
                'siswar' => $siswar,
                'kas' => $kas,
                'tf' => $tf,
                'kasnow' => $kasnow,
                'tfnow' => $tfnow,
                'kas20' => $kas20,
                'tf20' => $tf20,
                'kas20now' => $kas20now,
                'tf20now' => $tf20now,
                'kas19' => $kas19,
                'tf19' => $tf19,
                'kas19now' => $kas19now,
                'tf19now' => $tf19now,
                'lunas' => $lunas,
                'cicil' => $cicil,
                'lunasnow' => $lunasnow,
                'cicilnow' => $cicilnow,
                'diterima' => $diterima,
                'diterimanow' => $diterimanow,
                'diterima1' => $diterima1,
                'diterima2' => $diterima2,
                'diterima3' => $diterima3,
                'wawancara' => $wawancara,
                'wawancaranow' => $wawancaranow,
                'wawancara1' => $wawancara1,
                'wawancara2' => $wawancara2,
                'wawancara3' => $wawancara3,
                'daful10' => $daful10,
                'daful11' => $daful11,
                'daful10now' => $daful10now,
                'daful11now' => $daful11now,
                'daful10lunas' => $daful10lunas,
                'daful11lunas' => $daful11lunas,
            ];
        }
    }
}
