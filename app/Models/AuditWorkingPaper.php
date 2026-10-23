<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuditWorkingPaper extends Model {
    protected $guarded = ['id'];

    public function schedule() {
        return $this->belongsTo(ReviewSchedule::class, 'review_schedule_id');
    }

    public function guideline() {
        return $this->belongsTo(WorkGuideline::class, 'work_guideline_id');
    }
}
