@extends('layouts.master')

@section('title', '時間外労働の更新')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="form-group row">
            <label class="col-md-3">出勤時間</label>
            <p>{{ $tasks->punchIn }}</p>
        </div>
        <div class="form-group row">
            <label class="col-md-3">退勤時間</label>
            <p>{{ $tasks->punchOut }}</p>
        </div>
        <!-- <div class="form-group row">
            <label class="col-md-3">勤務時間</label>
            <p></p>
        </div> -->
        <div class="form-group row">
            <label class="col-md-3" for="memo">メモ(備忘録)</label>
            <div class="col-md-10">
                <textarea class="form-control" name="memo" rows="8" ></textarea>
            </div>
        </div>
        <input type="submit" class="btn btn-info btn-sm active ml-3" value="編集を記録する">
    </div>
</div>
@endsection
