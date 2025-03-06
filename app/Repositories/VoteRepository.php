<?php

namespace App\Repositories;
use App\Interfaces\VoteInterface;
use App\Models\Vote;

class VoteRepository implements VoteInterface {
	/**
	* create a vote
	* @param  array $fields
	* @return void
	*/	
	public function create($fields) {
		try {
			$checkFields = [
				'commentid' => $fields['commentid'],
				'ip'	 	=> $fields['ip']
			];
			Vote::updateOrCreate($checkFields, $fields);
		} catch (\Exception $e) {
			throw new \Exception('Failed to create a vote '.$e->getMessage());
		}
	}
}