<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check and add indexes for goats table
        Schema::table('goats', function (Blueprint $table) {
            $indexes = collect(DB::select('SHOW INDEX FROM goats'))->pluck('Key_name')->toArray();
            
            if (!in_array('idx_goats_user_farm', $indexes)) {
                $table->index(['user_id', 'farm_id'], 'idx_goats_user_farm');
            }
            if (!in_array('idx_goats_created_at', $indexes)) {
                $table->index('created_at', 'idx_goats_created_at');
            }
            if (!in_array('idx_goats_gender', $indexes)) {
                $table->index('gender', 'idx_goats_gender');
            }
            if (!in_array('idx_goats_tag_number', $indexes)) {
                $table->index('tag_number', 'idx_goats_tag_number');
            }
        });

        // Check and add indexes for daily_checks table
        Schema::table('daily_checks', function (Blueprint $table) {
            $indexes = collect(DB::select('SHOW INDEX FROM daily_checks'))->pluck('Key_name')->toArray();
            
            if (!in_array('idx_daily_checks_user_date', $indexes)) {
                $table->index(['user_id', 'check_date'], 'idx_daily_checks_user_date');
            }
            if (!in_array('idx_daily_checks_date', $indexes)) {
                $table->index('check_date', 'idx_daily_checks_date');
            }
            if (!in_array('idx_daily_checks_created_at', $indexes)) {
                $table->index('created_at', 'idx_daily_checks_created_at');
            }
        });

        // Check and add indexes for daily_check_goat table (if it exists)
        if (Schema::hasTable('daily_check_goat')) {
            Schema::table('daily_check_goat', function (Blueprint $table) {
                $indexes = collect(DB::select('SHOW INDEX FROM daily_check_goat'))->pluck('Key_name')->toArray();
                
                if (!in_array('idx_daily_check_goat_ids', $indexes)) {
                    $table->index(['daily_check_id', 'goat_id'], 'idx_daily_check_goat_ids');
                }
                if (!in_array('idx_daily_check_goat_goat_id', $indexes)) {
                    $table->index('goat_id', 'idx_daily_check_goat_goat_id');
                }
            });
        }

        // Check and add indexes for farms table
        Schema::table('farms', function (Blueprint $table) {
            $indexes = collect(DB::select('SHOW INDEX FROM farms'))->pluck('Key_name')->toArray();
            
            if (!in_array('idx_farms_name', $indexes)) {
                $table->index('name', 'idx_farms_name');
            }
        });

        // Check and add indexes for users table
        Schema::table('users', function (Blueprint $table) {
            $indexes = collect(DB::select('SHOW INDEX FROM users'))->pluck('Key_name')->toArray();
            
            if (!in_array('idx_users_email', $indexes)) {
                $table->index('email', 'idx_users_email');
            }
            if (!in_array('idx_users_name', $indexes)) {
                $table->index('name', 'idx_users_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goats', function (Blueprint $table) {
            $table->dropIndex('idx_goats_user_farm');
            $table->dropIndex('idx_goats_created_at');
            $table->dropIndex('idx_goats_gender');
            $table->dropIndex('idx_goats_tag_number');
        });

        Schema::table('daily_checks', function (Blueprint $table) {
            $table->dropIndex('idx_daily_checks_user_date');
            $table->dropIndex('idx_daily_checks_date');
            $table->dropIndex('idx_daily_checks_created_at');
        });

        if (Schema::hasTable('daily_check_goat')) {
            Schema::table('daily_check_goat', function (Blueprint $table) {
                $table->dropIndex('idx_daily_check_goat_ids');
                $table->dropIndex('idx_daily_check_goat_goat_id');
            });
        }

        Schema::table('farms', function (Blueprint $table) {
            $table->dropIndex('idx_farms_name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_email');
            $table->dropIndex('idx_users_name');
        });
    }
};
