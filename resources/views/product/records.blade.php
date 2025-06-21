
        @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description ?? '—' }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->inventory->available_units	 ?? 0 }}</td>
                <td>{{ $product->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a onclick="confirmDelete()" href="{{ route('product.delete', ['product' => $product->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">No products found.</td>
            </tr>
        @endforelse