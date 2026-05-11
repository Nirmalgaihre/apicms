<div class="card">
    <div class="card-header">Manage Categories</div>
    <div class="card-body">
        <form action="{{ route('admin.staff-category.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="Category Title" required>
                <button class="btn btn-primary" type="submit">Add Category</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sort</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sortable-categories">
                @foreach($categories as $category)
                <tr data-id="{{ $category->id }}">
                    <td><i class="bi bi-grip-vertical handle" style="cursor:move"></i></td>
                    <td>{{ $category->title }}</td>
                    <td>
                        <form action="{{ route('admin.staff-category.destroy', $category->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function() {
        $("#sortable-categories").sortable({
            handle: '.handle',
            update: function(event, ui) {
                let order = [];
                $('#sortable-categories tr').each(function(index) {
                    order.push({
                        id: $(this).data('id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.staff-category.updateOrder') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Order updated');
                    }
                });
            }
        });
    });
</script>