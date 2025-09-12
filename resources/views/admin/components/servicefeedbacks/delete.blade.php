<input type="checkbox" id="deleteModal-{{ $rating->ratingID }}" class="modal-toggle" />
<div class="modal">
    <div class="modal-box relative">
        <label for="deleteModal-{{ $rating->ratingID }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        <h3 class="text-lg font-semibold mb-4">Delete Feedback</h3>
        <p>Are you sure you want to delete the feedback from <strong>{{ $rating->rating_name }}</strong>?
        </p>
        <div class="mt-4 flex justify-end gap-2">
            <form method="POST" action="/servicefeedback/delete/{{ $rating->ratingID }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error btn-sm">Delete</button>
            </form>
            <label for="deleteModal-{{ $rating->ratingID }}" class="btn btn-sm btn-gray cursor-pointer">Cancel</label>
        </div>
    </div>
</div>