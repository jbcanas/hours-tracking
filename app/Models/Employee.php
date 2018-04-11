<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Employee extends Model
{
    use Searchable;

    public $asYouType = true;
    protected $guarded = [];
    protected $table = 'Employees';

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'employee_number' => $this->employee_number,
            'company_number' => $this->company_number,
        ];
        return $array;
    }
}
