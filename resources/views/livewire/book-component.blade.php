<div  class="container my-12 mx-auto md:px-12">
    <div class="md:grid md:grid-cols-3 md:gap:6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">@lang('admin.create_edit_book')</h3>
                <p class="mt-1 text-sm leading-5 text-gray-600">
                    @lang('admin.create_edit_book_description')
                </p>
            </div>
        </div>


        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="storeBook">
                <div class="shadow sm-rounded-md sm-overflow-hidden">
                    <div class="px-4 py-5 bg-white sm-p-6">
                        @if($action=='U')
                        <div class="swiper-container h-64">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                @foreach($photosInDatabase as $photo)
                                    <div class="swiper-slide">
                                        <x-img-with-src-default  class="w-100 "  :name="$photo->name" :img="$photo->name"></x-img-with-src-default>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-4 gap-6 mt-6">
                            <div class="grid grid-cols-3">
                                @foreach($photosInDatabase as $photo)
                                    <x-img-with-src-default  class="inline  rounded-full"  :name="$photo->name" :img="$photo->name"></x-img-with-src-default>
                                @endforeach
                            </div>
                        </div>


                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label class="block text-sm font-medium leading-5 text-gray-700">
                                        @lang('admin.NOMBRE')
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                            <input wire:model.lazy="name" class="form-input flex-1 block w-full rounded-none
                                                                                    rounded-r-md transition duration-150"
                                            placeholder="..."
                                            >
                                    </div>
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>


                            <div class="grid grid-cols-3 gap-6 mt-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label class="block text-sm font-medium leading-5 text-gray-700">
                                        @lang('admin.DESCRIPCION')
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <textarea rows="5" wire:model.lazy="description" class="form-input flex-1 block w-full rounded-none
                                                                                        rounded-r-md transition duration-150"
                                               placeholder="..."
                                        ></textarea>
                                    </div>
                                    @error('description')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>


                            <div class="grid grid-cols-3 gap-6 mt-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label class="block text-sm font-medium leading-5 text-gray-700">
                                        @lang('admin.PHOTO')
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <div
                                            x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                            <!-- File Input -->
                                            <input type="file" wire:model="covers" multiple>

                                            <!-- Progress Bar -->
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                    </div>
                                    @error('covers.*')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                        <div class="grid grid-cols-3 gap-6 mt-6">
                            <div class="col-span-3 sm:col-span-2">
                                @foreach($covers as $cover)
                                    <img class="inline h-16 w-16 rounded-full" src="{{$cover->temporaryUrl()}}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <span class="inline-flex">
                                <a href="{{route('dashboard')}}" class="m-1 inline-flex justify-center py-2 px-4 bg-red-600 text-white hover:bg-rd-500">
                                    @lang('admin.btn_cancel')
                                </a>
                                <button type="submit"  class="m-1 inline-flex justify-center py-2 px-4 bg-indigo-600 text-white hover:bg-indigo-500">@lang('admin.btn_save')</button>
                        </span>
                </div>
            </form>
        </div>

    </div>
    @include('livewire._partials._books',[
        'category'=>$category
    ])

    <script>
        window.addEventListener('msgBook',event=>{
            Swal.fire(event.detail.msg);
        });
    </script>
</div>

