<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(<<<EOT
            CREATE MATERIALIZED VIEW events AS
            SELECT 'f' || id AS id, name || ' followed you!' AS message, user_id, read, created_at FROM followers
            UNION
            SELECT 's' || id AS id, name || ' (Tier' || tier || ') subscribed to you!' AS message, user_id, read, created_at FROM subscribers
            UNION
            SELECT 'd' || id AS id, name || ' donated ' || amount || ' ' || currency || ' to you! "' || message || '"' AS message, user_id, read, created_at FROM donations
            UNION
            SELECT 'p' || id AS id, name || ' bought ' || item || ' from you for ' || ROUND((price * quantity)::numeric, 2) || ' USD!' AS message, user_id, read, created_at FROM merch_sales
        EOT);

        DB::statement('CREATE UNIQUE INDEX events_unique_index ON events (id, message, user_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP MATERIALIZED VIEW IF EXISTS events');
    }
};
