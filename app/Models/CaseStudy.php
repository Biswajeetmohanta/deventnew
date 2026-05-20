<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $table = 'case_studies';

    protected $fillable = [
        'title',
        'slug',
        'client',
        'industry_id',
        'description',
        'image',
        'link',
        'is_active',
        'content_data',
        'order'
    ];

    protected $casts = [
        'content_data' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the industry that this case study belongs to.
     */
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    /**
     * Get the technologies used in this case study.
     */
    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'case_study_technology', 'case_study_id', 'technology_id');
    }
}
