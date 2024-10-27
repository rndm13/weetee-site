<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentationAsset extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'generated_name',
        'documentation_page_id',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(DocumentationPage::class);
    }
}
