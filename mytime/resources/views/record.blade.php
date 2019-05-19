@extends('layouts.master')

@section('title', '時間外労働の記録')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="form-group row">
            <button type="button" class="btn btn-info btn-sm active ml-3">
                開始時間
            </button>
        </div>
        <div class="form-group row">
            <button type="button" name="" class="btn btn-info btn-sm active ml-3 btn1">終了時刻</button>
        </div>
        <div class="form-group row">
            <label class="col-md-3" for="sum">本日合計</label>
            <div class="col-md-10">
                <h4>合計時間表示</h4>

                <p>{{ date('Y/n/j  H:i') }}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3" for="body">メモ(備忘録)</label>
            <div class="col-md-10">
                <textarea class="form-control" name="body" rows="8" >{{ old('body') }}</textarea>
            </div>
        </div>
        {{ csrf_field() }}
        <input class="mr-2" type="submit" name="btn btn-primary" value="記録する">
        <input type="reset" name="btn btn-primary" value="リセット">
    </div>
</div>
@endsection
