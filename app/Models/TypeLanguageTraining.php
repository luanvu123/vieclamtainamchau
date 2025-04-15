<?php

// app/Models/TypeLanguageTraining.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeLanguageTraining extends Model
{
    use HasFactory;

    protected $table = 'type_language_training';

    protected $fillable = ['slug', 'name', 'status'];

    public function languageTrainings()
    {
        return $this->hasMany(LanguageTraining::class);
    }
}
