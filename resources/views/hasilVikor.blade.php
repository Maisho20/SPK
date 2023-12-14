@extends('layouts.main')
@section('title', 'Hasil Perhitungan VIKOR')
@section('content')
    <div class="container my-2">
        <div class="row my-2">
            <div class="col">
                <h1 class="text-center">SPK Metode VIKOR</h1>
            </div>
        </div>

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        Matriks F
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($criterias as $criteria)
                                            <th>{{ $criteria->criteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatives as $alternative)
                                        <tr>
                                            <td>{{ $alternative->name }}</td>
                                            @foreach ($criterias as $criteria)
                                                <td>
                                                    @foreach ($samples as $sample)
                                                        @if ($sample->id_alternative == $alternative->id_alternative && $sample->id_criteria == $criteria->id_criteria)
                                                            {{ $sample->value }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Criteria</th>
                                        @foreach ($criterias as $criteria)
                                            <th>{{ $criteria->criteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bobot</td>
                                        @foreach ($weights as $weight)
                                            <td>{{ $weight }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        Matrix N
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($criterias as $criteria)
                                            <th>{{ $criteria->criteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatives as $altKey => $alternative)
                                        <tr>
                                            <td>{{ $alternative->name }}</td>
                                            @foreach ($criterias as $critKey => $criteria)
                                                <td>{{ $normalizedMatrix[$alternative->id_alternative][$criteria->id_criteria] }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree">
                        Matrix F*
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Criteria</th>
                                        @foreach ($criterias as $criteria)
                                            <th>{{ $criteria->criteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Weight</td>
                                        @foreach ($weights as $weight)
                                            <td>{{ $weight }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($criterias as $criteria)
                                            <th>{{ $criteria->criteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatives as $altKey => $alternative)
                                        <tr>
                                            <td>{{ $alternative->name }}</td>
                                            @foreach ($criterias as $critKey => $criteria)
                                                <td>{{ $weightedMatrix[$alternative->id_alternative][$criteria->id_criteria] }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseFour">
                        Nilai Utility Measure S dan Regret Measure R
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingFour">
                    <div class="accordion-body">
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S</th>
                                        <th>Nilai</th>
                                        <th>R</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($s as $key => $value)
                                        <tr>
                                            <td>S{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                            <td>R{{ $key }}</td>
                                            <td>{{ $r[$key] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseFive">
                        Indeks Vikor
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingFive">
                    <div class="accordion-body">
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Q</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($q as $key => $value)
                                        <tr>
                                            <td>Q{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseSix">
                        Perankingan
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingSix">
                    <div class="accordion-body">
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rangking</th>
                                        <th>Kode Alternatif</th>
                                        <th>Nilai Q</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
