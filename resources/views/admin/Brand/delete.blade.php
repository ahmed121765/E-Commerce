<div class="modal fade" id="delete{{ $brand->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $brand->id }}"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="deleteModalLabel{{ $brand->id }}">
                    Delete Brand
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>

            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-body">

                    <p>
                        Are you sure you want to delete
                        <strong>{{ $brand->name }}</strong>?
                    </p>

                    @if($brand->image)
                        <input type="hidden" name="filename" value="{{ $brand->image }}">
                    @endif

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>