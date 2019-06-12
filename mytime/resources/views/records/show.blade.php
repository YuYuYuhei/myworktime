@extends('layouts.master')

@section('title', '記録')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <section class="top-menu">
            <h1>
                 {{ $date }}
                <a href="{{ url('/') }}">戻る</a>
            </h1>
        </section>

        <section class="display-area">
            <div class="form-group row">
                <label class="col-md-3">出勤時間</label>
                <p>{{ $task->punchIn }}</p>
            </div>
            <div class="form-group row">
                <label class="col-md-3">退勤時間</label>
                @if ( !empty( $task->punchOut ))
                    <p>{{ $task->punchOut }}</p>
                @else
                    <p></p>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-md-3">勤務時間</label>
                @if ( !empty( $task->workTime ))
                    <p>{{ $task->workTime }}</p>
                @else
                    <p></p>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-md-3" for="memo">メモ(備忘録)</label>
                <div class="col-md-12 texts">
                    @if ( !empty( $task->memo ))
                        <p>{!!  nl2br(e($task->memo))  !!}</p>  <!--改行を反映しながらescape化も実行-->
                    @else
                        <p>You didn't write any memo.</p>
                    @endif
                </div>
            </div>
        </section>

        <section class="btn-area">
            <form action="{{ action('RecordController@edit', $task->id) }}" method="get" enctype="multipart/form-data">
                 <!-- csrf_field →getの時は不要 -->
                <input type="submit" class="btn btn-info btn-sm active mt-3" value="内容を編集する">
            </form>
        </section>
    </div>
</div>
@endsection
