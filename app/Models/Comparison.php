<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    use HasFactory;

    protected $fillable = ['item1_id', 'item2_id', 'votes_item1', 'votes_item2'];

    public function item1()
    {
        return $this->belongsTo(Item::class, 'item1_id');
    }

    public function item2()
    {
        return $this->belongsTo(Item::class, 'item2_id');
    }

    public function updateVotes()
    {
        $votesItem1 = $this->votes()->where('item_id', $this->item1_id)->count();
        $votesItem2 = $this->votes()->where('item_id', $this->item2_id)->count();
        $totalVotes = $votesItem1 + $votesItem2;

        $this->votes_item1 = $totalVotes ? round(($votesItem1 / $totalVotes) * 100) : 0;
        $this->votes_item2 = $totalVotes ? round(($votesItem2 / $totalVotes) * 100) : 0;
        $this->save();
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
