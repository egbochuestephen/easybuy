@extends('layout')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Forgot Password</h2>
        <p class="text-sm text-gray-600 mb-6 text-center">
            Enter your email address and we will send you a 6-digit OTP via Mailtrap.
        </p>
        
        <!-- Form POSTs to your existing route to generate the OTP -->
        <form method="POST" action="/forgot-password" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300 mt-4">
                Send OTP
            </button>
        </form>
        
        <div class="mt-6 text-center border-t pt-4">
            <a href="/login" class="text-sm text-blue-600 hover:underline">&larr; Back to Login</a>
        </div>
    </div>
</div>
@endsection