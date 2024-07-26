<?php

namespace App\Actions;

use App\Requests\VoteCommentRequest;
use App\Repositories\CommentRepository;
use App\Repositories\VoteRepository;
use App\Repositories\PostRepository;

class SetVoteCommentAction
{
	public static $dateFormatForDb	= 'Y-m-d H:i:s';

	/**
	* add vote to the DB and show it on the page
	* @param  App\Requests\VoteCommentRequest $request
	* @return string JSON
	*/
	public static function handle(VoteCommentRequest $request)
	{
		$arParams = $request->post();
		if (empty ($arParams['jtxa'][0])) abort(404);
		
		$id 	= (int) $arParams['jtxa'][0];
		$vote 	= $arParams['jtxa'][1];
		if ($id == 0 || empty ($vote)) abort(404);

		$vote	= $vote == 1 ? $vote : '-1';

		$comment = CommentRepository::getById($id);
		if (count ($comment->votes) > 0) abort(404);

		$ip = $request->ip();
		$date 		= \Carbon\Carbon::parse()->format(self::$dateFormatForDb);

		$aFields = [
			'commentid' => $id,
			'userid' 	=> 0,
			'ip'	 	=> $ip,
			'date'	 	=> $date,
			'value' 	=> $vote
		];

		$oVoteRepository = new VoteRepository($aFields);
		$oVoteRepository->create($aFields);

		if ($vote == '1')
			$comment->isgood++;
		else
			$comment->ispoor++;

		$comment->save();

		$oPost 					= new PostRepository();
		$voteClass 				= $oPost->getVoteClass();
		$comment->voteClassOut 	= $comment['isgood'] > $comment['ispoor'] 		? $voteClass[1] 		: $voteClass[0];
		$comment->voteClassOut 	= $comment['isgood'] < $comment['ispoor'] 		? $voteClass[-1] 		: $comment->voteClassOut;
		$comment['voteCount'] 	= $comment['isgood'] - $comment['ispoor'];

		$str = '<span class="' . $comment->voteClassOut . '">' . $comment->voteCount . '</span>';
		$str = str_replace(["\r", "\n"], '', $str);
		$y = "jcomments.updateVote('" . $id . "','" . $str . "');";

		$arX = [
			"n" => "js",
			"d" => $y
		];
		$x = '[ ' . json_encode ($arX) . ' ]';

		return $x;
	}
}