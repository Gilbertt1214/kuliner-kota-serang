@if (auth()->check())
<form action="{{ route('review.store', $foodPlace->id) }}" method="POST">
    @csrf
    <label for="rating">Rating:</label>
    <select name="rating" required>
        @for ($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>

    <label for="comment">Komentar:</label>
    <textarea name="comment" rows="3" placeholder="Tulis ulasan..."></textarea>

    <button type="submit">Kirim Ulasan</button>
</form>
@endif
