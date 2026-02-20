<!-- Card Styles -->
<style>
    /* Card Custom */
    .card-custom {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        height: 100%;
    }

    .card-header-custom {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafbfc;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .card-header-custom .header-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-header-custom h5,
    .card-header-custom .card-title {
        font-weight: 600;
        color: #1e293b;
        font-size: 1rem;
        margin: 0;
    }

    .header-icon-sm {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }

    .gradient-teal {
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
    }

    .gradient-purple {
        background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
    }

    .gradient-orange {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
    }

    .gradient-green {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    }

    .gradient-red {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
    }

    .gradient-blue {
        background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
    }

    .card-body-custom {
        padding: 1rem;
    }

    /* Button Styles */
    .btn-custom {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-custom-primary {
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        color: white;
    }

    .btn-custom-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(8, 193, 149, 0.3);
        color: white;
    }

    .btn-custom-outline {
        border: 2px solid #08C195;
        color: #08C195;
        background: transparent;
    }

    .btn-custom-outline:hover {
        background: #08C195;
        color: white;
    }

    .btn-custom-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
    }

    .btn-custom-warning {
        background: #f59e0b;
        color: white;
    }

    .btn-custom-warning:hover {
        background: #d97706;
        color: white;
    }

    .btn-custom-danger {
        background: #ef4444;
        color: white;
    }

    .btn-custom-danger:hover {
        background: #dc2626;
        color: white;
    }

    .btn-custom-secondary {
        background: #64748b;
        color: white;
    }

    .btn-custom-secondary:hover {
        background: #475569;
        color: white;
    }

    /* Table Styles */
    .table-custom {
        width: 100%;
        margin: 0;
    }

    .table-custom thead th {
        background: transparent;
        color: #64748b;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        white-space: nowrap;
    }

    .table-custom tbody td {
        padding: 0.875rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8fafc;
        font-size: 0.875rem;
        color: #334155;
    }

    .table-custom tbody tr:hover {
        background: #fafbfc;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badge Styles */
    .badge-custom {
        padding: 0.35rem 0.65rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .badge-primary {
        background: rgba(8, 193, 149, 0.1);
        color: #08C195;
    }

    .badge-secondary {
        background: #f1f5f9;
        color: #64748b;
    }

    .badge-purple {
        background: rgba(99, 102, 241, 0.1);
        color: #6366f1;
    }

    .badge-orange {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .badge-green {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .badge-red {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .badge-blue {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .badge-active {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .badge-inactive {
        background: rgba(100, 116, 139, 0.1);
        color: #64748b;
    }

    /* Avatar Styles */
    .avatar-sm {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .avatar-gradient-teal {
        background: linear-gradient(135deg, #08C195, #0ed6a8);
        color: white;
    }

    .avatar-gradient-purple {
        background: linear-gradient(135deg, #6366f1, #818cf8);
        color: white;
    }

    .avatar-gradient-orange {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
    }

    .avatar-gradient-blue {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
    }

    .avatar-gradient-green {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }

    /* Status Badge */
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .status-waiting {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .status-calling {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .status-serving {
        background: rgba(8, 193, 149, 0.1);
        color: #08C195;
    }

    .status-done {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .status-cancelled {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    /* Action Button */
    .btn-action {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.8rem;
        text-decoration: none;
    }

    .btn-action-primary {
        background: rgba(8, 193, 149, 0.1);
        color: #08C195;
    }

    .btn-action-primary:hover {
        background: #08C195;
        color: white;
    }

    .btn-action-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .btn-action-warning:hover {
        background: #f59e0b;
        color: white;
    }

    .btn-action-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .btn-action-danger:hover {
        background: #ef4444;
        color: white;
    }

    .btn-action-info {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .btn-action-info:hover {
        background: #3b82f6;
        color: white;
    }

    .btn-action-secondary {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-action-secondary:hover {
        background: #e2e8f0;
        color: #475569;
    }

    /* Empty State */
    .empty-state {
        padding: 3rem;
        text-align: center;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: #94a3b8;
    }

    .empty-state h6 {
        color: #475569;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .empty-state p {
        color: #94a3b8;
        font-size: 0.875rem;
        margin: 0;
    }

    /* Form Styles */
    .form-custom .form-label {
        font-weight: 500;
        color: #334155;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .form-custom .form-control,
    .form-custom .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .form-custom .form-control:focus,
    .form-custom .form-select:focus {
        border-color: #08C195;
        box-shadow: 0 0 0 3px rgba(8, 193, 149, 0.1);
    }

    .form-custom .form-check-input:checked {
        background-color: #08C195;
        border-color: #08C195;
    }

    /* Page Actions */
    .page-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    /* Text Muted Small */
    .text-muted-small {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    /* Table Responsive */
    .table-responsive-custom {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive-custom::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive-custom::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .table-responsive-custom::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .table-responsive-custom::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
