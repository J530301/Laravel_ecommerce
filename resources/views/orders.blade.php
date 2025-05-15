@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-extrabold mb-8 text-gray-900 tracking-tight">My Purchases</h1>
    <div class="bg-white rounded-2xl shadow-xl p-6">
        @if($orders->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-lg font-bold text-gray-700 uppercase">Product Name</th>
                            <th class="px-6 py-3 text-left text-lg font-bold text-gray-700 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-lg font-bold text-gray-700 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-left text-lg font-bold text-gray-700 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-xl font-semibold text-gray-900">
                                {{ \Illuminate\Support\Str::limit($order->product_name, 32, '...') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-blue-600 font-bold">
                                ${{ number_format($order->price, 2) }}
                            </td>
                            <td class="px-10 py-4 whitespace-nowrap text-lg text-gray-800 ">
                                {{ $order->quantity }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-green-400 to-blue-500 text-white text-lg font-bold shadow">
                                    {{ ucfirst($order->action) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-gray-500 text-xl py-12">
                No orders have been placed yet.
            </div>
        @endif
    </div>
</div>
@endsection