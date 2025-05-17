@extends('layout')

@section('content')
<div class="container mx-auto px-2 sm:px-4 py-6 sm:py-8">
    <h1 class="text-2xl sm:text-4xl font-extrabold mb-4 sm:mb-8 text-gray-900 tracking-tight">My Purchases</h1>
    <div class="bg-white rounded-2xl shadow-xl p-4 sm:p-6">
        @if($orders->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm sm:text-base">
                    <thead>
                        <tr>
                            <th class="px-3 sm:px-6 py-3 text-left font-bold text-gray-700 uppercase">Product Name</th>
                            <th class="px-3 sm:px-6 py-3 text-left font-bold text-gray-700 uppercase">Price</th>
                            <th class="px-3 sm:px-6 py-3 text-left font-bold text-gray-700 uppercase">Quantity</th>
                            <th class="px-3 sm:px-6 py-3 text-left font-bold text-gray-700 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-base sm:text-xl font-semibold text-gray-900">
                                {{ \Illuminate\Support\Str::limit($order->product_name, 32, '...') }}
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-base sm:text-lg text-blue-600 font-bold">
                                ${{ number_format($order->price, 2) }}
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-base sm:text-lg text-gray-800">
                                {{ $order->quantity }}
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="inline-block px-3 sm:px-4 py-2 rounded-full bg-gradient-to-r from-green-400 to-blue-500 text-white text-base sm:text-lg font-bold shadow">
                                    {{ ucfirst($order->action) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-gray-500 text-base sm:text-xl py-12">
                No orders have been placed yet.
            </div>
        @endif
    </div>
</div>
@endsection