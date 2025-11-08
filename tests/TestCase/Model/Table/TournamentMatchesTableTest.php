<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TournamentMatchesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TournamentMatchesTable Test Case
 */
class TournamentMatchesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TournamentMatchesTable
     */
    protected $TournamentMatches;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TournamentMatches',
        'app.TournamentEvents',
        'app.Competitor1s',
        'app.Competitor2s',
        'app.Winners',
        'app.Courts',
        'app.MatchGames',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TournamentMatches') ? [] : ['className' => TournamentMatchesTable::class];
        $this->TournamentMatches = $this->getTableLocator()->get('TournamentMatches', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TournamentMatches);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TournamentMatchesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\TournamentMatchesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
