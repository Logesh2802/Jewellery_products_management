<?php

namespace App\Controllers;

use App\Models\JewelleryProductModel;
use CodeIgniter\Controller;

class JewelleryProductController extends Controller
{
    protected $model;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->model = new JewelleryProductModel();
    }

    // Display main page with DataTable
    public function index()
    {
        if (!session()->has('user_id')) {
        // Redirect to login if not logged in
        return redirect()->to(base_url('login'))->with('error', 'Please log in to continue.');
    }
        return view('jewellery/index');
    }

    // DataTables AJAX server-side fetch
    public function getProducts()
    {
        if (!session()->has('user_id')) {
        // Redirect to login if not logged in
        return redirect()->to(base_url('login'))->with('error', 'Please log in to continue.');
    }
        $request = service('request');
        $columns = ['id', 'product_name', 'description', 'price', 'category', 'image'];

        $limit = $request->getPost('length');
        $start = $request->getPost('start');
        $orderColumn = $columns[$request->getPost('order')[0]['column']];
        $orderDir = $request->getPost('order')[0]['dir'];
        $search = $request->getPost('search')['value'];

        $totalData = $this->model->countAll();
        $totalFiltered = $totalData;

        if (empty($search)) {
            $products = $this->model->orderBy($orderColumn, $orderDir)->findAll($limit, $start);
        } else {
            $builder = $this->model->like('product_name', $search)
                                   ->orLike('description', $search)
                                   ->orLike('category', $search);

            $totalFiltered = $builder->countAllResults(false);
            $products = $builder->orderBy($orderColumn, $orderDir)->findAll($limit, $start);
        }

        $data = [];
        foreach ($products as $product) {
            $image = $product['image'] ? '<img src="'.base_url('uploads/'.$product['image']).'" width="70"/>' : 'No Image';

            $actions = '
                <a href="'.base_url('products/edit/'.$product['id']).'" class="btn btn-sm btn-primary">Edit</a>
                <a href="'.base_url('products/delete/'.$product['id']).'" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>
            ';

            $data[] = [
                $product['id'],
                esc($product['product_name']),
                esc($product['description']),
                number_format($product['price'], 2),
                esc($product['category']),
                $image,
                $actions,
            ];
        }

        return $this->response->setJSON([
            "draw" => intval($request->getPost('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        ]);
    }

    // Show create form
    public function create()
    {
        if (!session()->has('user_id')) {
        // Redirect to login if not logged in
        return redirect()->to(base_url('login'))->with('error', 'Please log in to continue.');
    }
        $data['categories'] = ['Ring', 'Necklace', 'Bracelet', 'Earrings', 'Other'];
        return view('jewellery/create', $data);
    }

    // Save new product
    public function store()
{
    if (!session()->has('user_id')) {
        // Redirect to login if not logged in
        return redirect()->to(base_url('login'))->with('error', 'Please log in to continue.');
    }
    $validation = \Config\Services::validation();

    $rules = [
        'product_name' => 'required',
        'price' => 'required|decimal',
        'category' => 'required',
        'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $img = $this->request->getFile('image');
    $newName = null;

    if ($img->isValid() && !$img->hasMoved()) {
        $newName = $img->getRandomName();

        // Resize and save
        \Config\Services::image()
            ->withFile($img)
            ->resize(500, 500, true, 'auto')
            ->save(FCPATH . 'uploads/' . $newName);
    }

    $this->model->save([
        'product_name' => $this->request->getPost('product_name'),
        'description' => $this->request->getPost('description'),
        'price' => $this->request->getPost('price'),
        'category' => $this->request->getPost('category'),
        'image' => $newName,
    ]);

    return redirect()->to('/products')->with('success', 'Product created successfully');
}


    // Show edit form
    public function edit($id)
    {
        if (!session()->has('user_id')) {
        // Redirect to login if not logged in
        return redirect()->to(base_url('login'))->with('error', 'Please log in to continue.');
    }
        $data['product'] = $this->model->find($id);
        if (!$data['product']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['categories'] = ['Ring', 'Necklace', 'Bracelet', 'Earrings', 'Other'];
        return view('jewellery/edit', $data);
    }

    // Update product
    public function update($id)
    {
        if (!session()->has('user_id')) {
        // Redirect to login if not logged in
        return redirect()->to(base_url('login'))->with('error', 'Please log in to continue.');
    }
        $validation = \Config\Services::validation();

        $rules = [
            'product_name' => 'required',
            'price' => 'required|decimal',
            'category' => 'required',
            'image' => 'is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $product = $this->model->find($id);
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $img = $this->request->getFile('image');
        $newName = $product['image'];

        if ($img && $img->isValid() && !$img->hasMoved()) {
            // Delete old image if exists
            if ($product['image'] && file_exists(FCPATH.'uploads/'.$product['image'])) {
                unlink(FCPATH.'uploads/'.$product['image']);
            }
            $newName = $img->getRandomName();
            $img->move(FCPATH.'uploads', $newName);

            \Config\Services::image()
                ->withFile(FCPATH.'uploads/'.$newName)
                ->resize(500, 500, true, 'auto')
                ->save(FCPATH.'uploads/'.$newName);
        }

        $this->model->update($id, [
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'category' => $this->request->getPost('category'),
            'image' => $newName,
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully');
    }

    // Delete product
    public function delete($id)
    {
        $product = $this->model->find($id);
        if ($product) {
            if ($product['image'] && file_exists(FCPATH.'uploads/'.$product['image'])) {
                unlink(FCPATH.'uploads/'.$product['image']);
            }
            $this->model->delete($id);
        }
        return redirect()->to('/products')->with('success', 'Product deleted successfully');
    }
}
