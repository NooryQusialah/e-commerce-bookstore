<div class="row">
    <form action="{{ $action }}" method="get">
        @csrf
        <div class="row d-flex justify-content-center pt-3">
            <input type="text"
                   class="col-3 mx-sm-3 mb-2"
                   name="term"
                   value="{{ request('term') }}"
                   placeholder="{{ $placeholder }}">
            <button type="submit" class="col-1 btn btn-secondary bg-secondary mb-2">بحث</button>
        </div>
    </form>
</div>
