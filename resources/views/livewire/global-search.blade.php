<div data-kt-search-element="wrapper">
    <form data-kt-search-element="form" class="w-100 position-relative mb-3"
          autocomplete="off">
        <i class="ki-duotone ki-magnifier fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-0">
            <i class="path1"></i><i class="path2"></i>
        </i>
        <input class="search-input  form-control form-control-flush ps-10" placeholder="Search..."
               wire:model="search" data-kt-search-element="input"
        />
        <i class="search-spinner position-absolute top-50 end-0 translate-middle-y lh-0 me-1" wire:loading>
            <i class="spinner-border h-15px w-15px align-middle text-gray-400"></i>
        </i>
    </form>
    <div class="{{ $search ? '' : 'd-none' }}">
        <div class="separator border-gray-200 mb-6 "></div>
        <div class="scroll-y mh-200px mh-lg-350px">
            @if($users->isNotEmpty())
                <h3 class="fs-5 text-muted m-0  pb-5">Users</h3>
                @foreach($users as $user)
                    <a href="{{ route('users.show', $user) }}" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                        <div class="symbol symbol-40px me-4">
                            <img src="{{ $user->photo }}" alt=""/>
                        </div>
                        <div class="d-flex flex-column justify-content-start fw-semibold">
                            <span class="fs-6 fw-semibold">{{ $user->name }}</span>
                            <span class="fs-7 fw-semibold text-muted">{{ $user->email }}<x-users.badge :user="user()" /></span>
                        </div>
                    </a>
                @endforeach
            @endif
            @if($products->isNotEmpty())
                <h3 class="fs-5 text-muted m-0 pt-5 pb-5">Products</h3>
                @foreach($products as $product)
                    <a href="{{ route('products.edit', $product) }}" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                        <div class="symbol symbol-40px me-4">
                            <img class="w-40px h-40px" src="{{ $product->image->thumbnail }}" alt=""/>
                        </div>
                        <div class="d-flex flex-column justify-content-start fw-semibold">
                            <span class="fs-6 fw-semibold" data-bs-toggle="tooltip" title="{{ $product->name }}">{{ str($product->name)->limit(30) }}</span>
                            <span class="fs-7 fw-semibold text-muted">{{ $product->model_no }}</span>
                        </div>
                    </a>
                @endforeach
            @endif
            @if($orders->isNotEmpty())
                <h3 class="fs-5 text-muted m-0 pt-5 pb-5">Orders</h3>
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                        <div class="symbol symbol-40px me-4">
                            <span class="symbol-label bg-light">
                                <i class="ki-duotone ki-cube-2 fs-2 text-primary">
                                    <i class="path1"></i><i class="path2"></i><i class="path3"></i>
                                </i>
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="fs-6 fw-semibold"># {{ $order->id }}</span>
                            <span class="fs-7 fw-semibold text-muted">{{ $order->user->name }} | {{ $order->created_at->format('d M, Y') }}</span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        @if($users->isEmpty() && $products->isEmpty() && $orders->isEmpty())
            <div class="text-center">
                <div class="pt-10 pb-10">
                    <i class="ki-duotone ki-search-list fs-4x opacity-50">
                        <i class="path1"></i><i class="path2"></i><i class="path3"></i>
                    </i>
                </div>
                <div class="pb-15 fw-semibold">
                    <h3 class="text-gray-600 fs-5 mb-2">Nothing found</h3>
                    <div class="text-muted fs-7">No result matches your search</div>
                </div>
            </div>
        @endif
    </div>
</div>
