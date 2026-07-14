<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProgramsFixture
 */
class ProgramsFixture extends TestFixture
{
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
                'faculty_id' => 1,
                'code' => 'Lorem ipsum dolor ',
                'name' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2026-06-21 13:24:01',
                'modified' => '2026-06-21 13:24:01',
            ],
        ];
        parent::init();
    }
}
