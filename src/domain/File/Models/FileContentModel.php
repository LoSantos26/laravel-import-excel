<?php
namespace Src\domain\File\Models;

use \Illuminate\Database\Eloquent\Model;

class FileContentModel extends Model
{
    protected $table = 'files_content';

    protected $fillable = [
        'file_id',
        'name',
        'age',
        'email',
        'code'
    ];

    public function file()
    {
        return $this->belongsTo(FilesModel::class, 'file_id', 'id');
    }
}
