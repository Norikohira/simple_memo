@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メモ編集</div>

                <div class="card-body">
                    <!-- バリデーションエラーメッセージ表示 -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <form id="edit-form" action="{{ route('memo.update', $memo->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="input-group">
                            <input type="text" name="memo" id="memo" class="form-control" value="{{ old('memo', $memo->memo) }}">
                        </div>
                    </form>

                    <div class="mt-3">
                        <a href="{{ route('home') }}" class="btn btn-primary">戻る</a>
                        <button type="submit" form="edit-form" class="btn btn-success">修正</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
