
        @forelse($consumers as $consumer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $consumer->name }}</td>
                <td>{{ $consumer->email ?? '—' }}</td>
                <td>{{ $consumer->type ?? '—' }}</td>
                <td>{{ $consumer->contact_info ?? '—' }}</td>
                <td>{{ $consumer->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('consumer.edit', ['consumer' => $consumer->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a onclick="confirmDelete()" href="{{ route('consumer.delete', ['consumer' => $consumer->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">No Consumer found.</td>
            </tr>
        @endforelse