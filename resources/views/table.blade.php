@extends('layouts.main')
@section('title', 'Tabel')
@section('content')
    <div class="container">
        <h2 class="animate__animated animate__fadeInUp center">Form Tabel dengan {{ $x }} Alternatif dan
            {{ $y }} Kriteria</h2>
        <form method="post" action="{{ route('hasil') }}">
            @csrf

            <table class="table animate__animated animate__fadeInUp">
                <thead>
                    {{-- kriteria --}}
                    <tr>
                        <th></th>
                        @for ($i = 0; $i < $y; $i++)
                            <th>Kriteria {{ $i + 1 }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    {{-- bobot --}}
                    <tr>
                        <th>Bobot</th>
                        @for ($i = 0; $i < $y; $i++)
                            <td><input type="number" name="bobot[]" class="form-control" required></td>
                        @endfor
                    </tr>
                    {{-- alternatif --}}
                    @for ($row = 0; $row < $x; $row++)
                        <tr>
                            <th>Alternatif {{ $row + 1 }}</th>
                            @for ($col = 0; $col < $y; $col++)
                                <td><input type="number" name="value[{{ $row }}][{{ $col }}]"
                                        class="form-control" required></td>
                            @endfor
                        </tr>
                    @endfor
                    {{-- F max --}}
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary animate__animated animate__fadeInUp">hitung</button>
        </form>
    </div>
@endsection
