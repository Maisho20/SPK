@extends('layouts.main')
@section('title', 'Input')
@section('content')
    <div class="container">
        <h2 class="animate__animated animate__fadeInUp center">Tentukan jumlah Alternatif dan Kriteria</h2>
        <form method="post" action="{{ route('table') }}">
            @csrf

            <div class="form-group size-box">
                <label for="x" class="animate__animated animate__fadeInUp">Jumlah Alternatif:</label>
                <input type="number" name="x" class="form-control" required class="animate__animated animate__fadeInUp">
            </div>

            <div class="form-group size-box">
                <label for="y" class="animate__animated animate__fadeInUp">Jumlah Kriteria:</label>
                <input type="number" name="y" class="form-control" required
                    class="animate__animated animate__fadeInUp">
            </div>

            <button type="submit" class="btn btn-primary animate__animated animate__fadeInUp">Generate Tabel</button>
        </form>
    </div>
@endsection
