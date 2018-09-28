@extends('layouts.default')
@section('content')

<!-- <style>
  .corp-index th{
    font-size: 10px;
  }
</style> -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">一覧</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">一覧
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">検索</h3>
                </div>
                <!-- /.card-header -->
                <form role="form" action="{{url('/corps')}}" method="get">
                    <div class="card-body">
                        <div class="form-group">
                            <label>法人名</label>
                            <input type="text" name="name" class="form-control"
                                   @if(isset($inputs['name']))
                                   value="{{$inputs['name']}}"
                                   @endif
                                   placeholder="法人名を入力">
                        </div>
                        <div class="form-group">
                            <label>都道府県</label>
                            <input type="text" name="prefecture" class="form-control"
                                   @if(isset($inputs['prefecture']))
                                   value="{{$inputs['prefecture']}}"
                                   @endif
                                   placeholder="都道府県を入力">
                        </div>
                        <div class="form-group">
                            <label>住所</label>
                            <input type="text" name="address" class="form-control"
                                   @if(isset($inputs['address']))
                                   value="{{$inputs['address']}}"
                                   @endif
                                   placeholder="住所を入力">
                        </div>
                        <div class="form-group">
                            <label>プラン名</label>
                            <input type="text" name="plan" class="form-control"
                                   @if(isset($inputs['plan']))
                                   value="{{$inputs['plan']}}"
                                   @endif
                                   placeholder="プラン名を入力">
                        </div>
                        <div class="form-group">
                            <label>支払い方法</label>
                            <input type="text" name="payment_method" class="form-control"
                                   @if(isset($inputs['payment_method']))
                                   value="{{$inputs['payment_method']}}"
                                   @endif
                                   placeholder="支払い方法を入力">
                        </div>
                        <div class="form-group">
                            <label>支払い状況</label>
                            <input type="text" name="payment_status" class="form-control"
                                   @if(isset($inputs['payment_status']))
                                   value="{{$inputs['payment_status']}}"
                                   @endif
                                   placeholder="支払い状況を入力">
                        </div>

                        <div class="form-group">
                            <label>次回支払日開始</label>
                            <input type="text" name="payment_date_start" class="form-control date"
                                   @if(isset($inputs['payment_date_start']))
                                   value="{{$inputs['payment_date_start']}}"
                                   @endif
                                   placeholder="掲載期間開始日を入力">
                        </div>

                        <div class="form-group">
                            <label>次回支払日終了</label>
                            <input type="text" name="payment_date_end" class="form-control date"
                                   @if(isset($inputs['payment_date_end']))
                                   value="{{$inputs['payment_date_end']}}"
                                   @endif
                                   placeholder="掲載期間終了日を入力">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="search-btn" type="submit" class="btn btn-primary">以上の条件で検索する</button>
                    </div>
                    <input id="order-column" type="hidden" name="order.column" value="id">
                    <input id="order-ad" type="hidden" name="order.ad" value="asc">
                </form>

                <!-- /.card-body -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        一覧
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="index-add-tn-container">
                        <form action="{{url('/features/register')}}" method="get">
                        <!-- <button type="button" class="btn btn-info float-right"> -->
                          <a href="/corps/create" class="btn btn-info float-right"><i class="fa fa-plus"></i>新規作成</a>
                        <!-- </button> -->
                      </form>
                    </div>
                    <div class="mb-3">
                        <select id="index-order" onchange="sortIndex()" class="form-control col-lg-5">
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'id' && $inputs['order_ad'] === 'asc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="id" data-order-ad="asc">
                                IDを昇順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'id' && $inputs['order_ad'] === 'desc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="id" data-order-ad="desc">
                                IDを降順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'title' && $inputs['order_ad'] === 'asc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="title" data-order-ad="asc">
                                法人名を昇順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'title' && $inputs['order_ad'] === 'desc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="title" data-order-ad="desc">
                                法人名を降順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'posting_start' && $inputs['order_ad'] === 'asc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="posting_start" data-order-ad="asc">
                                	次回支払日開始を昇順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'posting_start' && $inputs['order_ad'] === 'desc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="posting_start" data-order-ad="desc">
                                	次回支払日開始を降順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'posting_end' && $inputs['order_ad'] === 'asc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="posting_end" data-order-ad="asc">
                                	次回支払日終了を昇順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'posting_end' && $inputs['order_ad'] === 'desc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="posting_end" data-order-ad="desc">
                                	次回支払日終了を降順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'created_at' && $inputs['order_ad'] === 'asc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="created_at" data-order-ad="asc">
                                作成日を昇順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'created_at' && $inputs['order_ad'] === 'desc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="created_at" data-order-ad="desc">
                                作成日を降順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'updated_at' && $inputs['order_ad'] === 'asc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="updated_at" data-order-ad="asc">
                                更新日を昇順で並び替え
                            </option>
                            <option
                                    @if(isset($inputs['order_column']) && isset($inputs['order_ad']))
                                    @if($inputs['order_column'] === 'updated_at' && $inputs['order_ad'] === 'desc')
                                    selected
                                    @endif
                                    @endif
                                    data-order-column="updated_at" data-order-ad="desc">
                                更新日を降順で並び替え
                            </option>
                        </select>
                    </div>



                    <div class="index-pc-table">
                        <table id="corp_table" class="table table-bordered table-hover dataTable" role="grid"
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
                                    aria-label="Platform(s): activate to sort column ascending">住所
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">プラン名
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">支払い方法
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">支払い状況
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">次回支払日
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">作成日時
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">更新日時
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">ボタン
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                              <ul>


                        @forelse ($corps as $corp)
                            <tr role="row" class="odd">
                                  <td class="sorting_1">{{ $corp->id }}</td>
                                  <td><a href="{{ action('CorpsController@edit', $corp) }}">{{ $corp->name }}</a></td>
                                  <td>{{ $corp->address1 }}{{ $corp->address2 }}</td>
                                  <td>{{$corp->plans->name}}</td>

                                  <td>{{ $corp->payment_methods->name }}</td>
                                  <td>{{ $corp->payment_status }}</td>
                                  <td>{{ $corp->payment_date }}</td>
                                  <td>{{ $corp->created_at }}</td>
                                  <td>{{ $corp->updated_at }}</td>
                                  <td>
                                    <div class="botton">
                                      <a href="{{ action('CorpsController@show', $corp) }}" class="btn-sm btn-outline-warning">
                                        詳細
                                      </a>
                                    </div>

                                    <div class="botton">
                                      <a href="{{ action('CorpsController@edit', $corp) }}" class="btn-sm btn-outline-info">
                                          編集
                                      </a>
                                    </div>

                                    <div class="botton">
                                      <a href="#" class="del btn-sm btn-outline-danger" data-toggle="modal"
                                         data-target="#delete_Modal" data-id="{{ $corp->id }}">
                                          削除
                                      </a>
                                      <form action="{{ url('/corps', $corp->id ) }}" method="post"
                                        id="form_{{ $corp->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                      </form>
                                    </div>
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
