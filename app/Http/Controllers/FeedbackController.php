<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedBackRequest;
use App\Http\Controllers\Controller;
use App\Services\EmailService;
use App\Jobs\SendFeedBackJob;
use Inertia\Inertia;

class FeedbackController extends Controller
{
	/**
	 * Show a feedBack page
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function get()
	{
		return Inertia::render('FeedBack', ['title'		=> 'Обратная связь, Земля как планета']);
	}

	/**
	 * send a message from the feeBack page
	 * @param FeedBackRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function send(FeedBackRequest $request, EmailService $email)
	{
		$email->send($request->validated(), SendFeedBackJob::class);
		return response()->json(['success' => 1]);
	}
}
