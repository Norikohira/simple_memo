<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemoController extends Controller
{
    private $memo;

    public function __construct(Memo $memo){
        $this->memo = $memo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_memos = Memo::all();
        return view('home')
            ->with('all_memos', $all_memos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'memo' => 'required|string|max:99',
        ], [
            'memo.required' => 'メモ内容は必ず指定してください。',
            'memo.max' => 'メモ内容は、99文字以下で指定してください。',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->memo->memo = $request->memo;
        $this->memo->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Memo $memo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $memo = Memo::findOrFail($id);

        return view('edit', compact('memo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'memo' => 'required|string|max:99',
        ], [
            'memo.required' => 'メモ内容は必ず指定してください。',
            'memo.max' => 'メモ内容は、99文字以下で指定してください。',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $memo = Memo::findOrFail($id); // IDに対応するメモを取得
        $memo->memo = $request->memo;
        $memo->save();

        return redirect()->route('home');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $memo = $this->memo->findOrFail($id);
        $memo->delete(); // メモを削除

        return redirect()->route('home');
    }
}
