@extends('layouts.app')

@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Сайт: https://hexlet.io</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>https://hexlet.io</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>2022-08-28 08:00:48</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h2 class="mt-5 mb-3">Проверки</h2>
            <form method="post" action="https://php-page-analyzer-ru.hexlet.app/urls/1/checks">
                <input type="hidden" name="_token" value="vL69bSCoXYHQS5ecyYmTlhBVMqNUtfsqjElRLHKO">
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
                </tbody>
            </table>
        </div>
    </main>

@endsection
