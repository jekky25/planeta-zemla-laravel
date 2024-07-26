<?php

namespace App\Actions;

use App\Requests\GetCommentRequest;
use App\Repositories\PostRepository;

class GetCommentsAction
{
	/**
	* show commments over ajax on the web page
	* @param  \Illuminate\Http\Request  $request
	* @return string JSON
	*/
	public static function handle(GetCommentRequest $request)
	{
		$arParams = $request;
		if (empty ($arParams['jtxa'][0])) abort(404);
		$id = (int) $arParams['jtxa'][0];
		if ($id == 0) abort(404);

		$post   = (new PostRepository())->getById($id);
		$str = '
		<h4>Комментарии
			<a class="rss" href="' . route('comment_rss',[$post->category['alias'], $post->id,$post->alias]) . '" title="RSS лента комментариев этой записи" target="_blank">&nbsp;</a>
			<a class="refresh" href="#" title="Обновить список комментариев" onclick="jcomments.showPage(' . $post->id . ',`com_content`,0);return false;">&nbsp;</a>
		</h4>
		<div id="comments-list" class="comments-list">
		';

		$iteration = 0;		
		foreach ($post->comments as $item)
		{
			$iteration++;
			$str .= '<div class="even" id="comment-item-' . $item->id . '">
			<div class="rbox">
				<div class="rbox_tr">
					<div class="rbox_tl">
						<div class="rbox_t">&nbsp;</div>
					</div>
				</div>
				<div class="rbox_m">
					<div class="comment-box usertype-guest">
						<span class="comments-vote">
							<span id="comment-vote-holder-' . $item->id . '">
								<a href="#" class="vote-good" title="Хороший комментарий!" onclick="jcomments.voteComment(' . $item->id . ', 1);return false;"></a>
								<a href="#" class="vote-poor" title="Плохой комментарий!" onclick="jcomments.voteComment(' . $item->id . ', -1);return false;"></a>
								<span class="' . $item->voteClass . '">' . $item->voteCount . '</span>
							</span>
						</span>
						<a class="comment-anchor" href="' . route('item_name',[$post->category['alias'], $post->id,$post->alias]) . '#comment-' . $item->id . '" id="comment-' . $item->id . '">#' . $iteration . '</a>
						<span class="comment-author">' . $item->name . '</span>
						<span class="comment-date">' . $item->date . '</span>
						<div class="comment-body" id="comment-body-' . $item->id . '">' . $item->comment . '</div>
						<span class="comments-buttons">
							<a href="#" onclick="jcomments.quoteComment(' . $item->id . '); return false;">Цитировать</a>
						</span>
					</div>
					<div class="clear"></div>
				</div>
				<div class="rbox_br">
					<div class="rbox_bl">
						<div class="rbox_b">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>';
		}
		
		$str .= '</div>';
		$str .= '<div id="comments-list-footer">
			<a class="refresh" href="#" title="Обновить список комментариев" onclick="jcomments.showPage(' . $post->id . ',`com_content`,0);return false;">Обновить список комментариев</a>
			<br />
			<a class="rss" href="' . route('comment_rss',[$post->category['alias'], $post->id,$post->alias]) . '" target="_blank">RSS лента комментариев этой записи</a>
		</div>';

		$str = str_replace(["\r", "\n"], '', $str);

		$y = "jcomments.updateList('" . $str . "','r');";

		$x = '[ { "n": "js", "d": "' . $y . '" } ]';

		$arX = [
			"n" => "js",
			"d" => $y

		];

		$x = '[ ' . json_encode ($arX) . ' ]';

		return $x;
	}
}