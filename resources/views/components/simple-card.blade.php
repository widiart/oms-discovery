<div class="card">
    <div class="card-body">
        <h6 class="mb-2 f-w-400 text-muted">{{ $title }}</h6>
        <h4 class="mb-3">
            <span id="total-{{ $id }}">{{ $total }}</span> 
            <span class="badge bg-light-success border border-success">
                <i class="ti ti-trending-up"></i> <span id="percent-{{ $id }}">{{ $total }}</span>%
            </span>
        </h4>
        <p class="mb-0 text-muted text-sm" id="message-{{ $id }}">
            &nbsp;
        </p>
    </div>
</div>