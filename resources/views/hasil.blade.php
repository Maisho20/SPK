<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- animate CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    {{-- styling --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="antialiased">
    <div class="container my-2 animate__animated animate__fadeInUp">
        <div class="row my-2">
            <div class="col">
                <h1 class="text-center">SPK Metode VIKOR</h1>
            </div>
        </div>

        {{-- make a button to go back to the table --}}
        <a href="{{ route('table') }}" class="btn btn-primary animate__animated animate__fadeInUp mb-3">Edit</a>

        {{-- <button type="submit" class="btn btn-primary animate__animated animate__fadeInUp mb-3">Edit</button> --}}

        <div class="accordion" id="accordionPanelsStayOpenExample animate__animated animate__fadeInUp">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
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
            <div class="accordion-item animate__animated animate__fadeInUp">
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
            <div class="accordion-item animate__animated animate__fadeInUp">
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
            <div class="accordion-item animate__animated animate__fadeInUp">
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
            <div class="accordion-item animate__animated animate__fadeInUp">
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
            <div class="accordion-item animate__animated animate__fadeInUp">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
