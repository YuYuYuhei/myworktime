@extends('layouts.master')

@section('title', 'My Time Keeper')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="top-menu">
                    <h1>
                        {{ $dt }}
                        <a href=" {{ url('records/create') }} ">新規作成</a>
                    </h1>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <section class="my-records">
                    <h1>
                        <a href="{{ action('RecordController@index', ['year' => $prevYear, 'month' => $prevMonth]) }}" class="prev-month"><<先月の記録</a>
                        <a href="{{ url('/') }}" class="this-month">今月の記録</a>
                        <a href="{{ action('RecordController@index', ['year' => $nextYear, 'month' => $nextMonth]) }}" class="next-month">次月の記録>></a>
                    </h1>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">日付</th>
                                <th scope="col">出勤</th>
                                <th scope="col">退勤</th>
                                <th scope="col">休憩</th>
                                <th scope="col">実働</th>
                                <th scope="col">メモ</th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($tasks as $task)
                                    <!-- if ($date2[ strval($task->id) ]  === date('Y-m')) -->
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ url('records', $task->id) }}">{{ $date[ strval($task->id) ] }}</a>
                                                <br />
                                                <form action="{{ action('RecordController@edit', $task->id) }}" method="get" class="index-btn">
                                                    <input type="submit"  value="編集" class="btn btn-primary btn-sm">
                                                </form>
                                                <form action="{{ action('RecordController@delete', $task->id) }}" method="post" class="index-btn">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <input type="submit"  value="削除" id="delete" class="btn btn-danger btn-sm del">
                                                </form>
                                             </th>
                                            <td>{{ $task->punchIn }}</td>
                                            <td>{{ $task->punchOut }}</td>
                                            <td>{{ $task->breakTimeInt }}</td>
                                            <td>{{ $task->workTimeInt }}</td>
                                            <td>{{ str_limit($task->memo, 5) }}</td>
                                            <!-- For memo, I gonna show only 5 letters from beginning -->
                                        </tr>
                                    <!-- endif     -->
                                    @empty
                                        <p>まだ記録はありません。</p>
                                @endforelse
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <th scope="col">今月の稼働日数</th>
                            <th scope="col">今月の稼働時間</th>
                        </thead>
                        <tbody>
                                <td>{{ count($dayOfWork) }}日</td>
                                <td>{{ gmdate('H時間i分s秒', $sumWorkTimeInt) }}</td>
                                <!-- 全部の列を計算している -->
                        </tbody>
                    </table>
                    <!-- <table>
                        <td> $thisMonthdate </td>
                    </table> -->
                </section>
            </div>
            <div class="col-2 disp" >
                <!-- <p class="disp-month">2019/06</p> -->
                @foreach($explodeYearMonths as $explodeYearMonth)
                    <a href="{{ action('RecordController@index', ['year' => $explodeYearMonth[0], 'month' => $explodeYearMonth[1]]) }}" class="disp-month">{{ $explodeYearMonth[0].'-'.$explodeYearMonth[1] }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
    $('.del').click(function(){
        if(confirm("本当に削除しますか？")){
            //そのままsubmit（削除）
        }else{
            //cancel
            return false;
        }
    });
    </script>

@endsection
