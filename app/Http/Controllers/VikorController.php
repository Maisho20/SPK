<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VikorController extends Controller
{
    public function table(Request $request)
    {
        $x = $request->input('x');//alternatif
        $y = $request->input('y');//kriteria

        return view('table')->with(['x' => $x, 'y' => $y]);
    }

    public function hitung(Request $request){
        $bobot = $request->input('bobot');
        $value = $request->input('value');
        $normalisasi = $this->normalisasi($value);
        $normalisasiTerbobot = $this->normalisasiTerbobot($value, $bobot);
        $utilityMeasure = $this->utilityMeasure($normalisasiTerbobot);
        $indeksVIKOR = $this->indeksVIKOR($utilityMeasure);
        $rangking = $this->rangking($utilityMeasure);
        return view('hasil', [
            'values' => $value,
            'weights' => $bobot,
            'normalizations' => $normalisasi,
            'terbobot' => $normalisasiTerbobot,
            'S' => $utilityMeasure[0],
            'R' => $utilityMeasure[1],
            'Q' => $indeksVIKOR,
            'rangking' => $rangking,
        ]);
    }

    public function normalisasi($value){//(N)
        $normalisasi = $value;
        $f_plus=$f_min = array_fill(0, count($value[0]), 0);
        // nilai min dan max dari setiap kriteria
        for ($i = 0; $i < count($value[0]); $i++) {
            for ($j = 0; $j < count($value); $j++) {
                if(!isset($f_plus[$j])){
                    $f_plus[$j] = 0;
                    $f_min[$j] = 9999999;
                }
                $f_plus[$j]=($f_plus[$j] < $value ? $value : $f_plus[$j]);
                $f_min[$j]=($f_min[$j] > $value ? $value : $f_min[$j]);
            }
        }
        // normalisasi
        for ($i = 0; $i < count($value); $i++) {
            for ($j = 0; $j < count($value[0]); $j++) {
                $normalisasi[$i][$j] = number_format(($f_plus[$j] - $value)/($f_plus[$j]-$f_min[$j]), 3);
            }
        }
        return $normalisasi;
        // $f_plus=$f_min=array();
    }

    public function normalisasiTerbobot($normalisasi, $bobot){//(F*)
        $normalisasiTerbobot = $normalisasi;
        for ($i = 0; $i < count($normalisasi); $i++) {
            for ($j = 0; $j < count($normalisasi[0]); $j++) {
                $normalisasiTerbobot[$i][$j] = number_format($normalisasi[$i][$j] * $bobot[$j], 3);
            }
        }
        return $normalisasiTerbobot;
    }

    public function utilityMeasure($normalisasiTerbobot){//S dan R
        $utilityMeasure=$S=$R=array();
        // $S=$R=array();
        for ($i = 0; $i < count($normalisasiTerbobot); $i++) {
            $S[$i]=$R[$i]=0;
            for ($j = 0; $j < count($normalisasiTerbobot[0]); $j++) {
                $S[$i]+=$normalisasiTerbobot[$i][$j];
                $R[$i] = ($R[$i] < $normalisasiTerbobot[$i][$j] ? $normalisasiTerbobot[$i][$j] : $R[$i]);
            }
        }
        return $utilityMeasure;
        // return $utilityMeasure=array($S, $R);
        // return array($S, $R);
    }

    public function indeksVIKOR($utilityMeasure){//Q
        $Q=array();
        function get_indeksVIKOR($S,$R,$v=0.5){
            //-- mencari nilai S_plus,S_min,R_plus dan R_min
            $S_plus=max($S);
            $S_min=min($S);
            $R_plus=max($R);
            $R_min=min($R);
            $Q=array();
            foreach($R as $i=>$r){
                $Q[$i]=$v*(($S[$i]-$S_min[$i])/($S_plus[$i]-$S_min[$i]))
                    +(1-$v)*(($R[$i]-$R_min[$i])/($R_plus[$i]-$R_min[$i]));
            }
            return $Q;
        }
        // $S_plus=max($utilityMeasure[0]);
        // $S_min=min($utilityMeasure[0]);
        // $R_plus=max($utilityMeasure[1]);
        // $R_min=min($utilityMeasure[1]);
        // $v = 0.5;
        // $Q=array();
        // for ($i = 0; $i < count($utilityMeasure[0]); $i++) {
        //     $Q[$i]=$v*(($utilityMeasure[0][$i]-$S_min)/($S_plus-$S_min))
        //         +(1-$v)*(($utilityMeasure[1][$i]-$R_min)/($R_plus-$R_min));
        // }
        // foreach($R as $i=>$r){
        //     $Q[$i]=$v*(($S[$i]-$S_min[$i])/($S_plus[$i]-$S_min[$i]))
        //         +(1-$v)*(($R[$i]-$R_min[$i])/($R_plus[$i]-$R_min[$i]));
        // }
        //-- inisiasi nilai v untuk nilai by vote, by consensus, dan voting by majority rule
        $v=array(0.44,0.5,0.56);
        //-- menghitung nilai index VIKOR (Q) untuk v=0.5 (by consensus)
        $Q[$v[1]]=get_indeksVIKOR($utilityMeasure[0],$utilityMeasure[1],$v[1]);

        return $Q[$v[1]] ;
        // return $indeksVIKOR;
    }

    public function rangking($utilityMeasure){
        $Q = $this->indeksVIKOR($utilityMeasure);
        $rangking = array();
        for ($i = 0; $i < count($Q); $i++) {
            $rangking[$i] = array($Q[$i], $i);
        }
        asort($rangking);
        return $rangking;
    }
}
