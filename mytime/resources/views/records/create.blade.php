@extends('layouts.master')

@section('title', '時間外労働の記録')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <section class="top-menu">
            <h1>
                {{ $dt }}
                <a href="{{ url('/') }}">戻る</a>
            </h1>
        </section>

        <section class="display-area">
            <div class="form-group row">
                <label class="col-md-3">出勤時間</label>
                <p>{{ $punchInTime }}</p>
            </div>
            <div class="form-group row">
                <label class="col-md-3">退勤時間</label>
                <p> {{ $punchOutTime }} </p>
            </div>
            <div class="form-group row">
                <label class="col-md-3">勤務時間</label>
                @if ((!empty($punchInTime))  && (!empty($punchOutTime)))
                    <!-- <p>  gmdate('H時間i分', $workTimeInt)  <br> -->
                    <p> {{ gmdate('H時間i分', $diff) }} <br>
                        ※休憩時間の設定は下部でおこなってください。
                    </p>
                @else
                    <p></p>
                @endif
            </div>
        </section>

        <section class="btn-area">
            @if ( empty($punchInTime) )
                <form  action="{{ action('RecordController@storePunchIn') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-info btn-sm active mt-3" value="出勤時間を記録する">
                </form>
            @elseif ( empty($punchOutTime))
                <form action="{{ action('RecordController@storePunchOut') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-info btn-sm active mt-3" value="退勤時間を記録する">
                </form>
            @endif
            @if ((!empty($punchInTime)) && (!empty($punchOutTime)) )
                <form action=" {{ url('/store' ) }}" method="post" enctype="multipart/form-data"> <!--☆ -->
                    {{ csrf_field() }}
                        <!-- <div class="form-group row">
                            <label class="col-md-3" for="breakTime">休憩時間</label>
                            <input type="time" name="breakTime" value="01:00">
                            <p>time</p>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-md-3" for="breakIn">休憩入り時間</label>
                            <input type="datetime" name="breakIn" value="{{ $punchInTime }}">
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="breakOut">休憩戻り時間</label>
                            <input type="datetime" name="breakOut"  value="{{ $punchOutTime }}">
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="memo">メモ(備忘録)</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="memo" rows="8" >{{ old('memo') }}</textarea>
                            </div>
                        </div>
                    <input type="submit" class="btn btn-info btn-sm active mt-3" value="休憩時間とメモを保存する">
                </form>
            @endif
        </section>
    </div>
</div>
@endsection
