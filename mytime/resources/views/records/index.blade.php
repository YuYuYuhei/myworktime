@extends('layouts.master')

@section('title', 'My Time Keeper')

@section('content')
    <div class="container">
        <section class="top-menu">
            <h1>
                {{ $dt }}
                <a href=" {{ url('records/create') }} ">新規作成</a>
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
                                            <input type="submit"  value="削除" class="btn btn-danger btn-sm del">
                                        </form>
                                     </th>
                                    <td>{{ $task->punchIn }}</td>
                                    <td>{{ $task->punchOut }}</td>
                                    <td>{{ $task->workTimeInt }}</td>
                                    <td>{{ $task->memo }}</td>
                                    <!-- <td> $date2[ strval($task->id) ]  </td> -->
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
                        <td>{{ gmdate('H時間i分', $sumWorkTimeInt) }}</td>
                </tbody>
            </table>
            <!-- <table>
                <td> $thisMonthdate </td>
            </table> -->
        </section>
        @section('script')
        <script> //show confirm window when push "削除" ←nothing understand now(6/16)
        $(function(){
            $(".del").click(function(){
                if(confirm("本当に削除しますか？")){
                    //そのままsubmit（削除）
                }else{
                    //cancel
                    return false;
                }
            });
        });
        </script>
        @endsection
    </div>
@endsection
