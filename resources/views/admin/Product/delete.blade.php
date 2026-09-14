<div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">
                    Delete product
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>

            <form action="{{ route('Products.destroy', $product->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-body">

                    <p>
                        Are you sure you want to delete
                        <strong>{{ $product->name }}</strong>?
                    </p>

                    @if($product->image)
                        <input type="hidden" name="filename" value="{{ $product->image }}">
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