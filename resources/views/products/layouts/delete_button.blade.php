<x-form method="DELETE" action="{{ route('blogs.destroy', $blog->id) }}" style="display: inline;">
    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are You Sure?!')">Delete</button>
</x-form>