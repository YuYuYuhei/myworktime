@extends('layouts.master')

@section('title', '編集')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <section class="top-menu">
                <h1>
                    {{ $date }}
                    <a href="{{ url('/') }}">戻る</a>
                </h1>
            </section>

            <form action="{{ action('RecordController@update', $task->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!--patchのMethodでURLに対しindex.Bladeのforelseのtaskを渡したい時に記載 -->

                <section class="display-area">
                    <div class="form-group row">
                        <label class="col-md-3">出勤時間</label>
                        <input type="datetime" name="punchIn" value="{{ old('punchIn', $task->punchIn) }}">
                          　　　　　　　<!-- oldヘルパ利用しつつDB Emptyでなければ表示する記述 -->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">退勤時間</label>
                        @if ( !empty( $task->punchOut ))
                            <input type="datetime" name="punchOut" value="{{ old('punchOut', $task->punchOut) }}">
                        @else
                            <input type="datetime" name="punchOut" value="">
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">勤務時間</label>
                        @if ( !empty( $task->workTimeInt ))
                            <p>{{ $task->workTimeInt }}</p>
                        @else
                            <p></p>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="memo">メモ(備忘録)</label>
                        <div class="col-md-12">
                            @if ( !empty( $task->memo ))
                                <textarea class="form-control" name="memo" rows="8" >{{  old('memo', $task->memo) }}</textarea>
                            @else
                                <textarea class="form-control" name="memo" rows="8" placeholder="Memoを記録しましょう"></textarea>
                            @endif
                        </div>
                    </div>
                </section>

                <section class="btn-area">
                    <input type="submit" class="btn btn-info btn-sm active mt-3" value="変更を記録する">
                </section>
            </form>
        </div>
    </div>
@endsection
