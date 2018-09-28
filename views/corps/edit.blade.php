@extends('layouts.default')
@section('content')

<style>
/* 追加 */
  body {
    padding-top: 60px;
  }

  section {
    overflow: auto;
  }

  textarea {
    resize: vertical;
  }

  .center {
    text-align: center;
  }

  .parent{
    overflow: hidden;
  }


  .nav{
    justify-content: center;
  }

  input, textarea, select {
  border: 1px solid #bbb;
  width: 100%;
  margin-bottom: 15px;
  position: normal;
}


.content {
  justify-content: center;
}


</style>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">法人編集</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title center">
                        <i class="ion ion-clipboard mr-1"></i>
                        <a href="#"></a>{{ $corp->name }}
                    </h3>

                    <div class="nav">
                      <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="{{ url('/corps', $corp->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <label for="name">NAME:</label>
                          <input type="text" name="name" value="{{$corp->name}}" class="form-control">

                        <label for="payment_method_name">支払い方法</label>
                        <select class="form-control">
                          <option value="">{{$payment_method->name}}</option>
                          @foreach($payment_method as $payment_method )
                            <option value="{{ $payment_method->name }}">{{ $payment_method->name }}</option>
                          @endforeach
                        </select>
                        <label for="plan">プラン:</label>
                        <select class="form-control">
                          <option value="">{{$corp->plans->name}}</option>
                          @foreach($plan as $plan)
                            <option value="{{ $plan->name }}">{{ $plan->name }}</option>
                          @endforeach
                        </select>


                      <div class="form-group">
                        <label for="name2">次回支払日:</label>
                          <div class='input-group date' id='datepicker-default'>
                              <input type='text' class="form-control" value="{{ $corp->payment_date }}" />
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                      </div>
                      <label for="name2">支払い状況:</label>
                      <input type="text" name="payment_status" value="{{ $corp->payment_status }}" class="form-control">

                      <label for="name2">郵便番号:</label>
                        <input type="text" name="postal_code" value="{{ $corp->postal_code }}" class="form-control">

                      <label for="name2">都道府県:</label>
                      <select class="form-control">
                        <option value="">{{ $corp->prefectures->name }}</option>
                        @foreach($prefecture as $prefecture)
                          <option value="{{ $prefecture->name }}">{{ $prefecture->name }}</option>
                        @endforeach
                      </select>

                      <label for="name2">住所1:</label>
                        <input type="text" name="address1" value="{{ $corp->address1 }}" class="form-control">

                      <label for="name2">住所2:</label>
                        <input type="text" name="address2" value="{{ $corp->address2 }}" class="form-control">


                      </div>
                    </div></br>
                    <!-- <div class="parent"> -->
                      <div class="botton-back">
                        <a href="{{ action('CorpsController@index', $corp) }}" class="btn btn-outline-secondary">一覧に戻る</a>
                      <div class="botton-post">
                        <input type="submit" value="更新" class="btn btn-outline-success">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                      </div>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
    </section>
@endsection
