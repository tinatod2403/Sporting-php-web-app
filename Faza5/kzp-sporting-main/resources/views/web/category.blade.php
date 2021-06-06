@extends('web.layout.master')

@section('title')
    <title>{{ $category->type }}</title>
@endsection

@section('content')
    <div class="row">
        @foreach($category->complexes as $complex)
            <div class="col-sm-12 sportski-objekti ">
                <div>
                    <a href="{{ route('complex',['category'=>$category->type,'complex'=>$complex->name]) }}">
                        <table id="tabela-sportskih-objekata">
                            <tr>
                                <td>
                                    <h2>{{ $complex->name }}</h2>
                                    <p><i>Vjekoslava Kovača 11, 11000 Beograd
                                            <br>RADNO VREME: ponedeljak-nedelja</i></p>
                                </td>
                                <td rowspan="2" colspan="2">
                                    <img
                                        src="{{ $complex->logo ? \Illuminate\Support\Facades\Storage::url($complex->logo) : "" }}"
                                        class="img-fluid sportski-objekti-slika" width="100" height="100">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>{{ $complex->content }}</p>
                                </td>
                            </tr>
                        </table>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
