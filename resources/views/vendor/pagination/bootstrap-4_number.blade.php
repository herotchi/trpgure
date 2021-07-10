<span>
    検索結果
    @if ($paginator->total() === 0)
    0件
    @else
        @if ($paginator->hasPages())
        {{ $paginator->total() }}件中
            @if ($paginator->firstItem() === $paginator->lastItem())
            {{ $paginator->firstItem() }}件目
            @else
            {{ $paginator->firstItem() }}～{{ $paginator->lastItem() }}件目
            @endif
        @else
        {{ $paginator->total() }}件
        @endif
    @endif
</span>