<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTournamentSchema extends AbstractMigration
{
    public function change(): void
    {
        /**
         * PLAYERS
         */
        $this->table('players')
            ->addColumn('first_name', 'string', [
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('last_name', 'string', [
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('gender', 'string', [
                'limit' => 1,
                'null' => true, // M / F
            ])
            ->addColumn('rating', 'decimal', [
                'precision' => 5,
                'scale' => 2,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->create();

        /**
         * TOURNAMENTS
         */
        $this->table('tournaments')
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('location', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('starts_on', 'date', ['null' => true])
            ->addColumn('ends_on', 'date', ['null' => true])
            ->addColumn('status', 'string', [
                'limit' => 20,
                'default' => 'draft', // draft, active, finished
                'null' => false,
            ])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->create();

        /**
         * TOURNAMENT_EVENTS (kategorije)
         */
        $this->table('tournament_events')
            ->addColumn('tournament_id', 'integer', ['null' => false])
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('code', 'string', [
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('status', 'string', [
                'limit' => 20,
                'default' => 'active', // active, finished, ...
                'null' => false,
            ])
            ->addColumn('best_of_games', 'integer', [
                'default' => 3,
                'null' => false,
            ])
            ->addColumn('points_per_game', 'integer', [
                'default' => 21,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addForeignKey('tournament_id', 'tournaments', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->create();

        /**
         * COMPETITORS (posameznik ali par v eventu)
         */
        $this->table('competitors')
            ->addColumn('tournament_event_id', 'integer', ['null' => false])
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('is_team', 'boolean', [
                'default' => true,
                'null' => false,
            ])
            ->addColumn('seed', 'integer', ['null' => true])
            ->addColumn('wins', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->addColumn('losses', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addForeignKey('tournament_event_id', 'tournament_events', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->create();

        /**
         * COMPETITOR_PLAYERS (kateri igralci so v paru)
         */
        $this->table('competitor_players')
            ->addColumn('competitor_id', 'integer', ['null' => false])
            ->addColumn('player_id', 'integer', ['null' => false])
            ->addColumn('position', 'integer', [
                'default' => 1,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addForeignKey('competitor_id', 'competitors', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('player_id', 'players', 'id', [
                'delete' => 'RESTRICT',
                'update' => 'NO_ACTION',
            ])
            ->addIndex(['competitor_id', 'position'], ['unique' => true])
            ->addIndex(['competitor_id', 'player_id'], ['unique' => true])
            ->create();

        /**
         * COURTS (igrišča znotraj turnirja)
         */
        $this->table('courts')
            ->addColumn('tournament_id', 'integer', ['null' => false])
            ->addColumn('name', 'string', [
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('sort_order', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addForeignKey('tournament_id', 'tournaments', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->create();

        /**
         * TOURNAMENT_MATCHES (posamezne tekme)
         * - dynamic pairing, brez winner_next_match_id & co
         */
        $this->table('tournament_matches')
            ->addColumn('tournament_event_id', 'integer', ['null' => false])
            ->addColumn('competitor1_id', 'integer', ['null' => true])
            ->addColumn('competitor2_id', 'integer', ['null' => true])
            ->addColumn('court_id', 'integer', ['null' => true])
            ->addColumn('status', 'string', [
                'limit' => 20,
                'default' => 'scheduled', // scheduled, in_progress, finished
                'null' => false,
            ])
            // rezultat v SETIH (dobljene igre)
            ->addColumn('current_score1', 'integer', ['null' => true])
            ->addColumn('current_score2', 'integer', ['null' => true])

            ->addColumn('winner_id', 'integer', ['null' => true])

            ->addColumn('started_at', 'datetime', ['null' => true])
            ->addColumn('finished_at', 'datetime', ['null' => true])

            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])

            ->addForeignKey('tournament_event_id', 'tournament_events', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('competitor1_id', 'competitors', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('competitor2_id', 'competitors', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('winner_id', 'competitors', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('court_id', 'courts', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
            ])
            ->create();
    }
}
