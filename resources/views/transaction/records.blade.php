
        @forelse($trasactions as $trasaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trasaction->consumer->name }} - ({{ $trasaction->consumer->type }})</td>
                <td>{{ $trasaction->consumer->email }}</td>
                <td>{{ $trasaction->product->name }}</td>
                <td>{{ $trasaction->transaction_type }}</td>
                <td>{{ $trasaction->quantity }}</td>
                <td>{{ $trasaction->consumer->contact_info }}</td>
                <td>{{ $trasaction->created_at->format('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">No products found.</td>
            </tr>
        @endforelse