@extends('layouts.main')
@section('title', 'Hasil Perhitungan VIKOR')
@section('content')
    {{-- normalisasi Vikor --}}
    <div class="container">
        <h2>Hasil Normalisasi</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach (range(1, count($normalizations[0])) as $i)
                        <th>Kriteria {{ $i }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($normalizations as $i => $row)
                    <tr>
                        <td>Alternatif {{ $i + 1 }}</td>
                        @foreach ($row as $j => $value)
                            <td>{{ number_format($value, 3) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Matrik Normalisasi Terbobot --}}
    <div class="container">
        <h2>Preference Matrix</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach (range(1, count($preferenceMatrix[0])) as $i)
                        <th>Kriteria {{ $i }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($preferenceMatrix as $i => $row)
                    <tr>
                        <td>Alternatif {{ $i + 1 }}</td>
                        @foreach ($row as $j => $value)
                            <td>{{ number_format($value, 4) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Utility Measure --}}
    <div class="container">
        <h2>Concordance Index</h2>
        <table class="table table-bordered">
            @for ($i = 0; $i <= count($concordanceIndex); $i++)
                @for ($j = 0; $j <= count($concordanceIndex[0]); $j++)
                    @if (isset($concordanceIndex[$i][$j]))
                        <tr>
                            <td>{{ $concordanceIndex[$i][$j] }}</td>
                        </tr>
                    @endif
                @endfor
            @endfor
        </table>
    </div>

    {{-- Nilai Indeks VIKOR --}}
    <div class="container">
        <h2>Nilai Indeks VIKOR</h2>
        <table class="table table-bordered">
            @for ($i = 0; $i <= count($vikorIndex); $i++)
                @for ($j = 0; $j <= count($vikorIndex[0]); $j++)
                    @if (isset($vikorIndex[$i][$j]))
                        <tr>
                            <td>{{ $vikorIndex[$i][$j] }}</td>
                        </tr>
                    @endif
                @endfor
            @endfor
        </table>
    </div>

    {{-- Perangkingan --}}
    <div class="container">
        <h2>Perangkingan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranking as $i => $value)
                    <tr>
                        <td>Alternatif {{ $i + 1 }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
