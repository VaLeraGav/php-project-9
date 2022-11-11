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
                @if ($urls)
                    @foreach ($urls as $url)
                        <tr>
                            <td>{{ $url->id }}</td>
                            <td>
                                <a href="{{ route('urls.show', $url->id )}}">{{ $url->name }}</a>
                            </td>
                            <td>{{ $lastChecks[$url->id]->created_at ?? null }}</td>
                            <td>{{ $lastChecks[$url->id]->status_code ?? null }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
            {{ $urls->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
