<?php

namespace App\Http\Controllers;

use App\Models\Corp;
use App\Models\CorpUser;
use App\Models\Plan;
use App\Models\PaymentMethod;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use App\Http\Requests\CorpRequest;
use App\Http\Requests\CorpRegisterRequest;


class CorpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $corps = Corp::all();
        $plan = Plan::latest()->get();
        $corp = Corp::latest()->get();
        $payment_method = PaymentMethod::latest()->get();
        $prefecture = Prefecture::all();
        return view('corps.index')->with('corps', $corp)->with('plans', $plan)
                                  ->with('payment_methods', $payment_method)
                                  ->with('prefecture', $prefecture);

    }

    public function show(Corp $corp)
    {
      $corp_user = CorpUser::all();
      $plan = Plan::all();
      $prefecture = Prefecture::all();
      return view('corps.show')->with('corp', $corp)
                               ->with('corp_user', $corp_user)
                               ->with('prefecture', $prefecture)
                               ->with('plan', $plan);
    }



    public function create(Corp $corp)
    {
        // $corp = Corp::latest();
        $payment_method = PaymentMethod::all();
        $plan = Plan::all();
        $prefecture = Prefecture::all();
        return view('corps.create')->with('corp', $corp)->with('plan', $plan)->with('payment_method', $payment_method)->with('prefecture', $prefecture);
    }

    public function store(CorpRequest $request, $id)
    {

      $cost = Cost::findOrFail($id);
      $plan = Plan::findOrFail($id);
      $payment_method = PaymentMethod::findOrFail($id);
      $prefecture = Prefecture::findOrFail($id);

      $corp->name = $request->input('name');
      $plan->name = $request->input('name');
      $corp->credit_key = $request->input('credit_key');
      $corp->payment_status = $request->input('payment_status');
      $payment_method->name =$request->input('name');
      $corp->payment_date =$request->input('payment_date');
      $corp->postal_code =$request->input('postal_code');
      $prefecture->name =$request->input('name');
      $corp->address1 =$request->input('address1');
      $corp->address2 =$request->input('address2');
      $corp->save();
      return redirect('/');

    }

    public function edit(Request $request, $id)
    {

      // $plan = Plan::latest()->get();
      // $payment_method = PaymentMethod::all();
      // $plan = Plan::all();
      // $prefecture = Prefecture::all();
      $corp = Corp::findOrFail($id);
      // eval(\Psy\sh());
      $payment_method = PaymentMethod::findOrFail($id);
      $plan = Plan::findOrFail($id);
      $prefecture = Prefecture::findOrFail($id);
      return view('corps.edit')->with('corp', $corp)->with('plan', $plan)
      ->with('payment_method', $payment_method->name)->with('prefecture', $prefecture);
    }

    public function update(CorpRequest $request, $id)
    {
      $corp->name = $request->input('name');
      $corp->plan_id = $request->input('plan_id');
      $corp->credit_key = $request->input('credit_key');
      $corp->payment_status = $request->input('payment_status');
      $corp->payment_method_id =$request->input('payment_method_id');
      $corp->payment_date =$request->input('payment_date');
      $corp->postal_code =$request->input('postal_code');
      $corp->prefecture_id =$request->input('prefecture_id');
      $corp->address1 =$request->input('address1');
      $corp->address2 =$request->input('address2');

      $corp->save();
      return redirect('/');

    }

    public function register(Request $request)
    {
        $plan = Plan::where('path', '')
            ->select('id', 'name')
            ->get();
        $paymentMethod = PaymentMethod::where('path', '')
            ->select('id', 'name')
            ->get();
        $prefecture = Prefecture::where('path', '')
            ->select('id', 'name')
            ->get();
        return view('corps.register')
            ->with('plans', $plans)
            ->with('paymentMethods', $paymentMethods)
            ->with('prefectures', $serviceCategories);
    }

    public function destroy(Corp $corp)
    {

      $id = $request->input('id', '');

      $corp = Corp::find($id);

     DB::beginTransaction();
      try {
          $name = $corp->name;

          DB::table('plan')
              ->where('corp_id', $id)
              ->delete();
          DB::table('payment_method')
              ->where('corp_id', $id)
              ->delete();
          DB::table('prefecture')
              ->where('corp_id', $id)
              ->delete();
          $corp->delete();
          DB::commit();
          return redirect('/corps')->with('success', $title . 'の削除が完了しました。');
      } catch (\Exception $e) {

          DB::rollBack();
          return redirect('/corps')->with('warning', $title . 'を削除できませんでした。');
      }
    }
}
