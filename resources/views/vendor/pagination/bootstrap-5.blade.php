<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Pagination</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #08C195;
            --primary-dark: #06a37b;
            --primary-light: #0ed6a8;
            --primary-subtle: rgba(8, 193, 149, 0.1);
            --gray: #64748b;
            --border: #e2e8f0;
        }
        
        .pagination-custom {
            display: flex;
            gap: 0.375rem;
            align-items: center;
        }
        
        .pagination-custom .page-item {
            list-style: none;
        }
        
        .pagination-custom .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 0.75rem;
            border: none;
            border-radius: 10px;
            background: #f1f5f9;
            color: var(--gray);
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .pagination-custom .page-link:hover:not(.disabled) {
            background: var(--primary-subtle);
            color: var(--primary);
            transform: translateY(-2px);
        }
        
        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 4px 12px rgba(8, 193, 149, 0.35);
        }
        
        .pagination-custom .page-item.disabled .page-link {
            background: transparent;
            color: #cbd5e1;
            cursor: not-allowed;
        }
        
        .pagination-custom .page-item .page-link i {
            font-size: 0.75rem;
        }
        
        .pagination-custom .page-ellipsis {
            color: var(--gray);
            padding: 0 0.5rem;
        }
    </style>
</head>
<body>
    <nav aria-label="Page navigation">
        @if ($paginator->hasPages())
            <ul class="pagination-custom">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        @endif
    </nav>
</body>
</html>
