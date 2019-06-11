@extends('layouts.master')

@section('title', '編集')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <section class="top-menu">
                <h1>
                    {{-- {{ $dt }} --}}
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
                    <p> {{ $workTime  }} </p>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="memo">メモ(備忘録)</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="memo" rows="8" >{{ old('memo') }}</textarea>
                    </div>
                </div>
            </section>

            <section class="btn-area">
                {{--<form  action="{{ url('records/edit') }}" method="post" enctype="multipart/form-data">--}}
                    {{-- csrf_field() --}}
                    <input type="submit" class="btn btn-info btn-sm active mt-3" value="変更を更新する">
                </form>
            </section>
        </div>
    </div>
@endsection
