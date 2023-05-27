<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostingRequest;
use App\Models\BuchhaltungsbutlerAccounts;
use App\Models\Posting;
use App\Services\BuchhaltungsbutlerService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostingController extends Controller
{
    public function index()
    {
        return view('postings.index');
    }

    public function create()
    {
        return view('postings.create',[
            'accounts' => $this->availableAccounts(),
            'schedules' => $this->availableSchedules()
        ]);
    }

    public function store(PostingRequest $request)
    {
        $attributes = $request->validated();
        if($attributes['postingaccount_debit_other']){
            $attributes['postingaccount_debit'] = $attributes['postingaccount_debit_other'];
        }
        unset($attributes['postingaccount_debit_other']);
        if($attributes['postingaccount_credit_other']){
            $attributes['postingaccount_credit'] = $attributes['postingaccount_credit_other'];
        }
        unset($attributes['postingaccount_credit_other']);
        $posting = auth()->user()->postings()->create($attributes);
        if($posting){
            return redirect()
                ->route('postings.index')
                ->with('message', 'Posting added uccessfully')
                ->with('alert-class', 'alert-success');
        }
    }

    public function show(Posting $posting)
    {
        return view('postings.show', [
            'posting' => $posting
        ]);
    }

    public function edit(Posting $posting)
    {
        return view('postings.edit', [
            'posting' => $posting,
            'accounts' => $this->availableAccounts(),
            'schedules' => $this->availableSchedules()
        ]);
    }

    public function update(Posting $posting, PostingRequest $request)
    {
        $attributes = $request->validated();
        if ($attributes['postingaccount_debit_other']) {
            $attributes['postingaccount_debit'] = $attributes['postingaccount_debit_other'];
        }
        unset($attributes['postingaccount_debit_other']);
        if ($attributes['postingaccount_credit_other']) {
            $attributes['postingaccount_credit'] = $attributes['postingaccount_credit_other'];
        }
        unset($attributes['postingaccount_credit_other']);
        $posting->update($attributes);
        return redirect()
            ->route('postings.index')
            ->with('message', 'Posting updated successfully')
            ->with('alert-class', 'alert-success');
    }

    public function datatable()
    {
        $postings = Posting::where('user_id', auth()->user()->id);
        return DataTables::of($postings)
            ->addColumn('action', function ($posting) {
                $string = '';
                $string .= ' <a class="btn btn-sm btn-oval btn-primary" href="' . route('postings.show', $posting) . '">Details</a>';
                return $string;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function availableSchedules()
    {
        $schedules = range(1,27);
        $schedules[] = 'Last day of Month';

        return $schedules;
    }

    public function availableAccounts()
    {
        $accounts = BuchhaltungsbutlerAccounts::where('user_id', auth()->user()->id)->get();
        $account_options = [];
        foreach ($accounts as $account) {
            $account_options[$account['postingaccount_number']] = $account['name'] . ' (' . $account['postingaccount_number'] . ')';
        }
        $account_options['Other'] = 'Other';
        return $account_options;
    }

    public function postNow(Posting $posting, BuchhaltungsbutlerService $buchhaltungsbutler)
    {
        $result = $buchhaltungsbutler->addFreePosting($posting);
        dd($result);
        if(200 === $result){
            return redirect()
            ->route('postings.index')
            ->with('message', 'Posted to Buchhaltungsbutler successfully')
            ->with('alert-class', 'alert-success');
        }else{

        }
    }
}
