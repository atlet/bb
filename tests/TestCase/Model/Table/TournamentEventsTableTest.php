<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TournamentEventsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TournamentEventsTable Test Case
 */
class TournamentEventsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TournamentEventsTable
     */
    protected $TournamentEvents;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TournamentEvents',
        'app.Tournaments',
        'app.Competitors',
        'app.TournamentMatches',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TournamentEvents') ? [] : ['className' => TournamentEventsTable::class];
        $this->TournamentEvents = $this->getTableLocator()->get('TournamentEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TournamentEvents);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TournamentEventsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\TournamentEventsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
