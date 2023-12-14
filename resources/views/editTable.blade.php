@extends('layouts.main')
@section('title', 'Tabel')
@section('content')
    <div class="container">
        <h2 class="animate__animated animate__fadeInUp center">Form Tabel</h2>
        {{-- <form method="post" action="{{ route('hasil') }}"> --}}
        <form method="post" action="{{ route('hasilVikor') }}">
            @csrf
            @method('PUT')

            <table class="table animate__animated animate__fadeInUp">
                <thead>
                {{-- kriteria --}}
                <tr>
                    <th></th>
                    @foreach($criterias as $criteria)
                        <th>{{ $criteria->criteria }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                {{-- bobot --}}
                <tr>
                    <th>Bobot</th>
                    @foreach($criterias as $criteria)
                        <td><input type="number" name="bobot[]" class="form-control" required value="{{ $criteria->weight }}">
                        </td>
                    @endforeach
                </tr>
                {{-- alternatif --}}
                @foreach ($alternatives as $alternative)
                    <tr>
                        <td>{{ $alternative->name }}</td>
                        @foreach ($criterias as $criteria)
                            <td>
                                @foreach ($samples as $sample)
                                    @if ($sample->id_alternative == $alternative->id_alternative && $sample->id_criteria == $criteria->id_criteria)
                                        <input type="number"
                                               name="value[{{ $alternative->id_alternative }}][{{ $criteria->id_criteria }}]"
                                                  class="form-control" required value="{{ $sample->value }}">
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
{{--                @foreach($sample as $smpl)--}}
{{--                    <tr>--}}
{{--                        <th>Alternatif {{ $smpl->name }}</th>--}}
{{--                        @foreach($criteria as $value)--}}
{{--                            <td><input type="number" name="value[{{ $smpl->id }}][{{ $value->id }}]"--}}
{{--                                       class="form-control" required> {{ $sample }}</td>--}}
{{--                        @endforeach--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
                {{--                @for ($row = 0; $row < $x; $row++)--}}
                {{--                    <tr>--}}
                {{--                        <th>Alternatif {{ $row + 1 }}</th>--}}
                {{--                        @for ($col = 0; $col < $y; $col++)--}}
                {{--                            <td><input type="number" name="value[{{ $row }}][{{ $col }}]"--}}
                {{--                                       class="form-control" required></td>--}}
                {{--                        @endfor--}}
                {{--                    </tr>--}}
                {{--                @endfor--}}
                {{-- F max --}}
                </tbody>
            </table>
            <input type="number" name="alternative" value="{{ $alternatives->count() }}" hidden>
            <button type="submit" class="btn btn-primary animate__animated animate__fadeInUp">Hitung</button>
        </form>
    </div>
@endsection
