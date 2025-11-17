
<li class="dd-item" data-id="{{ $item->id }}">
    <div class="dd-handle">
        {{ $item->name }} (لینک: {{ $item->link }})
        <div class="dd-actions">
            <a href="{{ route('admin.menus.edit', $item) }}" class="btn btn-warning btn-sm mx-1">ویرایش</a>
            <form action="{{ route('admin.menus.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('آیا از حذف این منو مطمئن هستید؟ با حذف این منو، تمام زیرمنوهای آن نیز حذف خواهند شد.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
            </form>
        </div>
    </div>

    @if($item->children->isNotEmpty())
        <ol class="dd-list">
            @foreach($item->children as $child)
                @include('Admin.Menu._menu_item', ['item' => $child])
            @endforeach
        </ol>
    @endif
</li>