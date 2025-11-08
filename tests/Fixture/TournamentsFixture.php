<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TournamentsFixture
 */
class TournamentsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'location' => 'Lorem ipsum dolor sit amet',
                'starts_on' => '2025-11-07',
                'ends_on' => '2025-11-07',
                'status' => 'Lorem ipsum dolor ',
                'created' => 1762542422,
                'modified' => 1762542422,
            ],
        ];
        parent::init();
    }
}
