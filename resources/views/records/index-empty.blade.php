@extends('layouts.master')

@section('title', 'My Time Keeper')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="top-menu">
                    <h1>
                        {{ $dt }}
                        <a href=" {{ url('records/create') }} ">新規作成</a>
                    </h1>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>まだ記録は何もありません。</p>
            </div>
        </div>
    </div>
@endsection
<!-- aaa -->
