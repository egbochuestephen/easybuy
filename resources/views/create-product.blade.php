@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-8 rounded-lg shadow-md">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Upload a New Product</h2>
            <a href="/dashboard" class="text-blue-600 hover:underline text-sm">&larr; Back to Dashboard</a>
        </div>
        
        <!-- ENCTYPE is absolutely critical. Without it, HTML forms cannot send files! -->
        <form method="POST" action="/products" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea name="description" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Price (Naira/Dollars):</label>
                <input type="number" name="price" step="0.01" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Product Image:</label>
                <!-- type="file" creates the native "Choose File" button on your computer -->
                <input type="file" name="image" accept="image/*" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 bg-gray-50">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded hover:bg-blue-700 transition duration-300">
                Upload Product
            </button>
        </form>

    </div>
</div>
@endsection