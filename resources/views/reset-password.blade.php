@extends('layout')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Enter Reset Code</h2>
        
        <form method="POST" action="/reset-password" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <!-- Pre-fills the email if you passed it from the previous controller step -->
                <input type="email" name="email" value="{{ request('email') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 bg-gray-50">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">6-Digit OTP:</label>
                <input type="text" name="otp" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 tracking-widest text-center text-lg">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">New Password (Min 8 characters):</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password:</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300 mt-4">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection