@extends('layouts.master')

@section('title', '時間外労働の記録')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <form  action="{{ action('RecordController@punchIn') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="punchIn" value="{{ $punchIn }}">
            <input type="hidden" name="punchOut" value="">
            <div class="form-group row">
                <label class="col-md-3" for="memo">メモ(備忘録)</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="memo" rows="8" >{{ old('memo') }}</textarea>
                </div>
            </div>
            <!-- <input class="mr-2" type="submit" name="btn btn-primary" value="記録する">
            <input type="reset" name="btn btn-primary" value="リセット"> -->
            <input type="submit" class="btn btn-info btn-sm active ml-3" value="出勤時間を記録する">
        </form>
    </div>
</div>
@endsection


<!-- Memo

<form  action="{{ action('RecordController@punchIn') }}" method="post" enctype="multipart/form-data"></form>→formで囲んだところに関する処理の送信先を指定。この書き方でactionに飛ばす旨記載

{{ csrf_field() }}→csrf対策。formタグの中などに入れねばならない

<input type="hidden" name="punchIn" value="{{ $punchIn }}">
→type hiddenは非表示データを送信
→name属性はフォームの部品に名前をつける(カラム名とのリンクが多い)
→value属性は送信される値を指定する

<form></form>で囲む時は基本的にinputタグはセット。buttonタグだと反応しない
→inputの便利な属性値をcheckしておく

   -->
