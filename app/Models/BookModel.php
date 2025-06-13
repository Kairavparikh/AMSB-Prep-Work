<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'author', 'genre', 'publication_year', 'image_path'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'title'            => 'required|min_length[3]|max_length[255]',
        'author'           => 'required|min_length[3]|max_length[255]',
        'genre'            => 'required|min_length[2]|max_length[100]',
        'publication_year' => 'required|integer|greater_than[1800]|less_than[2100]',
    ];
    protected $validationMessages = [
        'title' => [
            'required' => 'Book title is required',
            'min_length' => 'Book title must be at least 3 characters long',
        ],
        'author' => [
            'required' => 'Author name is required',
            'min_length' => 'Author name must be at least 3 characters long',
        ],
        'genre' => [
            'required' => 'Genre is required',
            'min_length' => 'Genre must be at least 2 characters long',
        ],
        'publication_year' => [
            'required' => 'Publication year is required',
            'integer' => 'Publication year must be a valid year',
            'greater_than' => 'Publication year must be after 1800',
            'less_than' => 'Publication year must be before 2100',
        ],
    ];
} 