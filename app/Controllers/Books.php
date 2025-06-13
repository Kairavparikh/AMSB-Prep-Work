<?php

namespace App\Controllers;

use App\Models\BookModel;

class Books extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        $data['books'] = $this->bookModel->findAll();
        return view('books/index', $data);
    }

    public function create()
    {
        return view('books/create');
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'author' => 'required|min_length[3]',
            'genre' => 'required',
            'publication_year' => 'required|numeric|exact_length[4]',
            'cover_image' => 'permit_empty|max_size[cover_image,1024]|is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('cover_image');
        $imagePath = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $uploadsDir = FCPATH . 'uploads';
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }

            $newName = $image->getRandomName();
            try {
                $image->move($uploadsDir, $newName);
                $imagePath = $newName;
            } catch (\Exception $e) {
                log_message('error', 'File upload failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('errors', ['cover_image' => 'Failed to upload image']);
            }
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year'),
            'image_path' => $imagePath
        ];

        try {
            log_message('debug', 'Attempting to insert book with data: ' . json_encode($data));
            $inserted = $this->bookModel->insert($data);
            if (!$inserted) {
                log_message('error', 'Insert failed. Model errors: ' . json_encode($this->bookModel->errors()));
                return redirect()->back()->withInput()->with('errors', ['database' => 'Failed to save book: ' . implode(', ', $this->bookModel->errors())]);
            }
            return redirect()->to('/books')->with('message', 'Book added successfully');
        } catch (\Exception $e) {
            log_message('error', 'Database insert failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['database' => 'Failed to save book: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['book'] = $this->bookModel->find($id);
        return view('books/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'author' => 'required|min_length[3]',
            'genre' => 'required',
            'publication_year' => 'required|numeric|exact_length[4]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year')
        ];

        $image = $this->request->getFile('cover_image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $uploadsDir = FCPATH . 'uploads/';
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            $newName = $image->getRandomName();
            $image->move($uploadsDir, $newName);
            $data['image_path'] = $newName;
        }

        $this->bookModel->update($id, $data);

        return redirect()->to('/books')->with('message', 'Book updated successfully');
    }

    public function delete($id)
    {
        $this->bookModel->delete($id);
        return redirect()->to('/books')->with('message', 'Book deleted successfully');
    }
} 