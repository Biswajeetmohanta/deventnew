<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Rename portfolios table to case_studies
        if (Schema::hasTable('portfolios') && !Schema::hasTable('case_studies')) {
            Schema::rename('portfolios', 'case_studies');
        }

        // 2. Add content_data, industry_id and order columns to case_studies
        Schema::table('case_studies', function (Blueprint $table) {
            if (!Schema::hasColumn('case_studies', 'content_data')) {
                $table->json('content_data')->nullable()->after('link');
            }
            if (!Schema::hasColumn('case_studies', 'industry_id')) {
                // We use nullable and onDelete('set null') to prevent deleting case studies when an industry is removed.
                $table->foreignId('industry_id')->nullable()->after('client')->constrained('industries')->onDelete('set null');
            }
            if (!Schema::hasColumn('case_studies', 'order')) {
                $table->integer('order')->default(0)->after('is_active');
            }
        });

        // 3. Rename portfolio_technology table to case_study_technology
        if (Schema::hasTable('portfolio_technology') && !Schema::hasTable('case_study_technology')) {
            Schema::rename('portfolio_technology', 'case_study_technology');
        }

        // 4. Update foreign key constraints in case_study_technology
        Schema::table('case_study_technology', function (Blueprint $table) {
            // Drop old foreign key constraint if it exists.
            try {
                $table->dropForeign('portfolio_technology_portfolio_id_foreign');
            } catch (\Exception $e) {
                try {
                    $table->dropForeign(['portfolio_id']);
                } catch (\Exception $ex) {
                    // Ignore if constraint doesn't exist
                }
            }

            // Rename the column
            if (Schema::hasColumn('case_study_technology', 'portfolio_id') && !Schema::hasColumn('case_study_technology', 'case_study_id')) {
                $table->renameColumn('portfolio_id', 'case_study_id');
            }
        });

        Schema::table('case_study_technology', function (Blueprint $table) {
            // Re-create the foreign key constraint
            $table->foreign('case_study_id')->references('id')->on('case_studies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_study_technology', function (Blueprint $table) {
            try {
                $table->dropForeign(['case_study_id']);
            } catch (\Exception $e) {
            }

            if (Schema::hasColumn('case_study_technology', 'case_study_id') && !Schema::hasColumn('case_study_technology', 'portfolio_id')) {
                $table->renameColumn('case_study_id', 'portfolio_id');
            }
        });

        if (Schema::hasTable('case_study_technology')) {
            Schema::table('case_study_technology', function (Blueprint $table) {
                $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
            });
        }

        if (Schema::hasTable('case_study_technology') && !Schema::hasTable('portfolio_technology')) {
            Schema::rename('case_study_technology', 'portfolio_technology');
        }

        Schema::table('case_studies', function (Blueprint $table) {
            if (Schema::hasColumn('case_studies', 'content_data')) {
                $table->dropColumn('content_data');
            }
            if (Schema::hasColumn('case_studies', 'industry_id')) {
                try {
                    $table->dropForeign(['industry_id']);
                } catch (\Exception $e) {}
                $table->dropColumn('industry_id');
            }
            if (Schema::hasColumn('case_studies', 'order')) {
                $table->dropColumn('order');
            }
        });

        if (Schema::hasTable('case_studies') && !Schema::hasTable('portfolios')) {
            Schema::rename('case_studies', 'portfolios');
        }
    }
};
