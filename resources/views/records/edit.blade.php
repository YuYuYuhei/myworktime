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
                <section class="display-area">
                    <div class="form-group row">
                        <label class="col-md-3">出勤時間</label>
                        <input type="hidden" id="punchIn" name="punchIn" value="{{ old('punchIn', $task->punchIn) }}">
                          <!-- oldヘルパ利用しつつDB Emptyでなければ表示する記述 -->
                        <input type="text" id="punchInYmd">
                        <select id="selectPunchInHour"></select>時
                        <select id="selectPunchInMinute"></select>分
                    </div>

                    <div class="form-group row mt-3">
                        <label class="col-md-3">退勤時間</label>
                        @if ( !empty( $task->punchOut ))
                            <input type="hidden" id="punchOut" name="punchOut" value="{{ old('punchOut', $task->punchOut) }}">
                            <input type="text" id="punchOutYmd">
                            <select id="selectPunchOutHour"></select>時
                            <select id="selectPunchOutMinute"></select>分
                        @else
                            <input type="datetime" id="punchOut" name="punchOut" value="">
                        @endif
                        <p id="test"></p>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3">勤務時間</label>
                        @if ( !empty( $task->workTimeInt ))
                            <p>{{ $workTime }}</p>
                        @else
                            <p></p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="breakIn">休憩入り時間</label>
                        <input type="hidden" id="breakIn" name="breakIn" value="{{ $task->breakIn }}">
                        <input type="text" id="breakInYmd">
                        <select id="selectBreakInHour"></select>時
                        <select id="selectBreakInMinute"></select>分
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="breakOut">休憩戻り時間</label>
                        <input type="hidden" id="breakOut" name="breakOut" value="{{ $task->breakOut }}">
                        <input type="text" id="breakOutYmd">
                        <select id="selectBreakOutHour"></select>時
                        <select id="selectBreakOutMinute"></select>分
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3">休憩時間</label>
                        @if ( !empty( $task->breakTimeInt ))
                            <p>{{ $breakTime }}</p>
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
                    <input type="submit" id="editBtn" class="btn btn-info btn-sm active mt-3" value="変更を記録する">
                </section>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <!-- <script src="{{ asset('js/jquery.js') }}"></script> -->
@endsection
