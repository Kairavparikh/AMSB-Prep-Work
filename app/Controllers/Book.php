<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Book as BookModel;

class Book extends BaseController
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
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required|numeric|exact_length[4]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = null;

        if ($coverImage->isValid() && !$coverImage->hasMoved()) {
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move('uploads', $coverImageName);
        }

        $this->bookModel->insert([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year'),
            'cover_image' => $coverImageName,
        ]);

        return redirect()->to('/books')->with('message', 'Book added successfully.');
    }

    public function edit($id)
    {
        $data['book'] = $this->bookModel->find($id);
        if (empty($data['book'])) {
            return redirect()->to('/books')->with('error', 'Book not found.');
        }
        return view('books/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required|numeric|exact_length[4]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = $this->bookModel->find($id)['cover_image'];

        if ($coverImage->isValid() && !$coverImage->hasMoved()) {
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move('uploads', $coverImageName);
        }

        $this->bookModel->update($id, [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year'),
            'cover_image' => $coverImageName,
        ]);

        return redirect()->to('/books')->with('message', 'Book updated successfully.');
    }

    public function delete($id)
    {
        $book = $this->bookModel->find($id);
        if (empty($book)) {
            return redirect()->to('/books')->with('error', 'Book not found.');
        }

        $this->bookModel->delete($id);
        return redirect()->to('/books')->with('message', 'Book deleted successfully.');
    }
}
