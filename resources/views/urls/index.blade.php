@extends('layouts.app')

@section('title', 'Сайты')

@section('content')
    <div class="container-lg mt-3">
        <h1>Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap" data-test="urls">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Последняя проверка</th>
                    <th>Код ответа</th>
                </tr>
                </tbody>
                @foreach($urls as $url)
                    <tr>
                        <td>{{$url->id}}</td>
                        <td>{{$url->name}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
