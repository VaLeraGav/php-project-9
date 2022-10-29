@extends('layouts.app')

@section('title', 'Show')

@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $url->id }}</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $url->name }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $url->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Дата обновления</td>
                        <td>{{ $url->updated_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h2 class="mt-5 mb-3">Проверки</h2>
            <form method="post" action="{{ route('urls.checks.store', [$url->id]) }}">
                {{-- @csrf --}}
                {{ csrf_field() }}
                {{--  <input type="hidden" name="_token" value=""> --}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="submit" class="btn btn-primary" value="Запустить проверку">
            </form>
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>title</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
                @foreach ($urlChecks as $urlCheck)
                    <tr>
                        <th>{{ $urlCheck->id }}</th>
                        <th>{{ $urlCheck->status_code }}</th>
                        <th>{{ $urlCheck->h1 }}</th>
                        <th>{{  $urlCheck->title }}</th>
                        <th>{{  $urlCheck->description }}</th>
                        <th>{{  $urlCheck->created_at }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection
