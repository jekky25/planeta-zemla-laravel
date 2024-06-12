<?php

namespace App\Actions;

use App\Requests\VoteCommentRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Vote;

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

		$comment = Comment::getById($id);
		if (count ($comment->votes) > 0) abort(404);

		$ip = request()->ip();
		$date 		= \Carbon\Carbon::parse()->format(self::$dateFormatForDb);

		$aFields = [
			'commentid' => $id,
			'userid' 	=> 0,
			'ip'	 	=> $ip,
			'date'	 	=> $date,
			'value' 	=> $vote
		];

		$oVote = new Vote ($aFields);
		$oVote->save();

		if ($vote == '1')
			$comment->isgood = $comment->isgood + 1;
		else
			$comment->ispoor = $comment->ispoor + 1;

		$comment->save();

		$oPost 		= new Post();
		$voteClass 	= $oPost->getVoteClass();
		
		$comment->voteClassOut = $voteClass[0];
		if ($comment['isgood'] > $comment['ispoor']) $comment->voteClassOut = $voteClass[1];
		if ($comment['isgood'] < $comment['ispoor']) $comment->voteClassOut = $voteClass[-1];
		$comment['voteCount'] =  $comment['isgood'] - $comment['ispoor'];


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
