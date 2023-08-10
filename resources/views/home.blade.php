@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規登録</div>

                <div class="card-body">
                    <!-- バリデーションエラーメッセージ表示 -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                    </div>
                    @endif

                    <form action="{{route('memo.store')}}" method="POST">
                    @csrf
                    @method('POST')
                        <div class="input-group">
                            <input type="text" name="memo" id="memo" class="form-control"  style="width: 70%;">
                            <input type="submit" value="登録" class="form-control btn btn-primary"  style="width: 30%;">
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-hover table-secondary mt-5">
                <div class="thead">
                    <tr>
                        <th>No</th>
                        <th>メモ内容</th>
                        <th>作成日時</th>
                        <th>編集日時</th>
                        <th></th>
                    </tr>
                </div>
                <tbody>
                    @foreach($all_memos as $memo)
                    <tr>
                        <td>{{$memo->id}}</td>
                        <td>{{$memo->memo}}</td>
                        <td>{{$memo->created_at}}</td>
                        <td>{{$memo->updated_at}}</td>
                        <td>
                            <a href="{{ route('memo.edit', $memo->id) }}" class="btn btn-success">編集</a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$memo->id}}">削除</button>

                            <!-- 削除モーダル -->
                            <div class="modal fade" id="deleteModal{{$memo->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$memo->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{$memo->id}}">削除の確認</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            本当にこのメモを削除しますか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                            <form action="{{ route('memo.destroy', $memo->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 削除モーダルここまで -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
