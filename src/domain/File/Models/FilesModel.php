<?php

namespace Src\domain\File\Models;

use Illuminate\Database\Eloquent\Model;

class FilesModel extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'name',
        'extension',
        'sent_at'
    ];

    public function content()
    {
        return $this->hasMany(FileContentModel::class, 'file_id', 'id');
    }
}
