@extends('master')
@section('content')
<section>
    <div class="bg-white py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-start">
                <!-- Left Section: Image and Package Info -->
                <div class="w-full lg:w-2/3">
                    <!-- Back Button -->
                    <button class="text-gray-500 hover:text-gray-700 mb-4">
                        &larr; Kembali
                    </button>

                    <!-- Package Image -->
                    <div class="relative">
                        <img class="w-full h-auto rounded-lg" src="{{asset('storage/images/'.$package->image_url)}}" alt="Destination Image">
                        <span class="absolute top-4 left-4 bg-gray-900 text-white px-3 py-1 rounded">{{$package->category->name}}</span>
                    </div>

                    <!-- Package Title and Description -->
                    <h2 class="text-3xl font-bold text-gray-800 mt-4">{{$package->name}}</h2>

                    <!-- Package Info Badges -->
                    <div class="flex items-center gap-4 mt-4">
                        <span class="flex items-center gap-1 text-gray-600"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4H1m3 4H1m3 4H1m3 4H1m6.071.286a3.429 3.429 0 1 1 6.858 0M4 1h12a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm9 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg> {{$package->duration}} Hari</span>
                        <span class="flex items-center gap-1 text-gray-600"><i class="bi bi-building"></i> Tidak ada Hotel</span>
                        <span class="flex items-center gap-1 text-gray-600"><i class="bi bi-geo-alt"></i> 1 Negara 1 Kota</span>
                        <span class="flex items-center gap-1 text-gray-600"><i class="bi bi-globe"></i> 96 Keberangkatan</span>
                    </div>

                    <!-- Package Description -->
                    <p class="text-gray-600 mt-4">{{$package->description}}</p>

                    <div id="accordion-collapse" data-accordion="collapse">
                        @foreach ($package->itenerary as $itenerary )
                        <h2 id="accordion-collapse-heading-{{$itenerary->id}}">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{$itenerary->id}}" aria-expanded="true" aria-controls="accordion-collapse-body-{{$itenerary->id}}">
                                <span>{{$itenerary->activity}}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{$itenerary->id}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$itenerary->id}}">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">{{$itenerary->description}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>

                <!-- Right Section: Booking Form -->
                <div class="hidden lg:block lg:w-1/3 bg-gray-50 p-6 rounded-lg shadow-lg">
                    <form action="{{route('package.checkout',$package->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="package_id" value="{{$package->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <!-- Date Picker -->
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Pilih Tanggal Keberangkatan</h3>
                            <p class="text-sm text-gray-500">Tersedia 96 Keberangkatan</p>
                            <div class="mt-3">
                                <label for="departure" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                                <select id="departure" name="departure" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a country</option>
                                    @foreach ($listDates as $date )

                                    <option value="{{$date}}">{{$date}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Participants -->
                        <!-- <div class="mb-6"> -->
                        <!-- <h3 class="text-xl font-semibold text-gray-800">Jumlah Peserta</h3> -->
                        <div class=" gap-4 mt-3">
                            <!-- <div> -->
                            <label for="person" class="block text-sm font-medium text-gray-700">Jumlah anggota</label>
                            <input type="number" id="person" name="person" value="1" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            <!-- </div> -->
                            <!-- <div>
                                <label for="children" class="block text-sm font-medium text-gray-700">Anak-anak</label>
                                <input type="number" id="children" value="0" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                            </div> -->
                        </div>
                        <!-- </div> -->

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-orange-600 text-white px-6 py-2 rounded-lg mt-4 hover:bg-orange-700">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</section>


<!-- Modal structure -->
<div id="dateModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 md:mx-auto">
            <!-- Modal header -->
            <div class="flex justify-between items-center border-b p-4">
                <h3 class="text-lg font-semibold">Pilih Keberangkatan</h3>
                <button class="text-gray-500 hover:text-gray-700" id="closeModalButton">&times;</button>
            </div>

            <!-- Modal body (list of departure dates) -->
            <div class="p-4 max-h-96 overflow-y-auto">
                <ul>
                    @foreach ($listDates as $date )

                    <li class="flex justify-between items-center py-2 border-b">
                        <span>{{$date}}</span>
                        <input type="radio" name="departureDate" class="form-radio text-indigo-600" />
                    </li>
                    @endforeach
                </ul>
            </div>


            <!-- Modal footer -->
            <div class="border-t p-4">
                <button class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">Pilih</button>
            </div>
        </div>
    </div>
</div>


@endsection