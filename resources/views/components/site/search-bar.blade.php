@props(['products', 'id', 'style' => ''])
<div class="col-auto p0 pre_line">
    <div class="top-search text-start">
        <form id="{{ $id }}" action="{{ route('shop.index') }}" class="form-search">
            <livewire:site-search />
        </form>
    </div>
</div>
<div class="col-auto p0">
    <div class=advscrh_frm_btn>
        <button type=submit class="btn search-btn" form="{{ $id }}">
            <span class=flaticon-search></span>
        </button>
    </div>
</div>
