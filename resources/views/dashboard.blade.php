@extends('layout')

@section('content')
<!-- Top Navigation Bar -->
<nav class="bg-blue-600 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">
                <h1 class="text-white text-2xl font-bold">EasyBuy</h1>
            </div>
            <div class="flex items-center space-x-6">
                <!-- Link to the Shopping Cart -->
                <a href="/cart" class="text-white font-bold hover:text-gray-200 flex items-center">
                    🛒 My Cart
                </a>
                
                <span class="text-white text-sm border-l pl-6 border-blue-400">
                    Welcome, <span class="font-bold">{{ auth()->user()->name ?? 'User' }}</span>!
                </span>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-medium transition duration-300">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Main Dashboard Content -->
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    
    <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Product Catalog</h2>

    <!-- Only users with the 'admin' role can see this button -->
    @if(auth()->user()->role === 'admin')
        <a href="/products/create" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
            + Sell a Product
        </a>
    @endif
</div>

    <!-- Success Message Alert -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                
                <div class="p-4 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $product->description }}</p>
                    </div>
                    <div class="mt-4">
                        <span class="text-xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                        
                        <!-- functional Add to Cart Form -->
                        <form method="POST" action="/cart/add/{{ $product->id }}" class="mt-3">
                            @csrf
                            <button type="submit" class="w-full bg-gray-800 text-white font-bold py-2 px-4 rounded hover:bg-gray-900 transition duration-300">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection