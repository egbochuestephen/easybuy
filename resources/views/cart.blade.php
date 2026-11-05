@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Your Shopping Cart</h2>
        <a href="/dashboard" class="text-blue-600 hover:underline">&larr; Continue Shopping</a>
    </div>

    @if($cartItems->isEmpty())
        <div class="bg-white p-10 rounded-lg shadow-md text-center">
            <p class="text-gray-500 text-lg mb-4">Your cart is completely empty.</p>
            <a href="/dashboard" class="bg-blue-600 text-white font-bold py-2 px-6 rounded hover:bg-blue-700 transition">Go find some products!</a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $grandTotal = 0; @endphp
                    
                    @foreach($cartItems as $item)
                        @php 
                            $subtotal = $item->product->price * $item->quantity; 
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="h-12 w-12 rounded object-cover mr-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $item->product->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                ${{ number_format($item->product->price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-bold">
                                x {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">
                                ${{ number_format($subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="p-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <span class="text-xl font-bold text-gray-700">Grand Total:</span>
                <span class="text-3xl font-bold text-green-600">${{ number_format($grandTotal, 2) }}</span>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-8 rounded transition duration-300">
                Checkout Now
            </button>
        </div>
    @endif

</div>
@endsection