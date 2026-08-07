<div class="relative">

    <input
        type="text"
        wire:model.live.debounce.300ms="q"
        placeholder="{{ app()->getLocale() == 'ar' ? 'ابحث عن خدمة أو منتج أو مشروع...' : 'Search services, products or projects...' }}"
        class="w-full h-12 border rounded-full px-5">

    @if(strlen($q) >= 2)

        <div class="absolute top-full mt-2 w-full bg-white border rounded-3xl shadow-xl z-50 overflow-hidden">

            {{-- الخدمات --}}
            @foreach($services as $service)

                <a href="{{ route('services.show', [
                        'locale' => app()->getLocale(),
                        'service' => $service->slug
                    ]) }}"
                   class="flex items-center justify-between p-4 hover:bg-slate-50 border-b">

                    <div>

                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">
                            {{ app()->getLocale() == 'ar' ? 'خدمة' : 'Service' }}
                        </span>

                        <div class="font-bold mt-2">
                            {{ $service->trans('title') }}
                        </div>

                    </div>

                </a>

            @endforeach

            {{-- المنتجات --}}
            @foreach($products as $product)

                <a href="{{ route('products.show', [
                        'locale' => app()->getLocale(),
                        'product' => $product->slug
                    ]) }}"
                   class="flex items-center justify-between p-4 hover:bg-slate-50 border-b">

                    <div>

                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">
                            {{ app()->getLocale() == 'ar' ? 'منتج' : 'Product' }}
                        </span>

                        <div class="font-bold mt-2">
                            {{ $product->trans('name') }}
                        </div>

                    </div>

                </a>

            @endforeach

            {{-- المشاريع --}}
            @foreach($projects as $project)

                <a href="{{ route('portfolio.show', [
                        'locale' => app()->getLocale(),
                        'project' => $project->slug
                    ]) }}"
                   class="flex items-center justify-between p-4 hover:bg-slate-50 border-b">

                    <div>

                        <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded">
                            {{ app()->getLocale() == 'ar' ? 'مشروع' : 'Project' }}
                        </span>

                        <div class="font-bold mt-2">
                            {{ $project->trans('title') }}
                        </div>

                    </div>

                </a>

            @endforeach

            @if(
                $services->count() ||
                $products->count() ||
                $projects->count()
            )

                <div class="border-t bg-slate-50">

                    <a href="{{ route('search', [
                        'locale' => app()->getLocale(),
                        'q' => $q
                    ]) }}"
                       class="block p-4 text-center font-bold text-blue-600 hover:bg-blue-50">

                        {{ app()->getLocale() == 'ar'
                            ? 'عرض جميع نتائج البحث'
                            : 'View All Search Results' }}

                    </a>

                </div>

            @endif

            @if(
                $services->isEmpty() &&
                $products->isEmpty() &&
                $projects->isEmpty()
            )

                <div class="p-4 text-center text-slate-500">
                    {{ app()->getLocale() == 'ar'
                        ? 'لا توجد نتائج'
                        : 'No results found' }}
                </div>

            @endif

        </div>

    @endif

</div>
