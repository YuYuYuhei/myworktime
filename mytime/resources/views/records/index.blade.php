@extends('layouts.master')

@section('title', 'My Time Keeper')

@section('content')
    <div class="container">
        <section class="top-menu">
            <h1>
                {{ $dt }}
                <a href="{{ url('records/create') }}">新規作成</a>
            </h1>
        </section>

        <section class="my-records">
            <h1>
                <a href="" class="prev-month"><<先月の記録</a>
                <a href="" class="next-month">次月の記録>></a>
            </h1>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">日付</th>
                        <th scope="col">出勤</th>
                        <th scope="col">退勤</th>
                        <th scope="col">実働</th>
                        <th scope="col">メモ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <!-- if ($task->punchIn  == $dt) -->
                        <tr>
                            <th scope="row"><a href="">{{ $date[ strval($task->id) ] }}</a></th>
                            <td>{{ $punchIn[ strval($task->id) ] }}</td>
                            <td>{{ $punchOut[ strval($task->id) ] }}</td>
                            <td>{{ $task->workTime }}</td>
                            <td>{{ $task->memo }}</td>
                        </tr>
                        <!-- endif -->
                    @empty
                        <p>まだ記録はありません。</p>
                    @endforelse
                </tbody>
            </table>

            <table class="table">
                <thead>
                    <th scope="col">稼働日数</th>
                    <th scope="col">稼働時間</th>
                </thead>
                <tbody>
                    <td>◯日</td>
                    <td>◯:◯</td>
                </tbody>
            </table>
        </section>
    </div>
@endsection
