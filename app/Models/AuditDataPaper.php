<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuditDataPaper extends Model {
    protected $guarded = ['id'];

    public function schedule() {
        return $this->belongsTo(ReviewSchedule::class, 'review_schedule_id');
    }
}
