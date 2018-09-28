詳細
@extends('layouts.default')
@section('content')

<style>
  li{
    list-style: none;
  }
  a{
    text-decoration:none;
  }
  #memo{
    border-bottom: solid 1px ; border-color: gray;
  }

  .center{
    margin-right: auto;
  }
  form{
    /* width: 100%; */

  }
</style>

    <!-- Content Header (Page header) -->



    <!-- Main content -->
    <section class="content">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        test
                    </h3>
                    <div class="card-tools">
                      <a href="" class="btn btn-outline-info">編集</a>
                      <a href="" class="btn btn-outline-secondary">一覧に戻る</a>
                        <!-- <ul class="pagination pagination-sm">
                            <li class="page-item"><a href="#" class="page-link">«</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">»</a></li>
                        </ul> -->
                    </div>
                </div>
                <!-- /.card-header -->

                <!-- /.card-body -->
                <div class="card-footer">

                    <a href="/corp_users/create" class="btn btn-info float-right"><i class="fa fa-plus"></i>法人ユーザー作成</a>
                      <div class="container">
                        <div class="nav1">
                        <ul>
                          <h1><a href="{{ action('CorpsController@edit', $corp->id) }}">{{ $corp->name }}</a></h1>
                          <li>支払い方法 : {{ $corp->payment_methods->name }}</li>
                          <li>法人加入プラン : {{ $corp->plans->name }}</li>
                          <li>法人支払い状況 : {{ $corp->payment_status }}</li>
                          <li>法人支払日 : {{ $corp->payment_date }}</li></br>
                          <h5>【法人住所】</h5>
                          <li>〒 {{ $corp->postal_code }}</li>
                          <li>{{ $corp->prefectures->name }}{{ $corp->address1 }}{{ $corp->address2 }}</li>　
                        </ul>
                      </div>
                    </div>
                    <h5>加入法人ユーザー一覧</h5>

                  <!--法人ユーザー一覧表示-->
                  <div class="index-pc-table">
                      <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                             aria-describedby="example2_info">
                          <thead>
                          <tr role="row">
                              <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                  aria-sort="ascending"
                                  aria-label="Rendering engine: activate to sort column descending">
                                  id
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">名前
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                  aria-label="Platform(s): activate to sort column ascending">Email
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                  aria-label="CSS grade: activate to sort column ascending">ログインID
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                  aria-label="CSS grade: activate to sort column ascending">ボタン
                              </th>
                          </tr>
                        </thead>

                        <tbody>

              @forelse ($corp_user as $corp_user)
                  <tr role="row" class="odd">
                        <td class="sorting_1">{{ $corp_user->id }}</td>
                        <td>
                          {{ $corp_user->name }}
                        </td>
                          <td>
                            {{ $corp_user->email }}
                          </td>
                          <td>
                            {{ $corp_user->login_id }}
                          </td>
                          <td>
                            <a href="{{ action('CorpsController@show', $corp) }}" class="btn btn-outline-warning">
                              詳細
                            </a>

                            <a href="{{ action('CorpsController@edit', $corp) }}" class="btn btn-outline-info">
                                編集
                            </a>

                            <a href="#" class="del btn btn-outline-danger" data-toggle="modal"
                               data-target="#delete_Modal" data-id="{{ $corp->id }}">
                                削除
                            </a>
                            <form action="{{ url('/corps', $corp->id ) }}" method="post"
                              id="form_{{ $corp->id }}">
                              {{ csrf_field() }}
                              {{ method_field('delete') }}
                            </form>
                      </td>
                      @empty
                        'データが空です'
                      @endforelse
                  </tr>
                  </tbody>

                                              <div class="modal fade" id="delete_Modal">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">削除しますか？</div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-primary">削除</button>
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                                     </div>
                                                  </div>
                                                </div>
                                              </div>


                                          </table>
                                      </div>
                                      <div class="index-phone-table">
                                          <ul class="todo-list ui-sortable">
                                              <li>
                                                  <!-- drag handle -->
                                                  <span class="handle ui-sortable-handle">
                                                          <i class="fa fa-ellipsis-v"></i>
                                                          <i class="fa fa-ellipsis-v"></i>
                                                        </span>
                                                  <!-- checkbox -->
                                                  <input type="checkbox" value="" name="">
                                                  <!-- todo text -->
                                                  <span class="text">アカウント名1</span>
                                              </li>
                                          </ul>
                                      </div>
                                      <div class="index-pagination-container">
                                          <ul class="pagination pagination-sm">
                                              <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                              <li class="page-item"><a href="#" class="page-link">1</a></li>
                                              <li class="page-item"><a href="#" class="page-link">2</a></li>
                                              <li class="page-item"><a href="#" class="page-link">3</a></li>
                                              <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                                          </ul>
                                      </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
