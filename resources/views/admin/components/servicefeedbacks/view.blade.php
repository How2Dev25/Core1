<input type="checkbox" id="viewModal-{{ $rating->ratingID }}" class="modal-toggle" />
<div class="modal">
    <div class="modal-box relative">
        <label for="viewModal-{{ $rating->ratingID }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        <h3 class="text-lg font-semibold mb-4">Feedback from {{ $rating->rating_name }}</h3>
        <p><strong>Email:</strong> {{ $rating->rating_email }}</p>
        <p><strong>Location:</strong> {{ $rating->rating_location }}</p>
        <p class="flex items-center gap-2 mt-2"><strong>Rating:</strong>
            @for($i = 1; $i <= 5; $i++)
                <i class="fa-star text-sm {{ $rating->rating_rating >= $i ? 'fa-solid' : 'fa-regular' }}"
                    style="color:#F7B32B;"></i>
            @endfor
        </p>
        <p class="mt-2"><strong>Description:</strong> {{ $rating->rating_description }}</p>
    </div>
</div>