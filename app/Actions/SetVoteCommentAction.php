<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\CommentRepository;
use App\Repositories\VoteRepository;

class SetVoteCommentAction
{
	public static $dateFormatForDb	= 'Y-m-d H:i:s';

	/**
	* add vote to the DB and show it on the page
	* @param  array $arParams
	* @param  int $id
	* @return bool
	*/
	public static function handle($arParams, $id)
	{
		try {
			DB::beginTransaction();

			$comment = (new CommentRepository())->getById($id);

			$vote = $arParams['vote'];
			$comment->isgood = $comment->votes->where('value', 1)->count();
			$comment->ispoor = $comment->votes->where('value', -1)->count();
			$vote == '1' ? $comment->isgood++ : $comment->ispoor++;
			$comment->save();

			$ip		= request()->ip();
			$date	= Carbon::now()->format(self::$dateFormatForDb);

			$aFields = [
				'commentid' => $id,
				'userid' 	=> 0,
				'ip'	 	=> $ip,
				'date'	 	=> $date,
				'value' 	=> $vote
			];

			$oVoteRepository = new VoteRepository($aFields);
			$oVoteRepository->create($aFields);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new \Exception('Failed to make an update a vote '.$e->getMessage());
		}
		return true;
	}
}