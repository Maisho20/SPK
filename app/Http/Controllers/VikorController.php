<?php

namespace App\Http\Controllers;

use App\Models\alternative;
use App\Models\criteria;
use App\Models\sample;
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
        foreach ($request->bobot as $key => $value) {
            criteria::create([
                'criteria' => 'Kriteria ' . ($key + 1),
                'weight' => $value,
                'type' => 'benefit',
            ]);
        }
        for ($i = 0; $i < $request->alternative; $i++) {
            alternative::create([
                'name' => 'Alternatif ' . ($i + 1),
            ]);
        }
        foreach ($request->value as $keyRow => $row) {
            foreach ($row as $keyCol => $value) {
                sample::create([
                    'id_alternative' => $keyRow + 1,
                    'id_criteria' => $keyCol + 1,
                    'value' => $value,
                ]);
            }
        }

        $criterias = Criteria::all();
        // get weigt field from criteria table and / 100
        $weights = $criterias->pluck('weight');
        $sumWeight = $weights->sum();
        // calculate wieght / sum of weight
        foreach ($weights as $key => $weight) {
            $weights[$key] = number_format($weight / $sumWeight, 3);
        }
        $alternatives = Alternative::all();
        $samples = Sample::all();
        $f_plus = [];
        $f_min = [];

        // calculate f_plus max for each criteria value and f_min min for each criteria value
        foreach ($criterias as $criteria) {
            $criteriaId = $criteria->id_criteria;
            $f_plus[$criteriaId] = $samples->where('id_criteria', $criteriaId)->pluck('value')->max();
            $f_min[$criteriaId] = $samples->where('id_criteria', $criteriaId)->pluck('value')->min();
        }

        // normalize matriks
        $normalizedMatrix = [];

        foreach ($samples as $sample) {
            $criteriaId = $sample->id_criteria;
            $alternativeId = $sample->id_alternative;
            $value = $sample->value;

            if (!isset($normalizedMatrix[$alternativeId])) {
                $normalizedMatrix[$alternativeId] = [];
            }

            $normalizedMatrix[$alternativeId][$criteriaId] = number_format(($f_plus[$criteriaId] - $value) / ($f_plus[$criteriaId] - $f_min[$criteriaId]), 3);
        }

        // calculate weighted matrix
        $weightedMatrix = [];

        foreach ($normalizedMatrix as $alternativeId => $criteriaValues) {
            foreach ($criteriaValues as $criteriaId => $normalizedValue) {
                if (!isset($weightedMatrix[$alternativeId])) {
                    $weightedMatrix[$alternativeId] = [];
                }

                $weightedMatrix[$alternativeId][$criteriaId] = number_format($normalizedValue * $weights[$criteriaId - 1], 3);
            }
        }

        // calculate utility measure (S and R)
        foreach ($weightedMatrix as $alternativeId => $criteriaValues) {
            $s[$alternativeId] = 0;
            $r[$alternativeId] = 0;
            foreach ($criteriaValues as $criteriaId => $weightedValue) {
                $s[$alternativeId] += number_format($weightedValue, 3);
                $r[$alternativeId] = number_format(max($r[$alternativeId], $weightedValue),3);
            }
        }

        // calculate vikor index (Q)
        $s_min = min($s);
        $s_max = max($s);
        $r_min = min($r);
        $r_max = max($r);
        $v = 0.5;


        foreach ($s as $alternativeId => $s_value) {
            $r_value = $r[$alternativeId];
            $q[$alternativeId] = number_format(($v * (($s_value - $s_min) / ($s_max - $s_min))) + ((1 - $v) * (($r_value - $r_min) / ($r_max - $r_min))),3);
        }

        // merge array q and alternative
        $result = array_combine($alternatives->pluck('name')->toArray(), $q);

        // sort result by q dari rendah ke tinggi
        arsort($result);
        asort($result);

        return view('hasil', compact('alternatives',
            'criterias',
            'weights',
            'samples',
            'normalizedMatrix',
            'weightedMatrix',
            's',
            'r',
            'q',
            'result'));
    }

}
