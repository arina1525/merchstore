<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();

        $data['categories'] =
            $categoryModel->findAll();

        return view(
            'admin/categories/index',
            $data
        );
    }
    public function create()
    {
        return view('admin/categories/create');
    }
    public function store()
    {
        $categoryModel = new CategoryModel();

        $categoryModel->save([
            'name' => $this->request->getPost('name'),
            'preview_type' => $this->request->getPost('preview_type'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/admin/categories');
    }
}
