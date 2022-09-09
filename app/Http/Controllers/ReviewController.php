<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Reserve;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(ReviewRequest $request)
    {
      $reserve = Reserve::where('id', $request->reserve_id)->where('user_id', Auth::id())->where('shop_id', $request->shop_id)->first();
      
      $evaluation = $request->evaluation;
      $comment = $request->comment;

      Review::create([
          'reserve_id' => $reserve->id,
          'evaluation' => $evaluation,
          'comment' => $comment,
      ]);
      
      return redirect()->back()->with('message', 'レビューありがとうございます。リストは日時順になっております。');
    }
}
