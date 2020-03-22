<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VoteList Entity
 *
 * @property int $ID
 * @property string $n_group
 * @property string $start_election
 * @property string $end_election
 * @property string $vote_secret
 */
class VoteList extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'n_group' => true,
        'start_election' => true,
        'end_election' => true,
        'vote_secret' => true,
    ];
}
