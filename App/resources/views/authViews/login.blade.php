<h1>Hello World</h1>

{{-- Pencarian Data menggunakan fitur yang dibuat laravel --}}

{{-- 
    $collection = collect([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 80],
        ['product' => 'Bookcase', 'price' => 150],
        ['product' => 'Pencil', 'price' => 30],
        ['product' => 'Door', 'price' => 100],
    ]);
    
    $filtered = $collection->whereBetween('price', [100, 200]);
    
    $filtered->all();
    
    /*
        [
            ['product' => 'Desk', 'price' => 200],
            ['product' => 'Bookcase', 'price' => 150],
            ['product' => 'Door', 'price' => 100],
        ]
    */ 
--}}