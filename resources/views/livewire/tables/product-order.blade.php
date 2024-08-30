<div class="col-lg-5">
    <div class="card mb-4 mb-xl-0">
        <div class="card-header">
            List Product
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{ route('products.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name...">
                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td class="text-center">
                                    {{ $product->name }}
                                </td>
                                <td class="text-center">
                                    {{ $product->quantity }}
                                </td>
                                <td class="text-center">
                                    {{ $product->unit->name }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($product->selling_price, 2) }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{ route('pos.addCartItem', $product) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="selling_price" value="{{ $product->selling_price }}">

                                            <button type="submit" class="btn btn-icon btn-outline-primary">
                                                <x-icon.cart />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="5" class="text-center">
                                    No products found.
                                </th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-secondary">
                            Showing <span>{{ $products->firstItem() }}</span> to <span>{{ $products->lastItem() }}</span> of <span>{{ $products->total() }}</span> entries
                        </p>

                        <ul class="pagination m-0 ms-auto">
                            {{ $products->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>