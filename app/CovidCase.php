<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CovidCase extends Model
{
    use SoftDeletes;

    public $table = 'covid_cases';

    const GENDER_SELECT = [
        'f' => 'female',
        'm' => 'male',
    ];

    const INFECTION_SOURCE_SELECT = [
        'local'  => 'Local Transmission',
        'import' => 'Imported case',
    ];

    const STATUS_SELECT = [
        'active'    => 'Active',
        'recovered' => 'Recovered',
        'deceased'  => 'Deceased',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_detected',
        'date_recovered',
        'symptomatic_date',
    ];

    protected $fillable = [
        'age',
        'status',
        'gender',
        'source_id',
        'deleted_at',
        'updated_at',
        'created_at',
        'description',
        'nationality',
        'deceased_date',
        'case_identity',
        'date_detected',
        'date_recovered',
        'symptomatic_date',
        'infection_source',
        'location_detected',
        'displayed_symptoms',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }


    public function setNationalityAttribute($value)
    {
        $this->attributes['nationality'] = strtoupper($value);
    }

    public function sourceCovidCases()
    {
        return $this->hasMany(CovidCase::class, 'source_id', 'id');

    }

    public function source()
    {
        return $this->belongsTo(CovidCase::class, 'source_id');

    }

    public function getDateDetectedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setDateDetectedAttribute($value)
    {
        $this->attributes['date_detected'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getSymptomaticDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setSymptomaticDateAttribute($value)
    {
        $this->attributes['symptomatic_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getDateRecoveredAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setDateRecoveredAttribute($value)
    {
        $this->attributes['date_recovered'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }
}
