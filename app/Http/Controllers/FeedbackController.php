<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedBackRequest;
use Inertia\Inertia;
use App\Services\EmailService;

class FeedbackController extends Controller
{
	/**
	 * Show a feedBack page
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function get()
	{
		$title = 'Обратная связь, Земля как планета';
		return Inertia::render('FeedBack', ['title'		=> $title]);
	}

	/**
	 * send a message from the feeBack page
	 * @param FeedBackRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function send(FeedBackRequest $request, EmailService $email)
	{
		$email->send($request->validated(), 'feedback');
		return response()->json(['success' => 1]);
	}
}
