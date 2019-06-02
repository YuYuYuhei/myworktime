@extends('layouts.master')

@section('title', '時間外労働の記録')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <section>
            <div class="form-group row">
                <label class="col-md-3">出勤時間</label>
                @isset($punchInTime)
                    <p>{{ $punchInTime }}</p>
                @else
                    <p></p>
                @endisset
            </div>
            <div class="form-group row">
                <label class="col-md-3">退勤時間</label>
                @isset( $punchOutTime )
                    <p> {{ $punchOutTime }} </p>
                @else
                    <p></p>
                @endisset
            </div>
            <div class="form-group row">
                <label class="col-md-3">勤務時間</label>
                <!-- <p> $diff  </p> -->
            </div>
        </section>

        <section>
            <form  action="{{ action('RecordController@punchIn') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-md-3" for="memo">メモ(備忘録)</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="memo" rows="8" >{{ old('memo') }}</textarea>
                    </div>
                </div>
                @isset( $punchInTime )
                    <input type="hidden" class="btn btn-info btn-sm active ml-3" value="出勤時間を記録する">
                @else
                    <input type="submit" class="btn btn-info btn-sm active ml-3" value="出勤時間を記録する">
                @endisset
            </form>
            <!-- <form action="" method="post" enctype="multipart/form-data"> -->
                @isset( $punchInTime )
                    <input type="submit" class="btn btn-info btn-sm active ml-3" value="退勤時間を記録する" formaction=" ">
                @else
                    <input type="hidden" class="btn btn-info btn-sm active ml-3" value="退勤時間を記録する">
                @endisset
            <!-- </form> -->
        </section>
    </div>
</div>
@endsection
