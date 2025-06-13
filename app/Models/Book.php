<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'author', 'genre', 'publication_year', 'cover_image'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title' => 'required',
        'author' => 'required',
        'publication_year' => 'required|numeric|exact_length[4]',
    ];
    protected $validationMessages   = [
        'title' => [
            'required' => 'Book title is required.',
        ],
        'author' => [
            'required' => 'Author name is required.',
        ],
        'publication_year' => [
            'required' => 'Publication year is required.',
            'numeric' => 'Publication year must be a number.',
            'exact_length' => 'Publication year must be 4 digits.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
