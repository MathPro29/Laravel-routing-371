<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
        return Inertia::render('Products/Index', [
            'products' => $this->products,
     ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

     public function show($id)
     {
         // ค้นหาสินค้าจากคอลเลกชัน $this->products โดยใช้ id ที่ส่งเข้ามา
         // ถ้าพบรายการแรกที่ตรงกับ 'id' จะเก็บไว้ใน $product
         $product = collect($this->products)->firstWhere('id', $id);

         // ตรวจสอบว่าพบสินค้าใน $product หรือไม่
         // หากไม่พบสินค้า ให้ส่ง HTTP 404 พร้อมข้อความ "Product not found"
         if (!$product) {
             abort(404, 'Product not found');
         }

         // ส่งข้อมูลสินค้าไปยัง View 'Products/Show'
         return Inertia::render('Products/Show', ['product' => $product]);
     }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }

    private $products = [
        [
            'id' => 1,
            'name' => 'Laptop',
            'description' => 'High-performance laptop',
            'price' => "99900",
            'images' => '/images/laptop.png',
        ],
        [
            'id' => 2,
            'name' => 'Smartphone',
            'description' => 'Latest smartphone with great features',
            'price' => "29900",
            'images' => '/images/smartphone.jpg'
        ],
        [
            'id' => 3,
            'name' => 'Tablet',
            'description' => 'Portable tablet for everyday use',
            'price' => "15000",
            'images' => '/images/tablet.png'
        ],
        [
            'id' => 4,
            'name' => 'Mouse',
            'description' => 'Ergonomic mouse for comfortable use',
            'price' => "999",
            'images' => '/images/mouse.jpg'
        ],
        [
            'id' => 5,
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard with customizable keys',
            'price' => "7490",
            'images' => '/images/keyboard.png'
        ],
        [
            'id' => 6,
            'name' => 'Monitor',
            'description' => '27-inch 4K UHD display for stunning visuals',
            'price' => "6500",
            'images' => '/images/monitor.png'
        ],
        [
            'id' => 8,
            'name' => 'Headphones',
            'description' => 'Noise-cancelling over-ear headphones',
            'price' => "4290",
            'images' => '/images/headphones.jpg'
        ],
        [
            'id' => 9,
            'name' => 'Webcam',
            'description' => '1080p HD webcam for video calls',
            'price' => "3290",
            'images' => '/images/webcam.png'
        ],
        [
            'id' => 10,
            'name' => 'Smartwatch',
            'description' => 'Stylish smartwatch with fitness tracking',
            'price' => "13490",
            'images' => '/images/smartwatch.png'
        ],
        [
            'id' => 11,
            'name' => 'Microphone',
            'description' => 'Great microphone for podcasting and streaming',
            'price' => "5900",
            'images' => '/images/microphone.png '
        ],


    ];
}
