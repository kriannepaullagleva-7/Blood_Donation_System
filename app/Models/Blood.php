<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Blood extends Model {
    protected $table = 'blood_donations';
    protected $fillable = [
        'donor_name', 
        'blood_type', 
        'bags', 
        'status', 
        'donation_date'
        ];
}