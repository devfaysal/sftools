<?php

namespace App\Http\Controllers;

use App\Actions\SmsSendingAction;
use App\Http\Requests\SmsRequest;
use App\Models\Sms;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SmsController extends Controller
{
    public function index()
    {
        return view('sms.index');
    }

    public function create()
    {
        $this->authorize('create', Sms::class);
        return view('sms.create');
    }

    public function send(SmsRequest $request, SmsSendingAction $smsSendingAction)
    {
        $attributes = $request->validated();
        $recipients = explode(PHP_EOL, $attributes['recipients']);
        $smsSendingAction(
            $recipients,
            $attributes['message']
        );
        session()->flash('message', 'Sms sent successfully!!');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('sms.index');
    }

    public function datatable()
    {
        $sms_of_current_month = Sms::where('user_id', auth()->user()->id)->whereMonth('created_at', now()->month);
        return DataTables::of($sms_of_current_month)
            ->addColumn('recipients', function($sms) {
                return implode(',', $sms->recipients()->pluck('phone')->toArray());
            })
            ->make(true);
    }
}
