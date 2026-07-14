<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $program_id
 * @property int|null $faculty_id
 * @property string $company_name
 * @property string $company_street1
 * @property string $company_street2
 * @property string $company_postcode
 * @property string $company_city
 * @property string $company_state
 * @property string $group_leader_name
 * @property string $group_leader_phone
 * @property string $group_leader_email
 * @property int $Team_member
 * @property \Cake\I18n\DateTime $date_interview
 * @property int|null $status
 * @property string $method
 * @property string $approval_status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Faculty $faculty
 */
class Application extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'program_id' => true,
        'faculty_id' => true,
        'company_name' => true,
        'company_street1' => true,
        'company_street2' => true,
        'company_postcode' => true,
        'company_city' => true,
        'company_state' => true,
        'group_leader_name' => true,
        'group_leader_phone' => true,
        'group_leader_email' => true,
        'Team_member' => true,
        'date_interview' => true,
        'status' => true,
        'method' => true,
        'approval_status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'program' => true,
        'faculty' => true,
        'ref_no'=> true,
    ];
}
