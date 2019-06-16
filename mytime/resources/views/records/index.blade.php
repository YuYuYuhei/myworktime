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
                        <!-- if ($task->punchIn  == $dt) -->
                        <tr>
                            <th scope="row">
                                <a href="{{ url('records', $task->id) }}">{{ $date[ strval($task->id) ] }}</a>
                                <br />
                                <!-- <a href=" action('RecordController@edit', $task->id)  "> [編集]</a> -->
                                <form action="{{ action('RecordController@edit', $task->id) }}" method="get" class="index-btn">
                                    <input type="submit"  value="編集" class="btn btn-primary btn-sm">
                                </form>
                                <form action="{{ action('RecordController@delete', $task->id) }}" method="post" class="index-btn">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <input type="submit"  value="削除" class="btn btn-danger btn-sm del">
                                </form>
                             </th>
                            <td>{{ $punchIn[ strval($task->id) ] }}</td>
                            <td>{{ $punchOut[ strval($task->id) ] }}</td>
                            <td>{{ $task->workTime }}</td>
                            <td>{{ $task->memo }}</td>
                            <!-- For memo, I gonna show only 5 letters from beginning -->
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
                        <!-- <td>◯日</td> -->
                        <td>{{ $sumWorkTime }}</td>
                </tbody>
            </table>
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
