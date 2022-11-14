@extends('layouts.app')

@section('title', 'Show')

@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-3 mb-3">Сайт: {{ $url->name }}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap" data-test="url">
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
                    </tbody>
                </table>
            </div>
            <h2 class="mt-3 mb-3">Проверки</h2>
            <form method="post" action="{{ route('urls.checks.store', $url->id) }}">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="submit" class="btn btn-primary" value="Запустить проверку">
            </form>
            <table class="table table-bordered table-hover text-nowrap" data-test="checks">
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
                                <td>{{ $urlCheck->id }}</td>
                                <td>{{ $urlCheck->status_code }}</td>
                                <td class="text-wrap">{{ Str::limit($urlCheck->h1), 50 }}</td>
                                <td class="text-wrap">{{ Str::limit($urlCheck->title, 100) }}</td>
                                <td class="text-wrap">{{ Str::limit($urlCheck->description, 100) }}</td>
                                <td>{{ $urlCheck->created_at }}</td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            {{ $urlChecks->links('pagination::bootstrap-4') }}
        </div>

    </main>

@endsection
