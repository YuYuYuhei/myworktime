@extends('layouts.master')

@section('title', '時間外労働の記録')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <section>
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
                    <p> {{ $diff  }} </p>
                @else
                    <p></p>
                @endif
            </div>
        </section>

        <section>
            @if ( empty($punchInTime) )
                <form  action="{{ action('RecordController@storePunchIn') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-info btn-sm active ml-3" value="出勤時間を記録する">
                </form>
            @elseif ( empty($punchOutTime))
                <form action="{{ action('RecordController@storePunchOut') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-info btn-sm active ml-3" value="退勤時間を記録する">
                </form>
            @endif
            @if ((!empty($punchInTime)) && (!empty($punchOutTime)) )
                <form action=" {{ url('/store' ) }}" method="post" enctype="multipart/form-data"> <!--☆ -->
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-3" for="memo">メモ(備忘録)</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="memo" rows="8" >{{ old('memo') }}</textarea>
                            </div>
                        </div>
                    <input type="submit" class="btn btn-info btn-sm active ml-3" value="メモを保存する">
                </form>
            @endif
            <!-- @isset($punchInTime)
                <form action=" action('RecordController@storePunchOut') " method="post" enctype="multipart/form-data">
                     csrf_field
                    <div class="form-group row">
                        <label class="col-md-3" for="memo">メモ(備忘録)</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="memo" rows="8" > old('memo') </textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-info btn-sm active ml-3" value="退勤時間を記録する" formaction=" ">
                </form>
            @else
                <form  action=" action('RecordController@storePunchIn') " method="post" enctype="multipart/form-data">
                     csrf_field
                    <div class="form-group row">
                        <label class="col-md-3" for="memo">メモ(備忘録)</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="memo" rows="8" > old('memo') </textarea>
                        </div>
                    </div>
                        <input type="submit" class="btn btn-info btn-sm active ml-3" value="出勤時間を記録する">
                </form>
            @endisset -->
        </section>
    </div>
</div>
@endsection
