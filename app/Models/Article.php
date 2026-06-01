<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'publication_date',
        'author_id'
    ];

    protected function casts(): array
    {
        return [
            'publication_date' => 'date',
        ];
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
