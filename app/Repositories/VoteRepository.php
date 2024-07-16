<?php

namespace App\Repositories;
use App\Interfaces\VoteInterface;
use App\Models\Vote;

class VoteRepository implements VoteInterface {
    /**
	* create a vote
	* @param  array $request
	* @return void
	*/	
    public function create($request) {
        try {
            Vote::create($request);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create a vote '.$e->getMessage());
        }
    }

}