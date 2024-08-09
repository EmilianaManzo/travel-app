<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

        // Utilizza la tabella 'travels' perchè oggi ha deciso di cercare la tabella al singolare a cazzo
        protected $table = 'travels';

        protected $fillable = [
            'name',
            'slug',
            'start_date',
            'end_date',
            'days',
            'description',
            'photo',
            'vote',
        ];

        public function stops(){
            return $this->hasMany(Stop::class);
        }

        // funzione per far apparire lo slug nella url al posto dell'id
        public function getRouteKeyName()
        {
            return 'slug';
        }
}
