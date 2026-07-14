<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationFixture
 */
class ApplicationFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'application';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'program_id' => 1,
                'faculty_id' => 1,
                'company_name' => 'Lorem ipsum dolor sit amet',
                'company_street1' => 'Lorem ipsum dolor sit amet',
                'company_street2' => 'Lorem ipsum dolor sit amet',
                'company_postcode' => 'Lorem ipsum dolor sit amet',
                'company_city' => 'Lorem ipsum dolor sit amet',
                'company_state' => 'Lorem ipsum dolor sit amet',
                'group_leader_name' => 'Lorem ipsum dolor sit amet',
                'group_leader_phone' => 'Lorem ipsum dolor sit amet',
                'group_leader_email' => 'Lorem ipsum dolor sit amet',
                'Team_member' => 1,
                'date_interview' => '2026-06-21 13:29:59',
                'status' => 1,
                'method' => 'Lorem ipsum dolor sit amet',
                'approval_status' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-06-21 13:29:59',
                'modified' => '2026-06-21 13:29:59',
            ],
        ];
        parent::init();
    }
}
