<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MatchGamesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MatchGamesTable Test Case
 */
class MatchGamesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MatchGamesTable
     */
    protected $MatchGames;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.MatchGames',
        'app.Matches',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MatchGames') ? [] : ['className' => MatchGamesTable::class];
        $this->MatchGames = $this->getTableLocator()->get('MatchGames', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MatchGames);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\MatchGamesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\MatchGamesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
